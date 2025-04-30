<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;
    protected $table  ='tbl_companies';
    protected $guarded=[];

    /*****************************************/
    public function client_company()
    {
        return $this->hasMany(ClientsCompanies::class,'company_id','id');
    }
    /********************************************/

}
