<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\tests\hasa\SaveCompactionRequest;
use App\Http\Requests\Admin\tests\SaveCompactionTesrRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\SoilCompactionTest;
use App\Models\Admin\SoilCompactionTestDetails;
use App\Models\Admin\SoilHasaCompactionTest;
use App\Models\Admin\SoilHasaCompactionTestDetails;
use App\Models\Admin\Test;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;
use App\Services\SoilHasaService;
use App\Services\TestsService;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;

class SoilHasaTestsController extends Controller
{

    use ImageProcessing;
    use ValidationMessage;


    protected $hasaService;

    protected $HasaCompactionTestRepository;
    protected $HasaCompactionTestDetailsRepository;
    protected $TestRepository;



    /******************************************************/
    public function __construct(BasicRepositoryInterface $basicRepository, SoilHasaService $hasaService)
    {

        $this->HasaCompactionTestRepository   = createRepository($basicRepository, new SoilHasaCompactionTest());
        $this->TestRepository   = createRepository($basicRepository, new Test());
        $this->HasaCompactionTestDetailsRepository   = createRepository($basicRepository, new SoilHasaCompactionTestDetails());
        $this->hasaService   = $hasaService;


    }


    /******************************************************/
    public function compaction_test($id)
    {
        $data['all_data']=$this->TestRepository->getById($id);
        $data['sader_num'] = $this->HasaCompactionTestRepository->getLastFieldValue('sader_num');
       // dd($data['all_data']);
        $data['compaction_test'] = $this->HasaCompactionTestRepository->getWithRelationsAndWhere(['compaction_test_details'], 'soil_test_id', $id);
       // dd($data['compaction_test']);
        //dd($data['compaction_test'][0]->compaction_test_details);
        return view('dashbord.tests.soil.hasa.compaction_test', $data);

    }
    /******************************************************/
    public function save_compaction_test(SaveCompactionRequest $request,$test_id)
    {
        try {
            //dd($request->all());
            $this->hasaService->save_compaction_test($request,$test_id);
            $data=$this->TestRepository->getById($test_id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.samples_test',[$data->test_type,$data->sub_test_type]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
