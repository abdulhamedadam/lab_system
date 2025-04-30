<?php


namespace App\Repositories;


use App\Interfaces\HrInterface;
use App\Models\Bonus;
use App\Models\Deductions;
use App\Models\LaonsInstallments;
use App\Models\Loans;

class HrRepository implements HrInterface
{
    public function save_loans($data)
    {
        return Loans::create($data);
    }

    /*********************************************/
    public function update_loans($data, $id)
    {
        $loans = Loans::find($id);
        return $loans->update($data);
    }

    /*********************************************/
    public function get_loan($id)
    {
        return Loans::with('loan_installment')->find($id);
    }

    /********************************************/
    public function delete_loan($id)
    {
        $loan = Loans::find($id);
        $loan->delete();
        LaonsInstallments::where('loan_id', $id)->delete();

    }

    /*********************************************/
    public function save_deduction($data)
    {
        return Deductions::create($data);
    }

    /**********************************************/
    public function get_deduction($id)
    {
        return Deductions::find($id);
    }

    /************************************************/
    public function update_deduction($data, $id)
    {
        $deduction = $this->get_deduction($id);
        return  $deduction->update($data);
    }
    /************************************************/
    public function delete_deduction($id)
    {
        $deduction = $this->get_deduction($id);
        $deduction->delete();
    }
    /************************************************/
    public function save_bonus($data)
    {
        return Bonus::create($data);
    }

    /************************************************/
    public function get_bonus($id)
    {
        return Bonus::find($id);
    }
    /************************************************/
    public function update_bonus($data,$id)
    {
        $bonus = $this->get_bonus($id);
        $bonus->update($data);
    }
    /************************************************/
    public function delete_bonus($id)
    {
        $bonus = $this->get_bonus($id);
        $bonus->delete();
    }
}
