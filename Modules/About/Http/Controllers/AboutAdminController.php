<?php

namespace Modules\About\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Modules\About\Entities\Abouts;

class AboutAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('about::index');
    }

    /**
     * Function : add about form
     * Dev : jang
     * Update Date : 19 october 2021
     * @param GET
     * @return banner form view
     */
    public function form_about($id = 1)
    {
        $about = [];

        if (!empty($id)) {
            $about = Abouts::find($id);
            if (!empty($about->description_on_th)) {
                $about->description_on_th = mwz_getTextString($about->description_on_th);
            }
            if (!empty($about->description_on_en)) {
                $about->description_on_en = mwz_getTextString($about->description_on_en);
            }
            if (!empty($about->description_center_th)) {
                $about->description_center_th = mwz_getTextString($about->description_center_th);
            }
            if (!empty($about->description_center_en)) {
                $about->description_center_en = mwz_getTextString($about->description_center_en);
            }
            if (!empty($about->description_lower_th)) {
                $about->description_lower_th = mwz_getTextString($about->description_lower_th);
            }
            if (!empty($about->description_lower_en)) {
                $about->description_lower_en = mwz_getTextString($about->description_lower_en);
            }
        }
        // dd($about);

        return view('about::index', ['about' => $about]);
    }

    /**
     * Function :  about save
     * Dev : pop
     * Update Date : 11 Jul 2021
     * @param POST
     * @return json response status
     */
    public function save_about(Request $request)
    {
        //Check input is null
        if ($request->get('name_th') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุชื่อหัวข้อภาษาไทย!', 'focus' => 'name_th'];
            return response()->json($resp);
        }
        if ($request->get('name_en') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุชื่อหัวข้อภาษาอังกฤษ!', 'focus' => 'name_en'];
            return response()->json($resp);
        }
        if ($request->get('name1_th') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุชื่อหัวข้อภาษาไทย!', 'focus' => 'name1_th'];
            return response()->json($resp);
        }
        if ($request->get('name1_en') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุชื่อหัวข้อภาษาอังกฤษ!', 'focus' => 'name1_en'];
            return response()->json($resp);
        }
        if ($request->get('name2_th') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุชื่อหัวข้อภาษาไทย!', 'focus' => 'name2_th'];
            return response()->json($resp);
        }
        if ($request->get('name2_en') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุชื่อหัวข้อภาษาอังกฤษ!', 'focus' => 'name2_en'];
            return response()->json($resp);
        }
        if ($request->get('description_on_th') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุคำอธิบายภาษาไทย!', 'focus' => 'description_on_th'];
            return response()->json($resp);
        }
        if ($request->get('description_on_en') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุคำอธิบายภาษาอังกฤษ!', 'focus' => 'description_on_en'];
            return response()->json($resp);
        }
        if ($request->get('description_center_th') == '') {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุคำอธิบายภาษาไทย!', 'focus' => 'description_center_th'];
            return response()->json($resp);
        }
        if ($request->get('description_center_en') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุคำอธิบายภาษาอังกฤษ!', 'focus' => 'description_center_en'];
            return response()->json($resp);
        }
        if ($request->get('description_lower_th') == '') {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุคำอธิบายภาษาไทย!', 'focus' => 'description_lower_th'];
            return response()->json($resp);
        }
        if ($request->get('description_lower_en') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุคำอธิบายภาษาอังกฤษ!', 'focus' => 'description_lower_en'];
            return response()->json($resp);
        }
        //validate post data
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'name_th' => 'required|max:500',
            'name_en' => 'required|max:500',
            'name1_th' => 'required|max:500',
            'name1_en' => 'required|max:500',
            'name2_th' => 'required|max:500',
            'name2_en' => 'required|max:500',
            'description_on_th' => 'required',
            'description_on_en' => 'required',
            'description_center_th' => 'required',
            'description_center_en' => 'required',
            'description_lower_th' => 'required',
            'description_lower_en' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $resp = ['success' => 0, 'code' => 301, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!', 'error' => $errors];
            return response()->json($resp);
        }

        $attributes = [
            "name_th" => $request->get('name_th'),
            "name_en" => $request->get('name_en'),
            "name1_th" => $request->get('name1_th'),
            "name1_en" => $request->get('name1_en'),
            "name2_th" => $request->get('name2_th'),
            "name2_en" => $request->get('name2_en'),
            "description_on_th" => mwz_setTextString($request->get('description_on_th')),
            "description_on_en" => mwz_setTextString($request->get('description_on_en')),
            "description_center_th" => mwz_setTextString($request->get('description_center_th')),
            "description_center_en" => mwz_setTextString($request->get('description_center_en')),
            "description_lower_th" => mwz_setTextString($request->get('description_lower_th')),
            "description_lower_en" => mwz_setTextString($request->get('description_lower_en')),
            "video_1" => mwz_setTextString($request->get('video_1')),
            "video_2" => mwz_setTextString($request->get('video_2')),
            "status" => "1"
        ];

        if ($request->hasFile('image_on')) {
            $image = $request->file('image_on');
            $new_filename = 'about-' . $request->get('id') . '-' . time() . "." . $image->extension();
            $path = $image->storeAs(
                'public/about',
                $new_filename
            );
            $attributes['image_on'] = Storage::url($path);

            if (!empty($request->get('image_1_old'))) {
                $image_old_path = str_replace('storage', 'public', $request->get('image_1_old'));
                Storage::delete($image_old_path);
            }
        } else {
            if (!empty($request->get('is_delete_image_1')) && $request->get('is_delete_image_1') == '1') {
                $attributes['image_on'] = '';
                // delete old image
                $file_path = str_replace('storage', 'public', $request->get('image_1_old'));
                Storage::delete($file_path);
            }
        }

        if ($request->hasFile('image_center')) {
            $image = $request->file('image_center');
            $new_filename = 'about-' . $request->get('id') . '-2-' . time() . "." . $image->extension();
            $path = $image->storeAs(
                'public/about',
                $new_filename
            );
            $attributes['image_center'] = Storage::url($path);

            if (!empty($request->get('image_2_old'))) {
                $image_2_old_path = str_replace('storage', 'public', $request->get('image_2_old'));
                Storage::delete($image_2_old_path);
            }
        } else {
            if (!empty($request->get('is_delete_image_2')) && $request->get('is_delete_image_2') == '1') {
                $attributes['image_center'] = '';
                // delete old image
                $file_path = str_replace('storage', 'public', $request->get('image_2_old'));
                Storage::delete($file_path);
            }
        }

        if ($request->hasFile('image_lower')) {
            $image = $request->file('image_lower');
            $new_filename = 'about-' . $request->get('id') . '-3-' . time() . "." . $image->extension();
            $path = $image->storeAs(
                'public/about',
                $new_filename
            );
            $attributes['image_lower'] = Storage::url($path);

            if (!empty($request->get('image_3_old'))) {
                $image_2_old_path = str_replace('storage', 'public', $request->get('image_3_old'));
                Storage::delete($image_2_old_path);
            }
        } else {
            if (!empty($request->get('is_delete_image_3')) && $request->get('is_delete_image_3') == '1') {
                $attributes['image_lower'] = '';
                // delete old image
                $file_path = str_replace('storage', 'public', $request->get('image_3_old'));
                Storage::delete($file_path);
            }
        }

        if ($request->hasFile('image_top')) {
            $image = $request->file('image_top');
            $new_filename = 'about-' . $request->get('id') . '-' . time() . "." . $image->extension();
            $path = $image->storeAs(
                'public/about',
                $new_filename
            );
            $attributes['image_top'] = Storage::url($path);

            if (!empty($request->get('image_4_old'))) {
                $image_old_path = str_replace('storage', 'public', $request->get('image_4_old'));
                Storage::delete($image_old_path);
            }
        } else {
            if (!empty($request->get('is_delete_image_4')) && $request->get('is_delete_image_4') == '1') {
                $attributes['image_top'] = '';
                // delete old image
                $file_path = str_replace('storage', 'public', $request->get('image_4_old'));
                Storage::delete($file_path);
            }
        }

        if (!empty($request->get('id'))) {
            $About = Abouts::where('id', $request->get('id'))->update($attributes);
            $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
        } else {
            $About = Abouts::create($attributes);
            $resp = ['success' => 1, 'code' => 200, 'msg' => 'เพิ่มรายการใหม่สำเร็จ'];
        }

        return response()->json($resp);
    }
}
