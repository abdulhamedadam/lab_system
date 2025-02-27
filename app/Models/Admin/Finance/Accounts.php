<?php

namespace App\Models\Admin\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Translatable\HasTranslations;

class Accounts extends Model
{
    use HasTranslations;
    use HasFactory;
    use NodeTrait;
    protected $guarded=[];
    protected $table ='fr_accounts';
    public $translatable = ['name'];


    function parent_data()
    {
        return $this->belongsTo(Accounts::class, 'parent_id');
    }

    function children_data()
    {
        return $this->hasMany(Accounts::class, 'parent_id');
    }



}
