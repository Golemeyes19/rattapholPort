<?php

namespace Modules\Mwz\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cities extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'code', 'name_th','name_en'];
    protected $table = "mwz_cities";
    protected $primaryKey = "id";
    
    protected static function newFactory()
    {
        return \Modules\Mwz\Database\factories\CitiesFactory::new();
    }

     public function province()
    {
        return $this->hasOne('Modules\Mwz\Entities\Provinces','id','province_id');
    }
}
