<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\clients\SaveRequests;
use App\Http\Requests\Admin\clients\updateRequests;
use App\Http\Requests\Admin\company\SaveRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\Branch;
use App\Models\Admin\Employee;
use App\Models\Admin\EmployeeFiles;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;
use App\Services\ClientService;
use App\Services\CompanyService;
use App\Services\ProjectsService;
use App\Traits\ImageProcessing;
use App\Traits\ValidationMessage;
use Illuminate\Http\Request;
use DataTables;

class ClientController extends Controller
{
    use ImageProcessing;
    use ValidationMessage;

    protected $admin_view = 'dashbord.clients';
    protected $AreasSettingRepository;
    protected $ClientsRepository;
    protected $clientService;
    protected $companyService;
    protected $projectsService;
    protected $CompanyRepository;
    protected $ProjectsRepository;

    public function __construct(BasicRepositoryInterface $basicRepository, ClientService $clientService,CompanyService $companyService,ProjectsService $projectsService)
    {
        $this->AreasSettingRepository = createRepository($basicRepository, new AreaSetting());
        $this->ClientsRepository = createRepository($basicRepository, new Clients());
        $this->clientService = $clientService;
        $this->CompanyRepository   = createRepository($basicRepository, new ClientsCompanies());
        $this->ProjectsRepository   = createRepository($basicRepository, new ClientsProjects());
        $this->companyService   = $companyService;
        $this->projectsService   = $projectsService;

    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = Clients::select('*');
            return Datatables::of($allData)
                ->addColumn('action', function ($row) {
                    return '
    <div class="btn-group btn-group-sm">
        <a href="' . route('admin.clients.edit', $row->id) . '" class="btn btn-sm btn-primary" title="' . trans('clients.edit') . '" style="font-size: 16px;">
            <i class="bi bi-pencil-square"></i>
        </a>
        <a onclick="return confirm(\'Are You Sure To Delete?\')"  href="' . route('admin.delete_client', $row->id) . '"  class="btn btn-sm btn-danger" title="' . trans('clients.delete') . '" style="font-size: 16px;" onclick="return confirm(\'' . trans('employees.confirm_delete') . '\')">
            <i class="bi bi-trash3"></i>
        </a>

        <a href="'.route('admin.client_companies',$row->id).'" class="btn btn-sm btn-info" title="' . trans('clients.companies') . '" style="font-size: 16px;">
            <i class="bi bi-building"></i>
        </a>
       <!-- <a href="'.route('admin.client_projects',$row->id).'" class="btn btn-sm btn-secondary" title="' . trans('clients.projects') . '" style="font-size: 16px;">
            <i class="bi bi-kanban"></i>
        </a>
        <a href="#" class="btn btn-sm btn-success" title="' . trans('clients.financials') . '" style="font-size: 16px;">
            <i class="bi bi-cash-coin"></i>
        </a> -->
    </div>
';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
        return view($this->admin_view . '.index');
    }

    /***********************************************/
    public function create()
    {
        $data['client_code'] = $this->ClientsRepository->getLastFieldValue('client_code');
        $data['governates'] = $this->AreasSettingRepository->getBywhere(array('parent_id' => null));
        return view($this->admin_view . '.form', $data);
    }

    /***********************************************/
    public function store(SaveRequests $request)
    {
        try {


            $this->clientService->store($request);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.clients.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /***********************************************/
    public function show(string $id)
    {
        //
    }

    /***********************************************/
    public function edit(string $id)
    {
        $data['client_code'] = $this->ClientsRepository->getLastFieldValue('client_code');
        $data['governates'] = $this->AreasSettingRepository->getBywhere(array('parent_id' => null));
        $data['all_data']=  $this->ClientsRepository->getById($id);
        return view($this->admin_view . '.edit', $data);
    }
    /***********************************************/
    public function update(UpdateRequests $request, string $id)
    {
        try {
            $this->clientService->update($request,$id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.clients.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /***********************************************/
    public function destroy(string $id)
    {
        try {
            $this->ClientsRepository->delete($id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.clients.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**************************************************/
    /**************************************************/
    /**************************************************/
    /**************************************************/
    public function companies($id)
    {
        $data['all_data']     =  $this->ClientsRepository->getById($id);
        $data['company_code'] =  $this->CompanyRepository->getLastFieldValue('company_code');
        $data['companies_data']=$this->CompanyRepository->getBywhere(['client_id'=>$id]);
        $data['projects_data']=$this->ProjectsRepository->getBywhere(['client_id'=>$id]);
        //dd($data['companies_data']);
        return view($this->admin_view . '.company.clients_company', $data);
    }
    /************************************************/
    public function store_company(SaveRequest $request,$client_id)
    {
        try {
           // dd($request);
            $this->companyService->store($request);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.client_companies',$client_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /************************************************/
    public function edit_company($company_id)
    {
        $data['company_data']=$this->CompanyRepository->getById($company_id);
        return view($this->admin_view . '.company.clients_company_edit', $data);
    }
    /************************************************/
    public function update_company(SaveRequest $request,$company_id)
    {
        try {
            // dd($request);
            $this->companyService->update($request,$company_id);
            $company_data=$this->CompanyRepository->getById($company_id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.client_companies',$company_data->client_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**************************************************/
    public function delete_company($company_id)
    {
        try {
            // dd($request);

            $company_data=$this->CompanyRepository->getById($company_id);
            $this->CompanyRepository->delete($company_id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.client_companies',$company_data->client_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /**************************************************/
    /**************************************************/
    /**************************************************/
    /**************************************************/
    public function projects($id)
    {
        $data['all_data']     =  $this->ClientsRepository->getById($id);
        $data['project_code'] =  $this->ProjectsRepository->getLastFieldValue('project_code');
        $data['companies_data']=$this->CompanyRepository->getBywhere(['client_id'=>$id]);
        $data['projects_data']=$this->ProjectsRepository->getBywhere(['client_id'=>$id]);
        $data['client_companies']=$this->CompanyRepository->getBywhere(['client_id'=>$id]);
       // dd($data['projects_data']);
        return view($this->admin_view . '.projects.clients_project', $data);
    }
    /*************************************************/
    public function store_project(\App\Http\Requests\Admin\projects\SaveRequest $request,$client_id)
    {
        try {
            //dd($request);
            $this->projectsService->store($request);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.client_projects',$client_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*************************************************/
    public function edit_project($project_id)
    {
        $data['project_data']=$this->ProjectsRepository->getById($project_id);
        $data['client_companies']=$this->CompanyRepository->getBywhere(['client_id'=>$data['project_data']->client_id]);
        return view($this->admin_view . '.projects.clients_project_edit', $data);
    }
    /*************************************************/
    public function update_project(\App\Http\Requests\Admin\projects\SaveRequest $request,$project_id)
    {
        try {
            // dd($request);
            $this->projectsService->update($request,$project_id);
            $company_data=$this->ProjectsRepository->getById($project_id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.client_projects',$company_data->client_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /*************************************************/
    public function delete_project($id)
    {
        try {
            // dd($request);

            $project_data=$this->ProjectsRepository->getById($id);
            $this->ProjectsRepository->delete($id);
            toastr()->addSuccess(trans('forms.success'));
            return redirect()->route('admin.client_projects',$project_data->client_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
