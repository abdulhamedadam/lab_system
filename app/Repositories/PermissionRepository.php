<?php


namespace App\Repositories;


use App\Interfaces\PermissionInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionInterface
{


    public function all()
    {
        // return Permission::whereNull('parent_id')->with('children')->get();
        return Permission::whereNull('parent_id')->with('children')->get();
    }
    /***********************************/
    public function find($id)
    {
        return Permission::findById($id);
    }
    /************************************/
    public function create($data)
    {

        return Permission::create($data);
    }
    /**************************************/
    public function update($data,$id)
    {
        $pemission=$this->find($id);
        return $pemission->update($data);
    }
    /****************************************/
    public function delete($id)
    {
        $pemission=$this->find($id);
        return $pemission->delete();
    }
}
