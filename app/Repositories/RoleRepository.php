<?php


namespace App\Repositories;


use App\Interfaces\RoleInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleInterface
{

    public function all()
    {
        return Role::all();
    }

    /***********************************/
    public function create($data)
    {
        return Role::create($data);
    }
    /************************************/
    public function find($id)
    {
        return Role::find($id);
    }
    /************************************/
    public function update($data,$id)
    {
      $role=$this->find($id);
      return $role->update($data);
    }
    /************************************/
    public function delete($id)
    {
        $role=$this->find($id);
        return $role->delete();
    }
}
