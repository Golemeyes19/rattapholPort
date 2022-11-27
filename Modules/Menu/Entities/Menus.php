<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;

class Menus extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $fillable = ['id', 'name_th', 'name_en', 'slug_th', 'slug_en', 'type', 'sequence', 'status', 'parent_id', 'created_at', 'updated_at'];
    protected $table = "menu";
    protected $primaryKey = "id";

    public function childs() {
        return $this->hasMany('\Modules\Menu\Entities\Menus','parent_id','id') ;
    }

    protected static function newFactory()
    {
        return \Modules\Menu\Database\factories\MenusFactory::new();
    }
}
