<?php

namespace Modules\Banner\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'menu_id', 'name_th', 'name_en', 'description_th', 'description_en', 'image', 'image_2', 'image_3', 'sequence', 'status', 'created_at', 'updated_at'];
    protected $table = "banner";
    protected $primaryKey = "id";
    
    protected static function newFactory()
    {
        return \Modules\Banner\Database\factories\BannersFactory::new();
    }
}
