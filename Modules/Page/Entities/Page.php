<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name_th', 'name_en', 'description_th', 'description_en', 'detail_th', 'detail_en', 'image', 'params', 'status', 'sequence', 'created_at', 'updated_at'];
    protected $table = "pages";
    protected $primaryKey = "id";
    
    protected static function newFactory()
    {
        return \Modules\Page\Database\factories\PageFactory::new();
    }
}
