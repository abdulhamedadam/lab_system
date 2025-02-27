<?php


namespace App\Services\Finance;


use App\Repositories\AccountRepository;
use App\Traits\ImageProcessing;

class AccountService
{
    use ImageProcessing;
    /*****************************************************/
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository=$accountRepository;
    }
    /******************************************************/
    public function get_accounts()
    {
        return $this->accountRepository->get_accounts();
    }
    /******************************************************/
    public function get_accounts_select()
    {
        return $this->accountRepository->get_accounts_select();
    }
    /******************************************************/
    public function store($request)
    {
        //dd($request);
        $validated_data = $request->validated();
        $data['name']=['ar'=>$validated_data['name']['ar'],'en'=>$validated_data['name']['en']];
        $data['code']=$validated_data['code'];
        $data['parent_id']=$request->account_id ?? 0;
        $data['level']=$this->get_level($data['parent_id']);
       // dd($data);
        return $this->accountRepository->create($data);

    }
    /******************************************************/
    public function find($id)
    {
        return $this->accountRepository->find($id);
    }
    /*****************************************************/
    public function update($id,$request)
    {
        $validated_data = $request->validated();
        $data['name']=['ar'=>$validated_data['name']['ar'],'en'=>$validated_data['name']['en']];
        $data['code']=$validated_data['code'];
        $data['parent_id']=$request->account_id ?? 0;
      //  dd($data);
        return $this->accountRepository->update($id,$data);
    }
    /****************************************************/
    public function get_level($parent_id)
    {
        if ($parent_id == 0)
        {
            return  $level = 1 ;
        }else{
            $data=$this->accountRepository->get_parent($parent_id);
            $level=$data[0]->level+1;

            return $level ;
        }
    }
}
