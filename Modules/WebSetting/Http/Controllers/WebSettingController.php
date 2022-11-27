<?php

namespace Modules\WebSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

use Modules\WebSetting\Entities\WebSettings;

class WebSettingController extends Controller
{
    /**
     * Function : Get websetting story
     * Dev : Dave
     * Update Date : 02 Nov. 2021
     * @param POST
     * @return array of websetting story
    */
    public function getStory(){
        $data = [];
        $promotion = WebSettings::all();
        if(!empty($promotion)){
            foreach($promotion as $k => $v){

                $data[$k]['id'] = $v->id;

                if( empty(App::currentLocale()) || App::currentLocale() == 'th' ){
                    $data[$k]['story'] = mwz_getTextString($v->our_story_th);
                }else{
                    $data[$k]['story'] = mwz_getTextString($v->our_story_en);
                }
            }
        }
        return $data;
    }

    public function getCompany()
    {
        $data = [];
        $promotion = WebSettings::all();
        if (!empty($promotion)) {
            foreach ($promotion as $k => $v) {

                $data[$k]['id'] = $v->id;
                $data[$k]['link_login'] = $v->link_login;
                $data[$k]['logo_header'] = $v->logo_header;
                $data[$k]['logo_footer'] = $v->logo_footer;
                // $data[$k]['meta_title'] = $v->meta_title;
                // $data[$k]['meta_keywords'] = $v->meta_keywords;
                // $data[$k]['meta_description'] = $v->meta_description;
                // $data[$k]['seo_image'] = $v->seo_image;
                // $data[$k]['google_analytics'] = $v->meta_title;
                if (empty(App::currentLocale()) || App::currentLocale() == 'th') {
                    $data[$k]['company_name'] = $v->companyname_th;
                    $data[$k]['head_office'] = $v->head_office_th;
                    // $data[$k]['privacy'] = $v->privacy_th;
                } else {
                    $data[$k]['company_name'] = $v->companyname_en;
                    $data[$k]['head_office'] = $v->head_office_en;
                    // $data[$k]['privacy'] = $v->privacy_en;
                }
            }
        }
        return $data;
    }
}
