<?php

namespace App\Models\Admin\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentVoucher extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='fr_sand_sarf';
    protected $guarded=[];


}
