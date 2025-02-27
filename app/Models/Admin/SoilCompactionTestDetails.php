<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoilCompactionTestDetails extends Model
{
    use HasFactory;
    protected $table='tbl_soil_compaction_test_details';
    protected $guarded=[];
}
