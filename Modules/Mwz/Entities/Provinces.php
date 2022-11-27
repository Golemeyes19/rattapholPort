<?php

namespace Modules\Mwz\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provinces extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'code', 'name_th','name_en'];
    protected $table = "mwz_provinces";
    protected $primaryKey = "id";
    
    protected static function newFactory()
    {
        return \Modules\Mwz\Database\factories\ProvincesFactory::new();
    }
}
