<?php

namespace Modules\Mwz\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slugs extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'lang', 'slug','meta_title','meta_keywords','meta_description','meta_auther','route','param'];
    protected $table = "slugs";
    protected $primaryKey = "id";
    
    protected static function newFactory()
    {
        return \Modules\Mwz\Database\factories\SlugsFactory::new();
    }

   
}
