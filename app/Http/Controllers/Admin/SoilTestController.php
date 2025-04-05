<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\tests\SaveCompactionTesrRequest;
use App\Http\Requests\Admin\tests\SaveRequest;
use App\Http\Requests\Admin\tests\SaveSoilTestRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Employee;
use App\Models\Admin\SoilCompactionTest;
use App\Models\Admin\SoilCompactionTestDetails;
use App\Models\Admin\SoilHasaCompactionTest;
use App\Models\Admin\SoilHasaCompactionTestDetails;
use App\Models\Admin\Test;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;
use App\Services\Payments\DuesService;
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
    protected $EmployeeRepository;

    public function __construct(BasicRepositoryInterface $basicRepository, TestsService $testsService)
    {
        $this->projectsRepository   = createRepository($basicRepository, new ClientsProjects());
        $this->clientsRepository = createRepository($basicRepository, new Clients());
        $this->companyRepository   = createRepository($basicRepository, new ClientsCompanies());
        $this->SoilCompactionTestRepository   = createRepository($basicRepository, new SoilHasaCompactionTest());
        $this->SoilCompactionTestDetailsRepository   = createRepository($basicRepository, new SoilHasaCompactionTestDetails());
        $this->EmployeeRepository   = createRepository($basicRepository, new Employee());
        $this->testsRepository   = createRepository($basicRepository, new Test());
        $this->testsService   = $testsService;
    }

    ////////////////////////////hasa_compaction///////////////////
    public function hasa_compaction_index(Request $request)
    {
        //  $allData = Test::with(['company', 'client', 'project', 'user'])->where('test_type',$type)->where('sub_test_type',$test)->orderBy('id','desc')->get();

        //   dd($allData);
        if ($request->ajax()) {

            $allData = Test::with(['company', 'client', 'project', 'user'])->where('test_category', 'soil')->where('test_sub_category', 'hasa')->where('test', 'compaction')->orderBy('id', 'desc')->get();
            return DataTables::of($allData)
            ->editColumn('client', function ($row) {
                //  return optional($row->client)->name;
                return '<a href="'.route('admin.client_companies', $row->client_id).'" class="text-primary fw-bold">'.($row->client)->name.'</a>';

            })
            ->editColumn('test_code', function ($row) {
                return '<a href="'.route('admin.samples_test', $row->id).'" class="text-primary fw-bold">'. $row->test_code_st.'</a>';
            })
            ->editColumn('company', function ($row) {
                // return  optional($row->company)->name ;
                return '<a  href="'.route('admin.company_projects', $row->company_id).'" class="text-primary fw-bold" style="color:red">'.optional($row->company)->name.'</a>';

            })
            ->editColumn('project', function ($row) {
                return $row->project ? $row->project->project_name : 'N/A';
            })

            ->editColumn('talab_title', function ($row) {
                return $row->talab_title;
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
                $status_arr = [
                    'pending' => trans('tests.pending'),
                    'received' => trans('tests.received'),
                    'test_progress' => trans('tests.test_progress'),
                    'test_done' => trans('tests.test_done'),
                    'reports_progress' => trans('tests.reports_progress'),
                    'reports_done' => trans('tests.reports_done')
                ];
                return $status_arr[$row->status];
            })
            ->addColumn('action', function ($row) {
                return '
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="actionDropdown'.$row->id.'" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-gear"></i> ' . trans('tests.actions') . '
        </button>
        <ul class="dropdown-menu" aria-labelledby="actionDropdown'.$row->id.'">
            <li>
                <a class="dropdown-item" href="' . route('admin.soil_compaction_edit_soil_test', [$row->id]) . '">
                    <i class="bi bi-pencil-square me-2"></i> ' . trans('tests.edit') . '
                </a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="' . route('admin.delete_test', $row->id) . '"
                   onclick="return confirm(\'' . trans('masrofat.confirm_delete') . '\')">
                    <i class="bi bi-trash3 me-2"></i> ' . trans('tests.delete') . '
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="' . route('admin.hasa_samples_test', $row->id) . '">
                    <i class="bi bi-clipboard-check me-2"></i> ' . trans('tests.samples_test') . '
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="' . route('admin.print_soil_sample_report', $row->id) . '">
                    <i class="bi bi-printer me-2"></i> ' . trans('tests.print_samples_test') . '
                </a>
            </li>
        </ul>
    </div>';
            })
            ->rawColumns(['action', 'talab_image','test_code','company','client'])
            ->make(true);
    }
        return view('dashbord.tests.soil.hasa.compaction_index');
    }

    /****************************************************************/
    public function hasa_compaction_create()
    {
        $data['test_code'] = $this->testsRepository->getLastFieldValue('test_code');
        $data['wared_number'] = $this->testsRepository->getLastFieldValue('wared_number');
        $data['talab_number'] = $this->testsRepository->getLastFieldValue('talab_number');
        $data['book_number'] = $this->testsRepository->getLastFieldValue('book_number');
        $data['clients']      = $this->clientsRepository->getAll();
        $data['companies']      = $this->companyRepository->getAll();
        $data['projects'] = $this->projectsRepository->getAll();
        $data['employees'] = $this->EmployeeRepository->getAll();
        // $data['type'] = $type;
        // $data['test'] = $test;
        return view('dashbord.tests.soil.hasa.compaction_form', $data);
    }

    /****************************************************************/
    public function hasa_compaction_store(SaveSoilTestRequest $request)
    {
        try {
            // dd($request->all());

            $this->testsService->store($request, 'hasa', 'compaction');
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.hasa_compaction_soil_test');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**************************************************************/
    public function hasa_compaction_edit($id)
    {
        $data['all_data']     = $this->testsRepository->getById($id);
        $data['clients']      = $this->clientsRepository->getAll();
        $data['companies']    = $this->companyRepository->getAll();
        $data['projects']     = $this->projectsRepository->getAll();
        $data['employees'] = $this->EmployeeRepository->getAll();
        //  dd($data['employees']);
        $data['type'] = 'soil';
        $data['test'] = 'compaction';
        return view('dashbord.tests.soil.hasa.compaction_edit', $data);
    }
    /**************************************************************/
    public function hasa_compaction_update(SaveSoilTestRequest $request, $id)
    {
        try {
            // dd($request->all());
            $this->testsService->update($request, $id, 'hasa', 'compaction');
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.hasa_compaction_soil_test');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***************************************************************/
    public function test_dues($id, DuesService $duesService)
    {

        // dd($id);
        $data['all_data'] = $this->testsRepository->getById($id);
        $data['dues'] = $duesService->get_data_by_soil_test_id($id);
        $data['required_value'] = $data['dues']->test_value - $data['dues']->client_test_payment->sum('value');
        $data['num'] = $duesService->get_last_num();
        $data['all_emps'] = Employee::all();
        //dd($data['dues']);
        return view('dashbord.tests.soil.payments.dues', $data);
    }
    /****************************************************************/
    public function hasa_compaction_test($id)
    {
        $data['all_data'] = $this->testsRepository->getById($id);
        $data['compaction_test'] = $this->SoilCompactionTestRepository->getWithRelationsAndWhere(['compaction_test_details'], 'soil_test_id', $id);
        return view('dashbord.tests.soil.hasa.compaction_test', $data);
    }
}
