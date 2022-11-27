<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\WebSetting\Entities\WebSettings;
use Illuminate\Support\Facades\App;

class DashboardAdminController extends Controller
{
    /**
    * Function : __construct check admin login
    * Dev : Tong
    * Update Date : 16 Jun 2021
    * @param Get
    * @return if not login redirect to /admin
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = [];
    	$websetting = websettings::find(1);
    	if(!empty($websetting)){

    		if(app()->getLocale() == '' || app()->getLocale() == 'th'){
                $data['companyname'] = $websetting->companyname_th;
    		}else{
    			$data['companyname'] = $websetting->companyname_en;
    		}
        }
        // dd($data);
        return view('dashboard::index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    // /**
    //  * Function : Get Contact Us Info
    //  * Dev : Joe
    //  * Update Date : 18 Nov 2021
    //  * @param POST
    //  * @return response of contact us info
    // */
    // public function getCompanynameInfo(){

    // 	$data = [];
    // 	$websetting = websettings::find(1);
    // 	if(!empty($websetting)){

    // 		if(app()->getLocale() == '' || app()->getLocale() == 'th'){
    //             $data['companyname'] = $websetting->companyname_th;
    // 		}else{
    // 			$data['companyname'] = $websetting->companyname_en;
    // 		}
    //     }
    //     dd($data);
    //     return view('dashboard::index',['data'=>$data]);

    // }
}