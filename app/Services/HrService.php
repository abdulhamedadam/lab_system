<?php


namespace App\Services;


use App\Models\LaonsInstallments;
use App\Repositories\HrRepository;

class HrService
{

    protected $hrRepository;

    public function __construct(HrRepository $hrRepository)
    {
        $this->hrRepository = $hrRepository;
    }

    /********************************************/
    public function save_loans($request)
    {
        $validated_data = $request->validated();

        $data['emp_id'] = $validated_data['emp_id'];
        $data['installments_num'] = $validated_data['installments_num'];
        $data['installments_num'] = $validated_data['installments_num'];
        $data['date_deductions'] = $validated_data['date_deductions'];
        $data['date_deductions_int'] = strtotime($validated_data['date_deductions']);
        $data['date_loan'] = $validated_data['date_loan'];
        $data['date_loan_int'] = strtotime($validated_data['date_loan']);
        $data['value'] = $validated_data['value'];
        $data['reason'] = $validated_data['reason'];
        $data['year'] = Date('Y', strtotime($validated_data['date_loan']));
        $data['month'] = Date('n', strtotime($validated_data['date_loan']));

        $loans = $this->hrRepository->save_loans($data);

        if ($validated_data['installments_num'] > 0) {
            $installments = [];
            $installment_value = $data['value'] / $data['installments_num'];

            $start_date = strtotime($data['date_deductions']);

            for ($i = 0; $i < $data['installments_num']; $i++) {
                $installment_month = date('n', strtotime("+$i month", $start_date));
                $installment_year = date('Y', strtotime("+$i month", $start_date));

                $installments = [
                    'loan_id' => $loans->id,
                    'month' => $installment_month,
                    'year' => $installment_year,
                    'amount' => $installment_value,
                    'status' => 'unpaid',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                LaonsInstallments::create($installments);
            }


        }
        return '';
    }

    /******************************************/
    public function update_loans($request, $id)
    {
        $validated_data = $request->validated();

        $data['emp_id'] = $validated_data['emp_id'];
        $data['installments_num'] = $validated_data['installments_num'];
        $data['installments_num'] = $validated_data['installments_num'];
        $data['date_deductions'] = $validated_data['date_deductions'];
        $data['date_deductions_int'] = strtotime($validated_data['date_deductions']);
        $data['date_loan'] = $validated_data['date_loan'];
        $data['date_loan_int'] = strtotime($validated_data['date_loan']);
        $data['value'] = $validated_data['value'];
        $data['reason'] = $validated_data['reason'];
        $data['year'] = Date('Y', strtotime($validated_data['date_loan']));
        $data['month'] = Date('n', strtotime($validated_data['date_loan']));

        $loans = $this->hrRepository->update_loans($data, $id);


        if ($validated_data['installments_num'] > 0) {
            LaonsInstallments::where('loan_id', $id)->delete();

            $installments = [];
            $installment_value = $data['value'] / $data['installments_num'];

            $start_date = strtotime($data['date_deductions']);

            for ($i = 0; $i < $data['installments_num']; $i++) {
                $installment_month = date('n', strtotime("+$i month", $start_date));
                $installment_year = date('Y', strtotime("+$i month", $start_date));

                $installments = [
                    'loan_id' => $id,
                    'month' => $installment_month,
                    'year' => $installment_year,
                    'amount' => $installment_value,
                    'status' => 'unpaid',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                LaonsInstallments::create($installments);
            }


        }
        return '';
    }

    /******************************************/
    public function get_loan($id)
    {
        return $this->hrRepository->get_loan($id);
    }
    /****************************************/
    public function delete_loan($id)
    {
        return $this->hrRepository->delete_loan($id);
    }
    /*******************************************/
    public function save_deduction($request)
    {
        $validated_data = $request->validated();

        $data['emp_id'] = $validated_data['emp_id'];
        $data['date_deductions'] = $validated_data['date_deductions'];
        $data['date_deductions_int'] = strtotime($validated_data['date_deductions']);
        $data['value'] = $validated_data['value'];
        $data['reason'] = $validated_data['reason'];
        $data['year'] = Date('Y', strtotime($validated_data['date_deductions']));
        $data['month'] = Date('n', strtotime($validated_data['date_deductions']));
        return $this->hrRepository->save_deduction($data);
    }
    /********************************************/
    public function update_deduction($request,$id)
    {
        $validated_data = $request->validated();

        $data['emp_id'] = $validated_data['emp_id'];
        $data['date_deductions'] = $validated_data['date_deductions'];
        $data['date_deductions_int'] = strtotime($validated_data['date_deductions']);
        $data['value'] = $validated_data['value'];
        $data['reason'] = $validated_data['reason'];
        $data['year'] = Date('Y', strtotime($validated_data['date_deductions']));
        $data['month'] = Date('n', strtotime($validated_data['date_deductions']));
        return $this->hrRepository->update_deduction($data,$id);
    }
    /********************************************/
    public function save_bonus($request)
    {
        $validated_data = $request->validated();

        $data['emp_id'] = $validated_data['emp_id'];
        $data['date_bonuses'] = $validated_data['date_bonuses'];
        $data['date_bonuses_int'] = strtotime($validated_data['date_bonuses']);
        $data['value'] = $validated_data['value'];
        $data['reason'] = $validated_data['reason'];
        $data['year'] = Date('Y', strtotime($validated_data['date_bonuses']));
        $data['month'] = Date('n', strtotime($validated_data['date_bonuses']));
        return $this->hrRepository->save_bonus($data);
    }
    /********************************************/
    public function update_bonus($request,$id)
    {
        $validated_data = $request->validated();

        $data['emp_id'] = $validated_data['emp_id'];
        $data['date_bonuses'] = $validated_data['date_bonuses'];
        $data['date_bonuses_int'] = strtotime($validated_data['date_bonuses']);
        $data['value'] = $validated_data['value'];
        $data['reason'] = $validated_data['reason'];
        $data['year'] = Date('Y', strtotime($validated_data['date_bonuses']));
        $data['month'] = Date('n', strtotime($validated_data['date_bonuses']));
        return $this->hrRepository->update_bonus($data,$id);
    }
    /********************************************/

    public function delete_deduction($id)
    {
        return $this->hrRepository->delete_deduction($id);
    }
    /********************************************/
    public function get_deduction($id)
    {
        return $this->hrRepository->get_deduction($id);
    }
    /********************************************/
    public function get_bonus($id)
    {
        return $this->hrRepository->get_bonus($id);
    }
    /********************************************/

    public function delete_bonus($id)
    {
        return $this->hrRepository->delete_bonus($id);
    }
}
