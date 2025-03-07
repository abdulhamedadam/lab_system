<?php

namespace App\Models;

use App\Models\Admin\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTests extends Model
{
    use HasFactory;
    protected $table='client_tests';
    protected $guarded=[];

    /************************************************/
    public function client()
    {
        return $this->belongsTo(ClientsCompanies::class,'client_id','id');
    }

    /***********************************************/
    public function belongsToDynamic()
    {
        if (!$this->test_model || !$this->test_id) {
            return null;
        }
        $modelClass = $this->test_model;
        if (!class_exists($modelClass)) {
            return null;
        }

        return $modelClass::find($this->test_id);
    }
    /**********************************************/
    public function client_test_payment()
    {
        return  $this->hasMany(ClientTestPayment::class,'client_test_id','id');
    }

    public function test()
    {
        return $this->belongsTo(Test::class,'test_id','id');
    }

}
