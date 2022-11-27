<?php

namespace Modules\Banner\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Modules\Banner\Entities\Banner;
use Modules\Menu\Entities\Menus;

class BannerController extends Controller
{
    /**
     * Function : Get home banner
     * Dev : Dave
     * Update Date : 02 Nov. 2021
     * @param POST
     * @return array of banner
    */
    public function getBannerHome()
    {
        $data = [];
        $banner = Banner::where('status',1)->where('menu_id',1)->orderBy('sequence','ASC')->get();
        if(!empty($banner)){
            foreach($banner as $k => $v){

                $data[$k]['id'] = $v->id;

                if( empty(App::currentLocale()) || App::currentLocale() == 'th' ){
                    $data[$k]['image'] = $v->image;
                    $data[$k]['image_2'] = $v->image_2;
                    $data[$k]['name'] = $v->name_th;
                }else{
                    $data[$k]['image'] = $v->image;
                    $data[$k]['image_2'] = $v->image_2;
                    $data[$k]['name'] = $v->name_en;
                }
            }
        }
        return $data;
    }

    /**
     * Function : Get banner Us Info
     * Dev : Joe
     * Update Date : 18 Nov 2021
     * @param POST
     * @return response of banner us info
    */
    public function getBannerInfo(){

    	$data = [];
    	$banner = Banner::find(1);
    	if(!empty($banner)){

    		if(app()->getLocale() == '' || app()->getLocale() == 'th'){
                $data['name_th'] = $banner->name_th;
    			$data['description'] = mwz_getTextString($banner->description_th);
                $data['link_th'] = $banner->link_th;

    		}else{
                $data['name_en'] = $banner->name_en;
    			$data['description'] = mwz_getTextString($banner->description_en);
                $data['link_en'] = $banner->link_en;
    		}
    		$data['image'] = $banner->image;
            $data['image_2'] = $banner->image_2;
    		$data['image_3'] = $banner->image_3;

    	}

    	return $data;

    }

    /**
     * Function : Get banner Us Info
     * Dev : Poom
     * Update Date : 19 Jan 2022 
     * @param POST
     * @return response of banner us info
    */
    public function findBannerInfo()
    {
        $data = [];
        $data['items'] = [];
        $banner = Banner::where('status', 1)->get();
        if (!empty($banner)) {
            foreach ($banner as $item) {
                $data['items'][$item->id]['id'] = $item->id;
                if (empty(App::currentLocale()) || App::currentLocale() == 'th') {
                    $data['items'][$item->id]['name'] = $item->name_th;
                    $data['items'][$item->id]['description'] = mwz_getTextString($item->description_th);
                    $data['items'][$item->id]['link'] = $item->link_th;
                } else {
                    $data['items'][$item->id]['name'] = $item->name_en;
                    $data['items'][$item->id]['description'] = mwz_getTextString($item->description_en);
                    $data['items'][$item->id]['link'] = $item->link_en;
                }
                $data['items'][$item->id]['image'] = $item->image;
                $data['items'][$item->id]['image_2'] = $item->image_2;
                $data['items'][$item->id]['image_3'] = $item->image_3;
            }
        }
        return $data;
    }
}
