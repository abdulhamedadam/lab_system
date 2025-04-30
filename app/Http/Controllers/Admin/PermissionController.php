<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Permission\SaveRequest;
use App\Http\Requests\Admin\Permission\UpdateRequest;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    protected $base_view='dashbord.users.permission.';
    /****************************************/
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    /*****************************************/
    public function index()
    {
        $data['permissions']=$this->permissionService->all();
        return view($this->base_view.'index',$data);
    }
    /******************************************/
    public function create()
    {
        $data['permissions'] = Permission::whereNull('parent_id')->get();
        return view($this->base_view.'create',$data);
    }

    /****************************************/
    public function store(SaveRequest $request)
    {
        try {
            //   dd($request);

            $this->permissionService->create($request);
            $request->session()->flash('toastMessage', trans('added_successfully'));
            return redirect()->route('admin.permissions.index');

        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /****************************************/
    public function show(string $id)
    {
        //
    }

    /****************************************/
    public function edit(string $id)
    {
        $data['record']=$this->permissionService->find($id);
        return view($this->base_view.'edit',$data);
    }
    /******************************************/
    public function update(UpdateRequest $request,$id)
    {
        try {
            // dd($request);

            $this->permissionService->update($request,$id);
            $request->session()->flash('toastMessage', trans('added_successfully'));
            return redirect()->route('admin.permissions.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /*********************************************/
    public function destroy(Request $request,$id)
    {
        try {
            // dd($request);

            $this->permissionService->delete($id);
            $request->session()->flash('toastMessage', trans('added_successfully'));
            return redirect()->route('admin.permissions.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
