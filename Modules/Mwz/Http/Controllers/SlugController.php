<?php

namespace Modules\Mwz\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Mwz\Entities\Slugs ;


class SlugController extends Controller
{
    public static function get($slug,$entity_type='') {   
        return  Slugs::where('lang',app()->getLocale())->where('slug',$slug)->where('entity_type',$entity_type)->first();
    }

    public static function create($slug_obj,$entity_id,$entity_type,$img='',$param=[]) {  
        foreach($slug_obj as $lang => $slug){
            $attributes = [];
            $attributes['lang'] = $lang ;
            $attributes['slug'] = $slug['slug'] ;
            $attributes['meta_title'] = $slug['meta_title'] ;
            $attributes['meta_keywords'] = $slug['slug'] ;
            $attributes['meta_description'] = $slug['slug'] ;
            $attributes['meta_robots'] = $slug['meta_robots'] ;
            $attributes['meta_image'] = $slug['meta_image'] ;
            $attributes['entity_id'] = $slug['entity_id'] ;
            $attributes['entity_type'] = $slug['entity_type'] ;
            $attributes['param'] = json_encode($param,JSON_UNESCAPED_UNICODE) ;
            Slugs::create($attributes);
        }
    }

    public static function update($slug_obj,$entity_id,$entity_type,$img='',$param=[]) {  
        foreach($slug_obj as $lang => $slug){
            $attributes = [];
            $attributes['lang'] = $lang ;
            $attributes['slug'] = $slug['slug'] ;
            $attributes['meta_title'] = $slug['meta_title'] ;
            $attributes['meta_keywords'] = $slug['slug'] ;
            $attributes['meta_description'] = $slug['slug'] ;
            $attributes['meta_robots'] = $slug['meta_robots'] ;
            $attributes['meta_image'] = $slug['meta_image'] ;
            $attributes['entity_id'] = $slug['entity_id'] ;
            $attributes['entity_type'] = $slug['entity_type'] ;
            $attributes['param'] = json_encode($param,JSON_UNESCAPED_UNICODE) ;
            Slugs::where('entity_id',$entity_id)->where('entity_type',$entity_type)->update($attributes);
        }
    }

    public static function delete($entity_id,$entity_type) {   
         Slugs::where('entity_id',$entity_id)->where('entity_type',$entity_type)->delete();
    }

    public static function generate_meta_tag($slug,$entity_type='') {    {   
        $slug = Slugs::where('lang',app()->getLocale())->where('slug',$slug)->where('entity_type',$entity_type)->first();
    }


}
