<?php


namespace App\Services;


use App\Repositories\RoleRepository;
use App\Traits\ImageProcessing;

class RoleService
{
    use ImageProcessing;
    /******************************************************/
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    /*********************************************************/
    public function all()
    {
        return $this->roleRepository->all();
    }
    /**********************************************************/
    public function save($request)
    {
        $validated_data = $request->validated();
        return $this->roleRepository->create($validated_data);
    }
    /***********************************************************/
    public function update($request,$id)
    {
        $validated_data = $request->validated();
        return $this->roleRepository->update($validated_data,$id);
    }
    /***********************************************************/
    public function find($id)
    {
        return $this->roleRepository->find($id);
    }
    /************************************************************/
    public function destroy($id)
    {
        return $this->roleRepository->delete($id);
    }
}
