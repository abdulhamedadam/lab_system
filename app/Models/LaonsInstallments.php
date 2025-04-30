<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaonsInstallments extends Model
{
    use HasFactory;
    protected $table='loans_installments';
    protected $guarded=[];
}
