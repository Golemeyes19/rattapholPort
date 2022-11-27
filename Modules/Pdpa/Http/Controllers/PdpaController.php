<?php

namespace Modules\Pdpa\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Pdpa\Entities\Pdpas;
use Modules\Pdpa\Entities\PdpaDetails;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\App;

class PdpaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('pdpa::index');
    }

    /**
     * Function :  check_accept
     * Dev : jang
     * Update Date : 12 October 2021
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function check_accept(Request $request)
    {

        $pdpa_user_status = "1";
        $member_id = "1";

        $attributes = [
            "member_id" => $member_id,
            "pdpa_ip" => $this->getUserIpAddr(),
            "pdpa_user_agent" => $request->server('HTTP_USER_AGENT'),
            "pdpa_user_status" => $pdpa_user_status,
        ];

        PdpaDetails::create($attributes);

        Cookie::queue(Cookie::make('policy', 1));

        $value = $request->cookie('policy');

        $resp = ['success' => 1, 'code' => 200, 'msg' => 'insert competet'];
        return response()->json($resp);
    }

    /**
     * Function :  getUserIpAddr
     * Dev : jang
     * Update Date : 12 October 2021
     */
    public function getUserIpAddr()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
     * Function : get_pdpaAll
     * Dev : jang
     * Update Date : 24 Nov 2021
     * @param Get
     * @return json of pdpa
     */
    public function get_pdpaAll($id = 1)
    {
        # code...
        $data_pdpa = Pdpas::where('status', 1)->where('id', $id)->get();
        // dd($data_pdpa);

        $data = [];
        if(!empty($data_pdpa)){
            foreach ($data_pdpa as $k => $data_pdpa) {
                $data['data_pdpa'][$k]['id'] = $data_pdpa->id ;

                if (empty(App::currentLocale() || App::currentLocale() == 'th')) {
                    $data['data_pdpa'][$k]['pdpa_title'] = $data_pdpa->pdpa_title_th ;
                    $data['data_pdpa'][$k]['pdpa_detail'] = mwz_getTextString($data_pdpa->pdpa_detail_th) ;
                    $data['data_pdpa'][$k]['pdpa_detail_long'] = mwz_getTextString($data_pdpa->pdpa_detail_long_th) ;
                }else{
                    $data['data_pdpa'][$k]['pdpa_title'] = $data_pdpa->pdpa_title_en ;
                    $data['data_pdpa'][$k]['pdpa_detail'] = mwz_getTextString($data_pdpa->pdpa_detail_en) ;
                    $data['data_pdpa'][$k]['pdpa_detail_long'] = mwz_getTextString($data_pdpa->pdpa_detail_long_en) ;
                }
            }
        }
        // dd($data);
        return $data;
    }
}
