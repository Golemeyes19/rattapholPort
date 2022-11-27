<?php

namespace Modules\About\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Abouts extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name_th', 'name_en', 'name1_th', 'name1_en', 'name2_th', 'name2_en', 'description_on_th',
    'description_on_en', 'description_center_th', 'description_center_en', 'description_lower_th', 'description_lower_en',
    'image_top', 'image_on', 'image_center', 'image_lower', 'video_1', 'video_2', 'status', 'created_at', 'updated_at'];
    protected $table = "about";
    protected $primaryKey = "id";

    protected static function newFactory()
    {
        return \Modules\About\Database\factories\AboutsFactory::new();
    }
}
