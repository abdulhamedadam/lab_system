<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\company\SaveRequest;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\AreaSetting;
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

    public function __construct(BasicRepositoryInterface $basicRepository,CompanyService $companyService)
    {
        $this->AreasSettingRepository = createRepository($basicRepository, new AreaSetting());
        $this->ClientsRepository = createRepository($basicRepository, new Clients());
        $this->CompanyRepository   = createRepository($basicRepository, new ClientsCompanies());
        $this->ProjectsRepository   = createRepository($basicRepository, new ClientsProjects());
        $this->companyService   = $companyService;


    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $allData = ClientsCompanies::select('*');
            return Datatables::of($allData)

                ->addColumn('action', function ($row) {
                    return '

    <div class="btn-group btn-group-sm">
        <a href="' . route('admin.company.edit', $row->id) . '" class="btn btn-sm btn-primary" title="' . trans('clients.edit') . '" style="font-size: 16px;">
            <i class="bi bi-pencil-square"></i>
        </a>
        <a onclick="return confirm(\'Are You Sure To Delete?\')"  href="' . route('admin.delete_company', $row->id) . '"  class="btn btn-sm btn-danger" title="' . trans('clients.delete') . '" style="font-size: 16px;" onclick="return confirm(\'' . trans('employees.confirm_delete') . '\')">
            <i class="bi bi-trash3"></i>
        </a>
        <a href="'.route('admin.client_projects',$row->id).'" class="btn btn-sm btn-secondary" title="' . trans('clients.projects') . '" style="font-size: 16px;">
            <i class="bi bi-kanban"></i>
        </a>

    </div>
';
                })
                ->rawColumns(['image', 'action'])
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
            $this->companyService->update($request,$id);
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
}
