<?php


namespace App\Services;


use App\Repositories\AdminRepository;
use App\Repositories\PermissionRepository;
use App\Traits\ImageProcessing;

class PermissionService
{
    use ImageProcessing;

    /***************************************************************/
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /****************************************************************/
    public function all()
    {
        return $this->permissionRepository->all();
    }

    /*****************************************************************/
    public function find($id)
    {
        return $this->permissionRepository->find($id);
    }

    /******************************************************************/
    public function create($request)
    {
        $validated_data = $request->validated();
        $validated_data['parent_id']=$request->parent_id;
        //dd($validated_data);
        return $this->permissionRepository->create($validated_data);
    }

    /*******************************************************************/
    public function update($request, $id)
    {
        return $this->permissionRepository->update($request, $id);
    }

    /********************************************************************/
    public function delete($id)
    {
        return $this->permissionRepository->delete($id);
    }


}
