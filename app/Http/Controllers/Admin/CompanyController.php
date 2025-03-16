<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\company\SaveRequest;
use App\Http\Requests\Admin\projects\CompanyClientRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\Employee;
use App\Models\Admin\Test;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;
use App\Models\ClientTestPayment;
use App\Models\ClientTests;
use App\Services\ClientService;
use App\Services\CompanyService;
use App\Services\ExternalTestsService;
use App\Services\Payments\ClientPaymentService;
use App\Services\Payments\DuesService;
use App\Services\ProjectsService;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    protected $admin_view = 'dashbord.company';
    protected $AreasSettingRepository;
    protected $ClientsRepository;
    protected $clientService;
    protected $companyService;
    protected $CompanyRepository;
    protected $ProjectsRepository;
    protected $projectsService;
    protected $TestsRepository;

    public function __construct(BasicRepositoryInterface $basicRepository, CompanyService $companyService, ProjectsService $projectsService, DuesService $duesService,ExternalTestsService $externalTestsService)
    {
        $this->AreasSettingRepository = createRepository($basicRepository, new AreaSetting());
        $this->ClientsRepository = createRepository($basicRepository, new Clients());
        $this->CompanyRepository   = createRepository($basicRepository, new ClientsCompanies());
        $this->ProjectsRepository   = createRepository($basicRepository, new ClientsProjects());
        $this->TestsRepository   = createRepository($basicRepository, new Test());
        $this->companyService   = $companyService;
        $this->projectsService   = $projectsService;
        $this->duesService   = $duesService;
        $this->externalTestsService   = $externalTestsService;

    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = ClientsCompanies::select('*')->OrderBy('id','desc')->get();
            return Datatables::of($allData)
                ->editColumn('name', function ($row) {
                    return '<a href="'.route('admin.company_projects', $row->id).'" class="text-primary fw-bold">'.$row->name.'</a>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="btn-group btn-group-sm">
                            <a href="' . route('admin.company.edit', $row->id) . '" class="btn btn-sm btn-primary" title="' . trans('company.edit') . '" style="font-size: 16px;">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a onclick="return confirm(\'Are You Sure To Delete?\')"  href="' . route('admin.delete_company', $row->id) . '"  class="btn btn-sm btn-danger" title="' . trans('company.delete') . '" style="font-size: 16px;" onclick="return confirm(\'' . trans('employees.confirm_delete') . '\')">
                                <i class="bi bi-trash3"></i>
                            </a>
                            <a href="' . route('admin.company_projects', $row->id) . '" class="btn btn-sm btn-secondary" title="' . trans('company.projects') . '" style="font-size: 16px;">
                                <i class="bi bi-kanban"></i>
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['image', 'action','name'])
                ->make(true);
        }
        return view($this->admin_view . '.index');
    }

    /********************************************/
    public function create()
    {
        $data['company_code'] = $this->CompanyRepository->getLastFieldValue('company_code');
        $data['clients']      = $this->ClientsRepository->getAll();
        return view($this->admin_view . '.form', $data);
    }

    /********************************************/
    public function store(SaveRequest $request)
    {
        try {
            $this->companyService->store($request);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.company.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /********************************************/
    public function show(string $id)
    {
        //
    }

    /********************************************/
    public function edit(string $id)
    {
        $data['all_data']     = $this->CompanyRepository->getById($id);
        $data['clients']      = $this->ClientsRepository->getAll();
        return view($this->admin_view . '.edit', $data);
    }

    /********************************************/
    public function update(SaveRequest $request, string $id)
    {
        try {
            $this->companyService->update($request, $id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.company.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /********************************************/
    public function destroy(string $id)
    {
        try {
            $this->CompanyRepository->delete($id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.company.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**************************************************/
    public function projects($id)
    {
        $data['all_data']        =  $this->CompanyRepository->getById($id);
        $data['project_code']    =  $this->ProjectsRepository->getLastFieldValue('project_code');
        $data['clients_data']    =  $this->ClientsRepository->getAll();
        $data['projects_data']   =  $this->ProjectsRepository->getBywhere(['company_id' => $id]);
        $data['company_clients'] =  $this->ClientsRepository->getAll();
        $data['tests_data']      =  $this->TestsRepository->getBywhere(['company_id' => $id]);
        $data['all_dues']        =  ClientTests::where('client_id', $id)->sum('test_value');
        $data['paid_dues']       =  ClientTests::where('client_id', $id)
            ->with('client_test_payment')
            ->get()
            ->sum(function ($test) {
                return $test->client_test_payment->sum('value');
            });

        //dd( $data['paid_dues'] );
        return view($this->admin_view . '.projects.company_project', $data);
    }
    /*************************************************/
    public function store_project(CompanyClientRequest $request, $company_id)
    {
        try {
            // dd($request->all());
            $this->projectsService->store($request);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.company_projects', $company_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*************************************************/
    public function edit_project($project_id)
    {
        $data['project_data'] = $this->ProjectsRepository->getById($project_id);
        $data['company_clients'] = $this->ClientsRepository->getAll();

        return view($this->admin_view . '.projects.company_project_edit', $data);
    }
    /*************************************************/
    public function update_project(CompanyClientRequest $request, $project_id)
    {
        try {
            $this->projectsService->update($request, $project_id);
            $company_data = $this->ProjectsRepository->getById($project_id);
            // dd($company_data);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.company_projects', $company_data->company_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*************************************************/
    public function delete_project($id)
    {
        try {
            $project_data = $this->ProjectsRepository->getById($id);
            $this->ProjectsRepository->delete($id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.company_projects', $project_data->company_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************************/
    public function tests($id)
    {
        $data['all_data']        =  $this->CompanyRepository->getById($id);
        $data['project_code']    =  $this->ProjectsRepository->getLastFieldValue('project_code');
        $data['clients_data']    =  $this->ClientsRepository->getAll();
        $data['projects_data']   =  $this->ProjectsRepository->getBywhere(['company_id' => $id]);
        $data['company_clients'] =  $this->ClientsRepository->getAll();
        $data['tests_data']      =  $this->TestsRepository->getBywhere(['company_id' => $id]);
        $data['external_test']   =  $this->externalTestsService->get_company_test($id);
      //  dd($data['external_test']);
        $data['dues_data']       = $this->duesService->get_company_dues($id);
        // dd( $data['dues_data']);
        $data['all_dues']        =  ClientTests::where('client_id', $id)->sum('test_value');
        $data['paid_dues']      = ClientTests::where('client_id', $id)
            ->with('client_test_payment')
            ->get()
            ->sum(function ($test) {
                return $test->client_test_payment->sum('value');
            });
        // dd($data);
        //dd( $data['paid_dues'] );
        return view($this->admin_view . '.tests.all_test', $data);
    }
    /********************************************************/
    public function dues($id)
    {
        $data['all_data']        =  $this->CompanyRepository->getById($id);
        $data['project_code']    =  $this->ProjectsRepository->getLastFieldValue('project_code');
        $data['clients_data']    =  $this->ClientsRepository->getAll();
        $data['projects_data']   =  $this->ProjectsRepository->getBywhere(['company_id' => $id]);
        $data['company_clients'] =  $this->ClientsRepository->getAll();
        $data['tests_data']      =  $this->TestsRepository->getBywhere(['company_id' => $id]);
        $data['dues_data']       = $this->duesService->get_company_dues($id);
        // dd( $data['dues_data']);
        $data['all_dues']        =  ClientTests::where('client_id', $id)->sum('test_value');
        $data['paid_dues']      = ClientTests::where('client_id', $id)
            ->with('client_test_payment')
            ->get()
            ->sum(function ($test) {
                return $test->client_test_payment->sum('value');
            });
        // dd($data);
        //dd( $data['paid_dues'] );
        return view($this->admin_view . '.dues.all_dues', $data);
    }
    /*****************************************************/
    public function due_details($id, $due_id)
    {
        Log::info('Due Details Request:', ['id' => $id, 'due_id' => $due_id]);
        $data['dues'] = ClientTestPayment::where('client_test_id', $due_id)->get();
        Log::info('Dues Data:', $data['dues']->toArray());
        // dd($data);
        return view($this->admin_view . '.dues.dues_payment', $data);
    }
    /*****************************************************/
    public function pay_dues($id)
    {
        $data['all_data']        =  $this->CompanyRepository->getById($id);
        $data['project_code']    =  $this->ProjectsRepository->getLastFieldValue('project_code');
        $data['clients_data']    =  $this->ClientsRepository->getAll();
        $data['projects_data']   =  $this->ProjectsRepository->getBywhere(['company_id' => $id]);
        $data['company_clients'] =  $this->ClientsRepository->getAll();
        $data['tests_data']      =  $this->TestsRepository->getBywhere(['company_id' => $id]);
        $data['dues_data']       = $this->duesService->get_company_dues($id);
        // dd( $data['dues_data']);
        $data['all_dues']        =  ClientTests::where('client_id', $id)->sum('test_value');
        $data['paid_dues']      = ClientTests::where('client_id', $id)
            ->with('client_test_payment')
            ->get()
            ->sum(function ($test) {
                return $test->client_test_payment->sum('value');
            });
        return view($this->admin_view.'.dues.pay_dues',$data);
    }
    /*****************************************************/
    public function company_prepare_amount(Request $request, $id)
    {
        $dues = $this->duesService->get_unfinished_dues($id);
        $amountToPay = $request->amount;
        $paidDues = [];

        $data['invoice_num'] = ClientTestPayment::latest('num')->value('num') + 1;
        foreach ($dues as $due) {
            $totalPaid = $due->client_test_payment->sum('value');
            $remaining = $due->test_value - $totalPaid;

            if ($amountToPay > 0 && $remaining > 0) {
                if ($amountToPay >= $remaining) {
                    $due->pay_now = $remaining;
                    $due->remain_after = 0;
                    $amountToPay -= $remaining;
                } else {
                    $due->pay_now = $amountToPay;
                    $due->remain_after = $remaining - $amountToPay;
                    $amountToPay = 0;
                }

                if ($due->pay_now > 0) {
                    $paidDues[] = $due;
                }
            }
        }

        $data['dues'] = $paidDues;
     //   dd($data['dues']);
        $data['amount'] = $request->amount;
        $data['all_emps']=Employee::all();
        return view($this->admin_view . '.dues.prepared_from', $data);
    }
    /*****************************************************/
    public function save_payment_pay_dues(Request $request,$id,ClientPaymentService $clientPaymentService)
    {
        try {
            $clientPaymentService->save_company_pay_dues($request,$id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.company_projects', $id);

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*****************************************************/
    public function account_statement($id)
    {
        $data['all_data']        =  $this->CompanyRepository->getById($id);
        $data['project_code']    =  $this->ProjectsRepository->getLastFieldValue('project_code');
        $data['clients_data']    =  $this->ClientsRepository->getAll();
        $data['projects_data']   =  $this->ProjectsRepository->getBywhere(['company_id' => $id]);
        $data['company_clients'] =  $this->ClientsRepository->getAll();
        $data['tests_data']      =  $this->TestsRepository->getBywhere(['company_id' => $id]);
        $data['dues_data']       = $this->duesService->get_company_dues($id);
        $data['all_dues']        =  ClientTests::where('client_id', $id)->sum('test_value');
        $data['paid_dues']      = ClientTests::where('client_id', $id)
            ->with('client_test_payment')
            ->get()
            ->sum(function ($test) {
                return $test->client_test_payment->sum('value');
            });
        //dd($data['dues_data']);
        return view($this->admin_view.'.dues.account_statement',$data);
    }


}
