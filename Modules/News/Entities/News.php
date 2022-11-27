<?php

namespace Modules\News\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name_th', 'name_en', 'description_th', 'description_en', 'slug_th', 'slug_en', 'image', 'params', 'status', 'sequence', 'author', 'publish_at', 'id_news_category', 'created_at', 'updated_at'];
    protected $table = "news";
    protected $primaryKey = "id";

    protected static function newFactory()
    {
        return \Modules\News\Database\factories\NewsFactory::new();
    }
}
