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
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
          // dd($data,$data->test_type);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.hasa_compaction_soil_test',[$data->test_type,$data->sub_test_type]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************/
    public function hasa_compaction_test_details($id)
    {
        $data['all_data']=$this->TestRepository->getById($id);
        $data['compaction_test'] = $this->HasaCompactionTestRepository->getWithRelationsAndWhere(['compaction_test_details'], 'soil_test_id', $id);
        //dd($data['compaction_test'][0]->compaction_test_details);
        return view('dashbord.tests.soil.hasa.compaction_report_details', $data);
    }

    /****************************************************/
    function toTLV($tag, $value)
    {
        $length = strlen($value);
        return chr($tag) . chr($length) . $value;
    }
    /****************************************************/
    public function print_compaction_test($id)
    {
        //dd('s');
        $data['all_data']=$this->TestRepository->getById($id);
        $data['compaction_test'] = $this->HasaCompactionTestRepository->getWithRelationsAndWhere(['compaction_test_details'], 'soil_test_id', $id);
        //dd($data['compaction_test'][0]->compaction_test_details);
        $invoiceData = [
            'invoice_number' => 'INV-'.$data['compaction_test'][0]->sader_num,
            'date' => now()->format('Y-m-d'),
            'customer_name' => $data['all_data']->company ? $data['all_data']->company->name : 'N/A' ,
            'total' => $data['all_data']->cost,

        ];


        $qrData = json_encode($invoiceData, JSON_UNESCAPED_UNICODE);
        $data['qrCode'] = QrCode::format('svg')->size(200)->generate($qrData);

        return view('dashbord.tests.soil.hasa.compaction_report_print', $data);
    }

}
