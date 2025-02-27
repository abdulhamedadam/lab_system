<?php


namespace App\Repositories;


use App\Interfaces\AccountInterface;
use App\Models\Admin\Finance\Accounts;

class AccountRepository implements AccountInterface
{

    public function get_accounts()
    {
        return Accounts::defaultOrder()
            ->get()
            ->map(function ($account) {
                $arrow = (app()->getLocale() == 'ar') ? '←' : '→';
                $depth = $account->depth;
                $indentation = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $depth);

                // تصحيح طريقة تعيين display_name
                $account->display_name = $depth > 0
                    ? $indentation . $arrow . ' ' . $account->name
                    : $account->name;

                return $account;
            });

    }

    public function find($id)
    {
        return Accounts::find($id);
    }

    public function create(array $data)
    {
        return Accounts::create($data);
    }

    public function update($id, array $data)
    {
        $account=$this->find($id);
        return $account->update($data);
    }

    public function delete($id)
    {
        $account=$this->find($id);
        return $account->delete();
    }

    public function get_accounts_select()
    {
        return  $accounts = Accounts::get()->toTree();

    }
    /**********************************************/
    public function get_parent($parent_id)
    {
        return Accounts::where('id',$parent_id)->get();
    }
}
