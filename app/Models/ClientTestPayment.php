<?php

namespace App\Models;

use App\Models\Admin\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTestPayment extends Model
{
    use HasFactory;
    protected $table='tbk_client_tests_payment';
    protected $guarded=[];

    /***********************************************/
    public function receivable()
    {
        return $this->belongsTo(Employee::class,'received_by','id');
    }
    /***********************************************/
    public function creator()
    {
        return $this->belongsTo(Admin::class,'created_by','id');
    }

    public function client_test(){
        return $this->belongsTo(ClientTests::class,'client_test_id','id');
    }

    public function company()
    {
        return $this->belongsTo(Companies::class,'client_id','id');
    }
}
