<?php

namespace Modules\Pdpa\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pdpas extends Model
{
    use HasFactory;

    protected $fillable = ['id','pdpa_title_th','pdpa_title_en','pdpa_detail_th','pdpa_detail_en','pdpa_detail_long_th','pdpa_detail_long_en','status'
    ,'created_by','created_at','updated_by','updated_at'];
    protected $table = "pdpa";
    protected $primaryKey = "id";

    protected static function newFactory()
    {
        return \Modules\Pdpa\Database\factories\PdpasFactory::new();
    }
}
