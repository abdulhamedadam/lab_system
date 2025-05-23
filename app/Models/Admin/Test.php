<?php

namespace App\Models\Admin;

use App\Models\Admin as AdminModel;
use App\Models\Clients;
use App\Models\ClientsCompanies;
use App\Models\ClientsProjects;
use App\Models\Companies;
use App\Models\TestSader;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $table = 'tbl_tests';

    protected $guarded=[];

    public function client()
    {
        return $this->belongsTo(Clients::class,'client_id','id');
    }

    public function company()
    {
        return $this->belongsTo(Companies::class,'company_id','id');
    }

    public function project()
    {
        return $this->belongsTo(ClientsProjects::class, 'project_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(AdminModel::class, 'created_by');
    }
    /******************************************/
    public function sader()
    {
        return $this->belongsTo(TestSader::class,'sader_id','id');
    }

}
