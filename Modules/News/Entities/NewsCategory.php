<?php

namespace Modules\News\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;

class NewsCategory extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $fillable = ['id', 'name_th', 'name_en', 'description_th', 'description_en', 'image_th', 'image_th', 'status', 'slug_th', 'slug_en', '_lft', '_rgt', 'parent_id', 'created_at', 'updated_at'];
    protected $table = "news_category";
    protected $primaryKey = "id";

    public function childs() {
        return $this->hasMany('\Modules\News\Entities\NewsCategory','parent_id','id') ;
    }
    
    protected static function newFactory()
    {
        return \Modules\News\Database\factories\NewsCategoryFactory::new();
    }
}
