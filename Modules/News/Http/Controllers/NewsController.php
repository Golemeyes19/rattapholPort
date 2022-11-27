<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

use Modules\News\Entities\NewsCategory;
use Modules\News\Entities\News;
use Modules\Mwz\Http\Controllers\MwzController;

class NewsController extends Controller
{

    /**
     * Function : Get news category
     * Dev : Jang
     * Update Date : 22 Nov 2021
     * @param GET
     * @return array of news
    */
    public function getNewsCategory(){
        $data = [];
        $news = NewsCategory::where('status',1)->limit(4)->get();
        if(!empty($news)){
            foreach($news as $k => $v){

                $data['data_news_cat'][$k]['id'] = $v->id;

                if(empty(App::currentLocale()) || App::currentLocale() == 'th'){
                    $data['data_news_cat'][$k]['name'] = $v->name_th;
                    $data['data_news_cat'][$k]['slug_name'] = $v->slug_th;
                    $data['data_news_cat'][$k]['image'] = $v->image_th;
                }else{
                    $data['data_news_cat'][$k]['name'] = $v->name_en;
                    $data['data_news_cat'][$k]['slug_name'] = $v->slug_en;
                    $data['data_news_cat'][$k]['image'] = $v->image_en;
                }
            
            }
        }
        // dd($data['data_news_cat']);

        $respone = [
            'data_news'=>$data['data_news_cat'], 
        ];

        dd($respone);

        // echo "<pre>";
        // print_r($data);

        return $respone;
    }

    /**
     * Function : Get news all
     * Dev : Jang
     * Update Date : 22 Nov 2021
     * @param GET
     * @return array of news
    */
    public function getNewsAll($category_id = 1, $cur_page = 1){

        // GET NEWS FROM CATEGORY
        $all_news_rows = News::where('id_news_category', $category_id)
                                ->where('status', 1)
                                ->count();
        // dd($all_news_rows);

        $data_per_page = 8;
        $data_offset = ($cur_page-1) * $data_per_page;
        $pages_total = ceil((int)$all_news_rows/$data_per_page);


        $data = [];
        $news = News::where('status',1)
            ->where('id_news_category', $category_id)
            ->limit($data_per_page)
            ->offset($data_offset)
            ->get();
        
        if(!empty($news)){
            foreach($news as $k => $v){

                $data['data_news'][$k]['id'] = $v->id;
                $data['data_news'][$k]['image'] = $v->image;

                if(empty(App::currentLocale()) || App::currentLocale() == 'th'){
                    $data['data_news'][$k]['name'] = $v->name_th;
                    $data['data_news'][$k]['slug_name'] = $v->slug_th;
                }else{
                    $data['data_news'][$k]['name'] = $v->name_en;
                    $data['data_news'][$k]['slug_name'] = $v->slug_en;
                }
           
            }
        }
        // dd($data['data_news']);

        $respone = [
            'data_news'=>$data['data_news'],
            'pages_total'=>$pages_total, 
        ];

        dd($respone);

        return $respone;
    }

    /**
     * Function : Get Detail News
     * Dev : Jang
     * Update Date : 22 Nov 2021
     * @param GET
     * @return array of news
    */
    public function getDetailNews($slug_name = "testth")
    {

        if( empty(App::currentLocale()) || App::currentLocale() == 'th'){
            $newsData = News::where('slug_th', $slug_name)
                            ->get()[0];
        }else if(App::currentLocale() == 'en'){
            $newsData = News::where('slug_en', $slug_name)
                            ->get()[0];
        }

        // dd($newsData);

        // NOT FOUND CATEGORY DATA
        if(empty($newsData)){ 
            return abort(404);
        }else{
            $data = [];
            $data['id'] = $newsData->id;
            if( empty(App::currentLocale()) || App::currentLocale() == 'th'){
                $data['name'] =  $newsData->name_th;
                $data['description'] =  mwz_getTextString($newsData->description_th);
            }else{
                $data['name'] =  $newsData->name_en;
                $data['description'] =  mwz_getTextString($newsData->description_th);
            }
            $data['slug_name'] = $slug_name;
            $data['image'] = $newsData->image;
            $data['publish_at'] = $newsData->publish_at;
            $data['id_news_category'] = $newsData->id_news_category;
        }
        // END : NOT FOUND CATEGORY DATA

        dd($data);

        return $data;
    }
}
