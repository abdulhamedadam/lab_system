<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoilHasaCompactionTest extends Model
{
    use HasFactory;
    protected $table='soil_hasa_compaction_test';
    protected $guarded=[];


   /****************************************************/
    public function compaction_test_details()
    {
        return $this->hasMany(SoilHasaCompactionTestDetails::class,'hasa_compaction_test_id','id');
    }
}
