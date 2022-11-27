<?php

namespace Modules\Pdpa\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PdpaDetails extends Model
{
    use HasFactory;

    protected $fillable = ['id','member_id','pdpa_ip','pdpa_user_agent','pdpa_user_status','created_at','updated_at'];
    protected $table = "pdpa_detail";
    protected $primaryKey = "id";

    protected static function newFactory()
    {
        return \Modules\Pdpa\Database\factories\PdpaDetailsFactory::new();
    }
}
