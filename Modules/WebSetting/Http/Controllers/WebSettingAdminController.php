<?php

namespace Modules\WebSetting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use Modules\Mwz\Http\Controllers\MwzController;

use Yajra\DataTables\Facades\DataTables;
use Modules\WebSetting\Entities\WebSettings;

class WebSettingAdminController extends Controller
{
    /**
     * Function : __construct check admin login
     * Dev : pop
     * Update Date : 14 Jul 2021
     * @param Get
     * @return if not login redirect to /admin
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    /**
     * Function : add con$contactus form
     * Dev : pop
     * Update Date : 04 August 2021
     * @param GET
     * @return category form view
     */
    public function form($id = 1)
    {

        $setting = [];
        if (!empty($id)) {
            $setting = WebSettings::find($id);
            $setting->our_story_th =  mwz_getTextString($setting->our_story_th);
            $setting->our_story_en =  mwz_getTextString($setting->our_story_en);
        }
        return view('websetting::form', ['setting' => $setting]);
    }

    /**
     * Function :  websettings save
     * Dev : Poom
     * Update Date : 19 Jan 2022
     * @param POST
     * @return json response status
     */
    public function save(Request $request)
    {
        $attributes = [
            "companyname_th" => $request->get('companyname_th'),
            "companyname_en" => $request->get('companyname_en'),
            "phone" => $request->get('phone'),
            "fb" => $request->get('fb'),
            "line" => $request->get('line'),
            "youtube" => $request->get('youtube'),
            "link_login" => $request->get('link_login'),
            "meta_title" => $request->get('meta_title'),
            "meta_keywords" => $request->get('meta_keywords'),
            "meta_description" => $request->get('meta_description'),
            "google_analytics" => $request->get('google_analytics'),
            "head_office_th"=>$request->get('head_office_th'),
            "head_office_en"=>$request->get('head_office_en'),
        ];

        if ($request->hasFile('logo_header')) {
            $image = $request->file('logo_header');
            $new_filename = time() . "h." . $image->extension();
            $path = $image->storeAs(
                'public/websetting',
                $new_filename
            );
            $attributes['logo_header'] = Storage::url($path);
        }

        // if ($request->hasFile('logo_footer')) {
        //     $image = $request->file('logo_footer');
        //     $new_filename = time() . "f." . $image->extension();
        //     $path = $image->storeAs(
        //         'public/websetting',
        //         $new_filename
        //     );
        //     $attributes['logo_footer'] = Storage::url($path);
        // }

        if ($request->hasFile('seo_image')) {
            $image = $request->file('seo_image');
            $new_filename = time() . "s." . $image->extension();
            $path = $image->storeAs(
                'public/websetting',
                $new_filename
            );
            $attributes['seo_image'] = Storage::url($path);
        }

        $webconfig = WebSettings::where('id', 1)->update($attributes);
        $resp = ['success' => 1, 'code' => 200, 'msg' => 'อัปเดตข้อมูลสำเร็จ'];

        return response()->json($resp);
    }

    /**
     * Function : add con$contactus form
     * Dev : pop
     * Update Date : 04 August 2021
     * @param GET
     * @return category form view
     */
    public function form_privacy($id = 1)
    {

        $privacy = [];
        if (!empty($id)) {
            $privacy = WebSettings::find($id);
            $privacy->privacy_th = mwz_getTextString($privacy->privacy_th);
            $privacy->privacy_en = mwz_getTextString($privacy->privacy_en);
        }
        return view('websetting::form_privacy', ['privacy' => $privacy]);
    }

    /**
     * Function :  websettings save form privacy
     * Dev : pop
     * Update Date : 8 August 2021
     * @param POST
     * @return json response status
     */
    public function save_privacy(Request $request)
    {
        //validate post data
        if (empty($request->get('id'))) {
            $validator = Validator::make($request->all(), [
                'privacy_th' => 'required',
                'privacy_en' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'privacy_th' => 'required',
                'privacy_en' => 'required',
            ]);
        }


        if ($validator->fails()) {
            $errors = $validator->errors();
            $resp = ['success' => 0, 'code' => 301, 'msg' => 'error', 'error' => $errors];
            return response()->json($resp);
        }

        $attributes = [
            "privacy_th" => mwz_setTextString($request->get('privacy_th')),
            "privacy_en" => mwz_setTextString($request->get('privacy_en')),
        ];

        if (!empty($request->get('id'))) {
            $privacy = WebSettings::where('id', $request->get('id'))->update($attributes);
            $resp = ['success' => 1, 'code' => 200, 'msg' => 'อัปเดตข้อมูลสำเร็จ'];
        } else {
            $privacy = WebSettings::create($attributes);
            $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกข้อมูลสำเร็จ'];
        }

        return response()->json($resp);
    }

    /**
     * Function : delete image
     * Dev : Ta
     * Update Date : 25 Aug 2021
     * @param POST
     * @return json of response
     */
    public function delete_image(Request $request)
    {
        if ($request->ajax()) {

            $webset = WebSettings::find(1);
            if ($request->id == 1) {
                $webset->logo_header = '';
            } else if ($request->id == 2) {
                $webset->logo_footer = '';
            } else {
                $webset->seo_image = '';
            }

            if ($webset->save()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
    }
}
