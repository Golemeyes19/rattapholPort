<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuGroups extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'updated_at'];
    protected $table = "menu_group";
    protected $primaryKey = "id";

    protected static function newFactory()
    {
        return \Modules\Menu\Database\factories\MenuGroupsFactory::new();
    }
}
