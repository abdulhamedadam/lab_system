<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\roles\SaveRequest;
use App\Http\Requests\Admin\roles\UpdateRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $base_view='dashbord.users.roles.';
    /****************************************/
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
    /*****************************************/
    public function index()
    {
        $data['roles']=$this->roleService->all();
        return view($this->base_view.'index',$data);
    }
    /******************************************/
    public function create()
    {
        return view($this->base_view.'create');
    }

    /****************************************/
    public function store(SaveRequest $request)
    {
        try {
            // dd($request);

            $this->roleService->save($request);
            $request->session()->flash('toastMessage', trans('added_successfully'));
            return redirect()->route('admin.roles.index');

        } catch (\Exception $e) {
            test($e->getMessage());
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
        $data['record']=$this->roleService->find($id);
        return view($this->base_view.'edit',$data);
    }
    /******************************************/
    public function update(UpdateRequest $request,$id)
    {
        try {
            // dd($request);

            $this->roleService->update($request,$id);
            $request->session()->flash('toastMessage', trans('added_successfully'));
            return redirect()->route('admin.roles.index');

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

            $this->roleService->destroy($id);
            $request->session()->flash('toastMessage', trans('added_successfully'));
            return redirect()->route('admin.roles.index');

        } catch (\Exception $e) {
            test($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    /************************************************/
    public function permissions(PermissionService $permissionService,$id)
    {
        $data['permissions']=$permissionService->all();
        //  dd($data['permissions']);
        $data['role']    =Role::findById($id);
        $data['rolePermissions'] = $data['role'] ->permissions->pluck('id')->toArray();
        return view($this->base_view.'permissions',$data);
    }
    /*************************************************/
    public function save_role_permissions(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $role = Role::findOrFail($id);

            $permissions = Permission::whereIn('id', $request->input('permissions', []))->pluck('name')->toArray();
            // dd($permissions);
            $role->syncPermissions([]);
            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }

            DB::commit();

            return redirect()->route('admin.roles.index')
                ->with('success', trans('roles.permissions_updated_successfully'));
        } catch (\Exception $e) {

            DB::rollBack();
            dd('Error updating role permissions: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', trans('roles.error_updating_permissions'))
                ->withInput();
        }
    }

}
