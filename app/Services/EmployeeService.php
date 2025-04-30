<?php


namespace App\Services;

use App\Interfaces\EmployeeInterface;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\DB;

class EmployeeService
{
   protected $employeeInterface;
    public function __construct(EmployeeRepository $employeeInterface)
    {
       $this->employeeInterface = $employeeInterface;
    }

    /**********************************************  */
    public function save_employee_salary($request, $id)
    {
        $validated_data = $request->validated();

        $data = [
            'basic_salary' => $validated_data['basic_salary'] ?? 0,
            'housing_allowance' => $validated_data['housing_allowance'] ?? 0,
            'transportation_allowance' => $validated_data['transportation_allowance'] ?? 0,
            'other_allowances' => $validated_data['other_allowances'] ?? 0,
            'notes' => $validated_data['notes'] ?? null,
        ];

        return $this->employeeInterface->save_employee_salary($data, $id);
    }
    /***************************************************/
    public function get_employess()
    {
        return $this->employeeInterface->get_employess();
    }
    /**************************************************/
    public function get_payroll_reports_in_period($from_date, $to_date)
    {

        return $this->employeeInterface->get_payroll_reports_in_period($from_date, $to_date);

    }
    /****************************************************/
    public function save_payroll_data($request)
    {
        $validated = $request->validated();

        $existingReport = $this->employeeInterface->check_date_rang_overlap($validated['from_date'], $validated['to_date']);


        if ($existingReport) {
            return response()->json([
                'status' => 'error',
                'message' => trans('reports.date_range_already_exists')
            ], 400);
        }

        DB::beginTransaction();

        try {
            $salaryReport = $this->employeeInterface->save_salary_report($validated);

            $salaryReport = $this->employeeInterface->save_salary_report_details($validated['employees'], $salaryReport);

            $mesrofat=$this->employeeInterface->save_masrofate($validated);


            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => trans('reports.report_saved_successfully'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => trans('reports.report_save_failed') . ': ' . $e->getMessage()
            ], 500);
        }
    }



}
