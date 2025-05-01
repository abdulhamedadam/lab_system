<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\external_test\SaveRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\Test;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;
use App\Models\Companies;
use App\Services\ExternalTestsService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExternalTestsController extends Controller
{
    protected $duesService;

    protected $root_view = 'dashbord.external_test.';

    public function __construct(BasicRepositoryInterface $basicRepository,ExternalTestsService $externalTestsService,)
    {
        $this->externalTestsService = $externalTestsService;
        $this->testsRepository = createRepository($basicRepository, new Test());
    }

    /************************************************/
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $allData = Test::with(['company', 'client', 'project', 'user'])->where('test_type', 'external')->orderBy('id', 'desc')->get();
            return DataTables::of($allData)
                ->editColumn('client', function ($row) {
                    //  return optional($row->client)->name;
                    return '<a href="'.route('admin.client_companies', $row->client_id).'" class="text-primary fw-bold">'.($row->client)->name.'</a>';

                })
                ->editColumn('test_code', function ($row) {
                    return  $row->test_code_st;
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
                <a class="dropdown-item test-cost-btn" href="#" data-bs-toggle="modal"  data-bs-target="#testCostModal" onclick="edit_test_cost(' . $row->id . ')">
                    <i class="bi bi-currency-dollar me-2"></i> ' . trans('tests.test_cost') . '
                </a>
            </li>

            <li>
                <a class="dropdown-item" href="' . route('admin.external_test.edit', [$row->id]) . '">
                    <i class="bi bi-pencil-square me-2"></i> ' . trans('tests.edit') . '
                </a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="' . route('admin.delete_external_test', $row->id) . '"
                   onclick="return confirm(\'' . trans('masrofat.confirm_delete') . '\')">
                    <i class="bi bi-trash3 me-2"></i> ' . trans('tests.delete') . '
                </a>
            </li>

        </ul>
    </div>';
                })
                ->rawColumns(['action', 'talab_image','test_code','company','client'])
                ->make(true);
        }
        return view('dashbord.external_test.index');

    }

    /*************************************************/
    public function create()
    {
        $data['test_code'] = $this->testsRepository->getLastFieldValue('test_code');
        //dd($data['test_code']);
        $data['clients'] = Clients::where('is_active', 1)->get();
        $data['companies'] = Companies::all();
        $data['projects'] = ClientsProjects::all();
        $data['wared_number'] = $this->testsRepository->getLastFieldValue('wared_number');
        $data['talab_number'] = $this->testsRepository->getLastFieldValue('talab_number');
        $data['book_number'] = $this->testsRepository->getLastFieldValue('book_number');
        return view($this->root_view . 'create', $data);
    }
    /*************************************************/
    public function store(SaveRequest $request)
    {
        try {

            $this->externalTestsService->store($request);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.external_test.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*************************************************/
    public function edit($id)
    {
        $data['test_code'] = $this->testsRepository->getLastFieldValue('test_code');
        //dd($data['test_code']);
        $data['clients'] = Clients::where('is_active', 1)->get();
        $data['companies'] = Companies::all();
        $data['projects'] = ClientsProjects::all();
        $data['wared_number'] = $this->testsRepository->getLastFieldValue('wared_number');
        $data['talab_number'] = $this->testsRepository->getLastFieldValue('talab_number');
        $data['book_number'] = $this->testsRepository->getLastFieldValue('book_number');
        $data['test']        =$this->testsRepository->getById($id);
       // dd($data['test']);
        return view($this->root_view . 'edit', $data);
    }
    /***********************************************/
    public function update(SaveRequest $request,$id)
    {
        try {

            $this->externalTestsService->update($request,$id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.external_test.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /************************************************/
    public function delete_external_test($id)
    {
        try {

            $this->externalTestsService->delete($id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.external_test.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
