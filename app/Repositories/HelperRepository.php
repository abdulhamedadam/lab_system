<?php


namespace App\Repositories;


use App\Interfaces\HelperInterface;
use App\Models\Admin\SarfBand;
use App\Models\Admin\Test;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;
use App\Models\TestSader;

class HelperRepository implements HelperInterface
{

    public function save_client($data)
    {
        $lastClient = Clients::orderBy('client_code', 'desc')->first();
        if ($lastClient) {
            $newclient_code = $lastClient->client_code + 1;
        } else {
            $newclient_code = 1;
        }
        $data['client_code'] = $newclient_code;
        return Clients::create($data);
    }

    /**********************************/
    public function save_company($data)
    {
        $lastCompany = ClientsCompanies::orderBy('company_code', 'desc')->first();
        if ($lastCompany) {
            $newCompanyCode = $lastCompany->company_code + 1;
        } else {
            $newCompanyCode = 1;
        }
        $data['company_code'] = $newCompanyCode;
        return ClientsCompanies::create($data);
    }

    /**********************************/
    public function save_project($data)
    {
        $last_project = ClientsProjects::orderBy('project_code', 'desc')->first();
        if ($last_project) {
            $newcode = $last_project->project_code + 1;
        } else {
            $newcode = 1;
        }
        $data['project_code'] = $newcode;
        return ClientsProjects::create($data);
    }
    /************************************/
    public function get_companies()
    {
        return ClientsCompanies::all();
    }
    /************************************/
    public function get_bnod_sarf()
    {
        return SarfBand::all();
    }
    /*************************************/
    public function get_all_tests()
    {
       return Test::where('sader_number',null)->get();
    }
    /*************************************/
    public function update_test_status($status,$id)
    {
        $test=Test::find($id);
        $data['status']=$status;
        return $test->update($data);
    }
    /************************************/
    public function check_sader_date($date, $year)
    {
        $records = TestSader::whereYear('date', $year)
            ->whereDate('date', $date)
            ->get();

        if ($records->count() > 0) {

            $numbers=$records->pluck('num')->toArray();
        } else {
            $lastRecord = TestSader::whereYear('date', $year)
                ->orderByDesc('num')
                ->first();

            return response()->json([
                'exists' => false,
                'next_number' => $lastRecord ? $lastRecord->num + 1 : 1
            ]);
        }
    }
    /***********************************    */
    public function get_all_sader()
    {
        return TestSader::with('test')->get();
    }
    /**********************************/
    public function get_sader_by_id($id)
    {
        return TestSader::find($id);
    }
    /**********************************/
    public function get_last_sader_num()
    {
       return $lastSader = TestSader::orderBy('num', 'desc')->first();
    }
    /*********************************/
    public function save_sader($test_data)
    {
        return TestSader::create($test_data);
    }


}
