<?php

namespace App\Models;

use App\Models\Admin\AreaSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $table='tbl_clients';
    protected $guarded=[];


    public function scopeLastClientCode($query)
    {
        return $query->orderBy('id', 'desc')->pluck('client_code')->first();
    }

    public function city_data()
    {
        return $this->belongsTo(AreaSetting::class, 'city');
    }

    public function governate_data()
    {
        return $this->belongsTo(AreaSetting::class, 'governate');
    }
}
