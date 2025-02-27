<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoilCompactionTest extends Model
{
    use HasFactory;
    protected $table='tbl_soil_compaction_test';
    protected $guarded=[];


    /********************************************************/
    public function compaction_test_details()
    {
        return $this->hasMany(SoilCompactionTestDetails::class,'soil_compaction_test_id','id');
    }
}
