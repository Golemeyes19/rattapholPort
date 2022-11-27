<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

use Yajra\DataTables\Facades\DataTables;
use Modules\Menu\Entities\Menus;


class MenuController extends Controller
{
    public function index()
    {
        return view('menu::menu');
    }

    /**
     * Function :  getmenu
     * Dev : Jang
     * Update Date : 19 Nov 2021
     * @param POST
     * @return json get menu
     */
    public function getmenu()
    {

        $data = [];
        $query_menu_header = Menus::where('parent_id', '=', null )->where('type', '=', 1 )->where('status', 1 )->get();
        $query_menu_footer = Menus::where('parent_id', '=', null )->where('type', '=', 2 )->where('status', 1 )->get();

        //GET MENU HEADER
        if(!empty($query_menu_header)){
            foreach($query_menu_header as $k => $v){
                $data['data_header'][$k]['id'] = $v->id;
                if(empty(App::currentLocale()) || App::currentLocale() == 'th'){
                    $data['data_header'][$k]['name'] = $v->name_th;
                    $data['data_header'][$k]['slug_name'] = $v->slug_th;
                }else{
                    $data['data_header'][$k]['name'] = $v->name_en;
                    $data['data_header'][$k]['slug_name'] = $v->slug_th;
                }

                    //GET SUB_MENU HEADER
                    $sub_menu = Menus::find($v->id)->childs;

                    $submenu_name_th = [];
                    $submenu_name_en = [];
                    $submenu_slug_th = [];
                    $submenu_slug_en = [];
                    if(count($sub_menu) > 0){
                        foreach($sub_menu as $lv){

                            array_push($submenu_name_th,$lv['name_th']);
                            array_push($submenu_name_en,$lv['name_en']);
                            array_push($submenu_slug_th,$lv['slug_th']);
                            array_push($submenu_slug_en,$lv['slug_en']);

                        }

                        if (empty(App::currentLocale() || App::currentLocale() == 'th')) {
                            $data['data_header'][$k]['submenu_name'] = $submenu_name_th;
                            $data['data_header'][$k]['submenu_slug_name'] = $submenu_slug_th;
                        }else{
                            $data['data_header'][$k]['submenu_name'] = $submenu_name_en;
                            $data['data_header'][$k]['submenu_slug_name'] = $submenu_slug_en;
                        }
                    }
                    //END GET SUB_MENU HEADER

            }
        }
        //END GET MENU HEADER
 
        
        //GET MENU FOOTER
        if(!empty($query_menu_footer)){
            foreach($query_menu_footer as $k => $v){

                $data['data_footer'][$k]['id'] = $v->id;

                if(empty(App::currentLocale()) || App::currentLocale() == 'th'){
                    $data['data_footer'][$k]['name'] = $v->name_th;
                    $data['data_footer'][$k]['slug_name'] = $v->slug_th;
                }else{
                    $data['data_footer'][$k]['name'] = $v->name_en;
                    $data['data_footer'][$k]['slug_name'] = $v->slug_en;
                }

                //GET SUB_MENU FOOTER
                $sub_menu = Menus::find($v->id)->childs;

                $submenu_name_th = [];
                $submenu_name_en = [];
                $submenu_slug_th = [];
                $submenu_slug_en = [];
                if(count($sub_menu) > 0){
                    foreach($sub_menu as $lv){
                        array_push($submenu_name_th,$lv['name_th']);
                        array_push($submenu_name_en,$lv['name_en']);
                        array_push($submenu_slug_th,$lv['slug_th']);
                        array_push($submenu_slug_en,$lv['slug_en']);
                    }

                    if (empty(App::currentLocale() || App::currentLocale() == 'th')) {
                        $data['data_footer'][$k]['submenu_name'] = $submenu_name_th;
                        $data['data_footer'][$k]['submenu_slug_name'] = $submenu_slug_th;
                    }else{
                        $data['data_footer'][$k]['submenu_name'] = $submenu_name_en;
                        $data['data_footer'][$k]['submenu_slug_name'] = $submenu_slug_en;
                    }
                }
                //END GET SUB_MENU FOOTER
            }
        }
        //END GET MENU FOOTER

        $respone = [
            'data_menu_header'=>$data['data_header'], 
            'data_menu_footer'=>$data['data_footer'],
        ];

        dd($respone);

        return $respone;
  
    }

    /**
     * Function :  find Menu
     * Dev : Poom
     * Update Date : 19 Jan 2022
     * @param POST
     * @return json find Data Menu
     */
    public function findMenu()
    {

        $data = [];
        $query_menu_header = Menus::where('parent_id', '=', null)->where('type', '=', 1)->where('status', 1)->get();
        $query_menu_footer = Menus::where('parent_id', '=', null)->where('type', '=', 2)->where('status', 1)->get();

        //GET MENU HEADER
        if (!empty($query_menu_header)) {
            foreach ($query_menu_header as $k => $v) {
                $data['data_header'][$k]['id'] = $v->id;
                if (empty(App::currentLocale()) || App::currentLocale() == 'th') {
                    $data['data_header'][$k]['name'] = $v->name_th;
                    $data['data_header'][$k]['slug_name'] = $v->slug_th;
                } else {
                    $data['data_header'][$k]['name'] = $v->name_en;
                    $data['data_header'][$k]['slug_name'] = $v->slug_th;
                }

                //GET SUB_MENU HEADER
                $sub_menu = Menus::find($v->id)->childs;

                if (count($sub_menu) > 0) {
                    foreach ($sub_menu as $ls => $lv) {
                        if (!empty(App::currentLocale() || App::currentLocale() == 'th')) {
                            $data['data_header'][$k]['submenu'][$ls]['submenu_name'] = $lv['name_th'];
                            $data['data_header'][$k]['submenu'][$ls]['submenu_slug_name'] = $lv['slug_th'];
                        } else {
                            $data['data_header'][$k]['submenu'][$ls]['submenu_name'] = $lv['name_en'];
                            $data['data_header'][$k]['submenu'][$ls]['submenu_slug_name'] = $lv['slug_en'];
                        }
                    }
                }
                //END GET SUB_MENU HEADER

            }
        }
        //END GET MENU HEADER


        //GET MENU FOOTER
        if (!empty($query_menu_footer)) {
            foreach ($query_menu_footer as $k => $v) {

                $data['data_footer'][$k]['id'] = $v->id;

                if (empty(App::currentLocale()) || App::currentLocale() == 'th') {
                    $data['data_footer'][$k]['name'] = $v->name_th;
                    $data['data_footer'][$k]['slug_name'] = $v->slug_th;
                } else {
                    $data['data_footer'][$k]['name'] = $v->name_en;
                    $data['data_footer'][$k]['slug_name'] = $v->slug_en;
                }

                //GET SUB_MENU FOOTER
                $sub_menu = Menus::find($v->id)->childs;

                if (count($sub_menu) > 0) {
                    foreach ($sub_menu as $ls => $lv) {
                        if (!empty(App::currentLocale() || App::currentLocale() == 'th')) {
                            $data['data_footer'][$k]['submenu'][$ls]['submenu_name'] = $lv['name_th'];
                            $data['data_footer'][$k]['submenu'][$ls]['submenu_slug_name'] = $lv['slug_th'];
                        } else {
                            $data['data_footer'][$k]['submenu'][$ls]['submenu_name'] = $lv['name_en'];
                            $data['data_footer'][$k]['submenu'][$ls]['submenu_slug_name'] = $lv['slug_en'];
                        }
                    }
                }
                //END GET SUB_MENU FOOTER
            }
        }
        //END GET MENU FOOTER

        $respone = [
            'data_menu_header' => $data['data_header'],
            'data_menu_footer' => $data['data_footer'],
        ];
        return $respone;
    }
}
