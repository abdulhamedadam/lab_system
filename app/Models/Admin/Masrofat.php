<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masrofat extends Model
{
    use HasFactory;

    protected $table   ='tbl_masrofat';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function sarf_band()
    {
        return $this->belongsTo(SarfBand::class, 'band_id');
    }

}
