<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\clients\SaveRequests;
use App\Http\Requests\Admin\clients\updateRequests;
use App\Interfaces\BasicRepositoryInterface;
use App\Models\Admin\AreaSetting;
use App\Models\Admin\Branch;
use App\Models\Admin\Employee;
use App\Models\Admin\EmployeeFiles;
use App\Models\Clients;
use App\Services\ClientService;
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

    public function __construct(BasicRepositoryInterface $basicRepository, ClientService $clientService)
    {
        $this->AreasSettingRepository = createRepository($basicRepository, new AreaSetting());
        $this->ClientsRepository = createRepository($basicRepository, new Clients());
        $this->clientService = $clientService;

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

        <a href="#" class="btn btn-sm btn-info" title="' . trans('clients.companies') . '" style="font-size: 16px;">
            <i class="bi bi-building"></i>
        </a>
        <a href="#" class="btn btn-sm btn-secondary" title="' . trans('clients.projects') . '" style="font-size: 16px;">
            <i class="bi bi-kanban"></i>
        </a>
        <a href="#" class="btn btn-sm btn-success" title="' . trans('clients.financials') . '" style="font-size: 16px;">
            <i class="bi bi-cash-coin"></i>
        </a>
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
}
