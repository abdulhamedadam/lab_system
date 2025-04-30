<?php


namespace App\Repositories;


use App\Interfaces\ClientPaymentInterface;
use App\Interfaces\EmployeeInterface;
use App\Models\Admin\Employee;
use App\Models\Admin\EmployeeSalary;
use App\Models\Admin\Masrofat;
use App\Models\ClientTestPayment;
use App\Models\Payroll;
use App\Models\PayrollDetails;
use App\Models\SalaryReport;
use App\Models\SalaryReportDetail;

class EmployeeRepository implements EmployeeInterface
{
    public function save_employee_salary($data, $id)
    {
        $total_salary = $data['basic_salary'] + $data['housing_allowance']
            + $data['transportation_allowance'] + $data['other_allowances'];

        $salaryData = [
            'basic_salary' => $data['basic_salary'],
            'housing_allowance' => $data['housing_allowance'],
            'transportation_allowance' => $data['transportation_allowance'],
            'other_allowances' => $data['other_allowances'],
            'total_salary' => $total_salary,
            'created_by' => auth('admin')->id(),
            'notes' => $data['notes']
        ];

        $salary = EmployeeSalary::where('employee_id', $id)->first();

        if ($salary) {
            $salary->update($salaryData);
        } else {
            $salaryData['employee_id'] = $id;
            EmployeeSalary::create($salaryData);
        }

        return $salary;
    }

    /***************************************************/
    public function get_employess()
    {
        return Employee::where('status','active')->get();
    }
    /***************************************************/
    public function get_payroll_reports_in_period($from_date, $to_date)
    {
        $data = Employee::with([
            'all_bonus' => function ($query) use ($from_date, $to_date) {
                $query->whereBetween('date_bonuses', [$from_date, $to_date]);
            },
            'all_deductions' => function ($query) use ($from_date, $to_date) {
                $query->whereBetween('date_deductions', [$from_date, $to_date]);
            },
            'all_loan' => function ($query) use ($from_date, $to_date) {
                $query->whereBetween('date_loan', [$from_date, $to_date]);
            }
        ])
            ->orderBy('id', 'asc')
            ->get();

        return $data;
    }
    /******************************************************/
    public function check_date_rang_overlap($from_date, $to_date)
    {
        return $existingReport = Payroll::where(function ($query) use ($from_date, $to_date) {
            $query->whereBetween('from_date', [$from_date, $to_date])
                ->orWhereBetween('to_date', [$from_date, $to_date])
                ->orWhere(function ($q) use ($from_date, $to_date) {
                    $q->where('from_date', '<=', $from_date)
                        ->where('to_date', '>=', $to_date);
                });
        })->first();
    }

    /***************************************************/
    public function save_salary_report($validated)
    {
        return $salaryReport = Payroll::create([
            'report_date' => $validated['report_date'],
            'total_main_salary' => $validated['total_main_salary'],
            'total_bonus' => $validated['total_bonus'],
            'total_deductions' => $validated['total_deductions'],
            'total_loans' => $validated['total_loans'],
            'grand_total' => $validated['grand_total'],
            'from_date' => $validated['from_date'],
            'to_date' => $validated['to_date'],
            'created_by' => auth()->id(),
        ]);
    }

    /****************************************************/
    public function save_masrofate($validated)
    {
        return Masrofat::create([
            'emp_id'=>1,
            'band_id'=>1,
            'value'=>$validated['grand_total'],
            'notes'=>'main salary : '.$validated['total_main_salary'].' /total_bonus : '.$validated['total_bonus'].' /total_deductions : '.$validated['total_deductions']
                .' /total_loans : '.$validated['total_loans']     .' /grand_total : '.$validated['grand_total']
            ,
        ]);
    }
    /****************************************************/
    public function save_salary_report_details($employees, $salaryReport)
    {
        foreach ($employees as $employeeId => $employeeData) {
            PayrollDetails::create([
                'payroll_id' => $salaryReport->id,
                'employee_id' => $employeeId,
                'emp_name' => $employeeData['emp_name'],
                'main_salary' => $employeeData['main_salary'],
                'bonus' => $employeeData['bonus'],
                'deductions' => $employeeData['deductions'],
                'loan' => $employeeData['loan'],
                'total' => $employeeData['total'],
            ]);
        }
    }

    /********************************************************/
    public function get_payroll_details($salary_id)
    {
        return Payroll::with(['payroll_details', 'payroll_details.employee'])->find($salary_id);
    }

    /*********************************************************/
    public function delete_payroll($id)
    {
        Payroll::where('id', $id)->delete();
        return   PayrollDetails::where('payroll_id', $id)->delete();
    }


}
