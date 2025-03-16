<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalTests extends Model
{
    use HasFactory;

    protected $table = 'tbl_external_tests';
    protected $guarded = [];
    const PERCENTAGE = 'p';

    const VALUE = 'v';


    const DISCOUNT_ARR = [
        self::PERCENTAGE => 'percentage',
        self::VALUE => 'value',
    ];


    public function client()
    {
        return $this->belongsTo(Clients::class,'client_id','id');
    }

    public function company()
    {
        return $this->belongsTo(ClientsCompanies::class,'company_id','id');
    }

    public function project()
    {
        return $this->belongsTo(ClientsProjects::class, 'project_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

}
