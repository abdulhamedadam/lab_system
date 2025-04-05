<?php

namespace App\Models;

use App\Models\Admin\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSader extends Model
{
    use HasFactory;
    protected $table='tbl_sader';
    protected $guarded=[];


    /******************************************************/
    public function test()
    {
        return $this->hasOne(Test::class,'sader_id','id');
    }
}
