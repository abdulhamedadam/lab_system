<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\tests\SaveRequest;
use App\Http\Requests\Admin\tests\SaveSoilTestRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\SoilCompactionTest;
use App\Models\Admin\SoilCompactionTestDetails;
use App\Models\Admin\Test;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;
use App\Services\TestsService;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SoilTestController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    protected $clientsRepository;
    protected $testsRepository;
    protected $testsService;
    protected $masrofatRepository;
    protected $SoilCompactionTestRepository;
    protected $SoilCompactionTestDetailsRepository;
    protected $companyRepository;
    protected $projectsRepository;

    public function __construct(BasicRepositoryInterface $basicRepository, TestsService $testsService)
    {
        $this->projectsRepository   = createRepository($basicRepository, new ClientsProjects());
        $this->clientsRepository = createRepository($basicRepository, new Clients());
        $this->companyRepository   = createRepository($basicRepository, new ClientsCompanies());
        $this->SoilCompactionTestRepository   = createRepository($basicRepository, new SoilCompactionTest());
        $this->SoilCompactionTestDetailsRepository   = createRepository($basicRepository, new SoilCompactionTestDetails());
        $this->testsRepository   = createRepository($basicRepository, new Test());
        $this->testsService   = $testsService;


    }
    /***************************************************************/
    public function index(Request $request,$type,$test)
    {
      //  $allData = Test::with(['company', 'client', 'project', 'user'])->where('test_type',$type)->where('sub_test_type',$test)->orderBy('id','desc')->get();

     //   dd($allData);
        if ($request->ajax()) {

            $allData = Test::with(['company', 'client', 'project', 'user'])->where('test_type',$type)->where('sub_test_type',$test)->orderBy('id','desc')->get();
            return DataTables::of($allData)
                ->editColumn('client', function ($row) {
                    return $row->client ? $row->client->name : 'N/A';
                })
                ->editColumn('test_code', function ($row) {
                    return get_app_config_data('soil_prefix').$row->test_code;
                })
                ->editColumn('company', function ($row) {
                    return $row->company ? $row->company->name : 'N/A';
                })
                ->editColumn('project', function ($row) {
                    return $row->project ? $row->project->project_name : 'N/A';
                })

                ->editColumn('talab_title', function ($row) {
                    return $row->talab_title;
                })
                ->editColumn('talab_image', function ($row) {
                    if ($row->talab_image) {
                        $imagePath = asset('images/' . $row->talab_image);
                        return '<img src="' . $imagePath . '" alt="Employee Image" class="img-thumbnail" style="width: 50px; height: 50px;" onclick="showImagePopup(\'' . $imagePath . '\')">';
                    } else{
                        return 'N\A';
                    }
                })
                ->editColumn('talab_date', function ($row) {
                    return $row->talab_date;
                })
                ->editColumn('talab_end_date', function ($row) {
                    return $row->talab_end_date;
                })
                ->editColumn('sample_number', function ($row) {
                    return $row->sample_number;
                })
                ->editColumn('status', function ($row) {
                    $status_arr=['pending'=>trans('tests.pending'),'received'=>trans('tests.received'),
                        'test_progress'=>trans('tests.test_progress'),'test_done'=>trans('tests.test_done'),'reports_progress'=>trans('tests.reports_progress'),
                        'reports_done'=>trans('tests.reports_done')
                    ];
                    return $status_arr[$row->status];
                })
                ->addColumn('action', function ($row) {

                    if ($row->test_type=='soil')
                    {
                        if ($row->sub_test_type=='compaction')
                        {
                            $test='<a href="' . route('admin.samples_test', $row->id) . '" class="btn btn-sm btn-success" title="' . trans('tests.samples_test') . '" style="font-size: 16px;">
                                <i class="bi bi-clipboard-check"></i>
                             </a>';
                        }
                    }elseif ($row->test_type=='hasa')
                    {
                        if ($row->sub_test_type=='compaction')
                        {
                            $test='<a href="' . route('admin.hasa_compaction_test', $row->id) . '" class="btn btn-sm btn-success" title="' . trans('tests.samples_test') . '" style="font-size: 16px;">
                                <i class="bi bi-clipboard-check"></i>
                             </a>';
                        }
                    }else{
                        $test='';
                    }




                    return '
                        <div class="btn-group btn-group-sm">
                            <a href="' . route('admin.edit_soil_test', [$row->id,$row->test_type,$row->sub_test_type]) . '" class="btn btn-sm btn-primary" title="' . trans('tests.edit') . '" style="font-size: 16px;">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a onclick="return confirm(\'Are You Sure To Delete?\')"  href="' . route('admin.delete_test', $row->id) . '"  class="btn btn-sm btn-danger" title="' . trans('tests.delete') . '" style="font-size: 16px;" onclick="return confirm(\'' . trans('masrofat.confirm_delete') . '\')">
                                <i class="bi bi-trash3"></i>
                            </a>
                            '.$test.'

                             <a href="' . route('admin.print_soil_sample_report', $row->id) . '" class="btn btn-sm btn-dark" title="' . trans('tests.print_samples_test') . '" style="font-size: 16px;">
                                  <i class="bi bi-printer ms-1"></i>
                             </a>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'talab_image'])
                ->make(true);
        }
        $data['type']=$type;
        $data['test']=$test;
        return view('dashbord.tests.soil.index',$data);
    }
    /****************************************************************/
    public function create($type,$test)
    {
        $data['test_code'] = $this->testsRepository->getLastFieldValue('test_code');
        $data['wared_number'] = $this->testsRepository->getLastFieldValue('wared_number');
        $data['talab_number'] = $this->testsRepository->getLastFieldValue('talab_number');
        $data['book_number'] = $this->testsRepository->getLastFieldValue('book_number');
        $data['clients']      = $this->clientsRepository->getAll();
        $data['companies']      = $this->companyRepository->getAll();
        $data['projects'] = $this->projectsRepository->getAll();
        $data['type']=$type;
        $data['test']=$test;
        return view('dashbord.tests.soil.form', $data);
    }
    /****************************************************************/
    public function store(SaveSoilTestRequest $request,$type,$test)
    {
        try {
            // dd($request->all());

            $this->testsService->store($request,$type,$test);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.soil_test',[$type,$test]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**************************************************************/
    public function edit($id,$type,$test)
    {
        $data['all_data']     = $this->testsRepository->getById($id);
        $data['clients']      = $this->clientsRepository->getAll();
        $data['companies']    = $this->companyRepository->getAll();
        $data['projects']     = $this->projectsRepository->getAll();
        $data['type']=$type;
        $data['test']=$test;
        return view('dashbord.tests.soil.edit', $data);
    }
    /**************************************************************/
    public function update(SaveSoilTestRequest $request,$id,$type,$test)
    {
        try {
            // dd($request->all());
            $this->testsService->update($request,$id,$type,$test);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.soil_test',[$type,$test]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
