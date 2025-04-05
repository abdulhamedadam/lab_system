<?php


namespace App\Services;


use App\Repositories\HelperRepository;

class HelperService
{

    public function __construct(HelperRepository $helperRepository)
    {
        $this->helperRepository=$helperRepository;
    }
    /*************************************************/
    public function save_client($data)
    {
        return $this->helperRepository->save_client($data);
    }
    /*************************************************/
    public function save_company($data)
    {
        return $this->helperRepository->save_company($data);
    }
    /*************************************************/
    public function save_project($data)
    {
        return $this->helperRepository->save_project($data);
    }
    /*************************************************/
    public function get_companies()
    {
        return $this->helperRepository->get_companies();
    }
    /**************************************************/
    public function get_bnod_sarf()
    {
        return $this->helperRepository->get_bnod_sarf();
    }
    /**************************************************/
    public function get_all_tests()
    {
        return $this->helperRepository->get_all_tests();
    }
    /**************************************************/
    public function update_test_status($status,$test_id)
    {
        return $this->helperRepository->update_test_status($status,$test_id);
    }
    /****************************************************/
    public function check_sader_date($date,$year)
    {
        return $this->helperRepository->check_sader_date($date,$year);
    }
    /****************************************************/
    public function get_all_sader()
    {
        return $this->helperRepository->get_all_sader();
    }
    /****************************************************/
    public function save_sader_data($request)
    {

        $validated_data=$request->validated();


        $lastSader  = $this->get_last_sader_num();

        $lastNumber = $lastSader  ? $lastSader->num : 0;

        $startNumber = $lastNumber + 1;
        $endNumber = $lastNumber + $validated_data['num'];
        // dd($startNumber,$endNumber);
        $createdNumbers = [];
        for ($i = $startNumber; $i <= $endNumber; $i++) {
            $test_data['num']=$i;
            $test_data['date']=$request->date;
             $this->helperRepository->save_sader($test_data);
            $createdNumbers[] = $i;
        }
    }
    /*****************************************************/
    public function get_last_sader_num()
    {

        return $this->helperRepository->get_last_sader_num();
    }
}
