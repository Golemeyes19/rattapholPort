<?php

namespace Modules\Banner\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Modules\Banner\Entities\Banner;
use Modules\Menu\Entities\Menus;
use Illuminate\Support\Facades\App;

class BannerAdminController extends Controller
{
    /**
     * Function : __construct check admin login
     * Dev : pop
     * Update Date : 23 Jul 2021
     * @param Get
     * @return if not login redirect to /admin
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Function : banner index
     * Dev : pop
     * Update Date : 27 Jul 2021
     * @param Get
     * @return index.blade view
     */
    public function index()
    {

        return view('banner::index');
    }

    /**
     * Function : banner datatable ajax response
     * Dev : pop
     * Update Date : 27 Jul 2021
     * @param Get
     * @return json of banner
     */
    public function datatable_ajax(Request $request)
    {
        if ($request->ajax()) {

            //init datatable
            $dt_name_column = array('id','image', 'name_th','name_en', 'menu_id', 'updated_at');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // count all banners
            $dt_total = Banner::count();

            // create banners object
            $o_banner = new Banner;

            // add search query if have search from datable
            if (!empty($dt_search)) {
                $o_banner->where('name_th', 'like', "%" . $dt_search . "%")
                    ->where('name_en', 'like', "%" . $dt_search . "%");
            }

            // set query order & limit from datatable
            $o_banner->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                ->offset($dt_start)
                ->limit($dt_length);

            // query banners
            $banners = $o_banner->get();

            // prepare datatable for response
            $tables = Datatables::of($banners)
                ->addIndexColumn()
                ->setRowId('id')
                ->setRowClass('banner_row')
                ->setTotalRecords($dt_total)
                ->editColumn('updated_at', function ($record) {
                    return $record->updated_at->format('Y-m-d H:i:s');
                })
                ->editColumn('image', function ($record) {
                    if (!CheckFileInServer($record->image) || $record->image == "") {
                        $img = '<img class="rounded" src="/storage/18.jpg">';
                    } else {
                        $img = '<img class="rounded" src="' . $record->image . '">';
                    }
                    return $img;
                })
                ->editColumn('menu_id', function ($record) {
                    $menu = Menus::find($record->menu_id);
                    return $menu->name_th;
                })
                ->addColumn('action', function ($record) {
                    $action_btn = '<div class="btn-list">';

                    if ($record->status == 1) {
                        $action_btn .= '<a onclick="setUpdateStatus(' . $record->id . ',0)" href="javascript:void(0);" class="btn btn-outline-success"><i class="fa fa-check"></i></a></a>';
                    } else {
                        $action_btn .=  '<a onclick="setUpdateStatus(' . $record->id . ',1)" href="javascript:void(0);"  class="btn btn-outline-warning"><i class="fa fa-times"></i></a></a>';
                    }

                    $action_btn .= '<a href="' . route('admin.banner.banner.edit', $record->id) . '" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';
                    $action_btn .= '<a onclick="setDelete(' . $record->id . ')" href="javascript:void(0);" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></a>';
                    $action_btn .= '</div>';

                    return $action_btn;
                })
                ->escapeColumns([]);

            // response datatable json
            return $tables->make(true);
        }
    }

    /**
     * Function : add banner form
     * Dev : pop
     * Update Date : 14 Jul 2021
     * @param GET
     * @return banner form view
     */
    public function form_banner($id = 0)
    {
        $banner = [];

        if (!empty($id)) {
            $banner = Banner::find($id);
            $banner->description_th = mwz_getTextString($banner->description_th);
            $banner->description_en = mwz_getTextString($banner->description_en);
        }

        $items = Menus::withDepth()->defaultOrder()->where('type', 1)->where('status', 1)->get();

        $menu = array();
        $menu['data_parent'] = [];

        foreach ($items as $item) {

            $menu['data_parent'][$item->id]['id'] = $item->id;
            if (empty(App::currentLocale() || App::currentLocale() == 'th')) {
                $menu['data_parent'][$item->id]['name'] = str_repeat(' - ', $item->depth) . $item->name_th ;
            }else {
                $menu['data_parent'][$item->id]['name'] = str_repeat(' - ', $item->depth) . $item->name_en ;
            }

        }

        return view('banner::form', ['menu' => $menu, 'banner' => $banner]);
    }

    /**
     * Function :  banner save
     * Dev : pop
     * Update Date : 11 Jul 2021
     * @param POST
     * @return json response status
     */
    public function save_banner(Request $request)
    {
        // dd($request);
        //Check input is null
        if ($request->get('name_th') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุชื่อหัวข้อภาษาไทย!', 'focus' => 'name_th'];
            return response()->json($resp);
        }
        if ($request->get('name_en') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุชื่อหัวข้อภาษาอังกฤษ!', 'focus' => 'name_en'];
            return response()->json($resp);
        }
        if ($request->get('description_th') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุคำอธิบายภาษาไทย!', 'focus' => 'description_th'];
            return response()->json($resp);
        }
        if ($request->get('description_en') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุคำอธิบายภาษาอังกฤษ!', 'focus' => 'description_en'];
            return response()->json($resp);
        }
        if ($request->get('menu_id') == '0') {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดเลือกหน้าแสดงผล!', 'focus' => 'menu_id'];
            return response()->json($resp);
        }
        if ($request->get('sequence') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุลำดับการแสดงผล!', 'focus' => 'sequence'];
            return response()->json($resp);
        }
        //validate post data
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'menu_id' => 'required|integer',
            'name_th' => 'required|max:500',
            'name_en' => 'required|max:500',
            'description_th' => 'required',
            'description_en' => 'required',
            'sequence' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $resp = ['success' => 0, 'code' => 301, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!', 'error' => $errors];
            return response()->json($resp);
        }

        $attributes = [
            "menu_id" => $request->get('menu_id'),
            "name_th" => $request->get('name_th'),
            "name_en" => $request->get('name_en'),
            "description_th" => mwz_setTextString($request->get('description_th')),
            "description_en" => mwz_setTextString($request->get('description_en')),
            "sequence" => $request->get('sequence'),
            "status" => $request->get('status')
        ];

        // IMAGE 1
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_filename = 'banner-'. $request->get('id') . '-' . time() . "." . $image->extension();
            $path = $image->storeAs(
                'public/banner',
                $new_filename
            );
            $attributes['image'] = Storage::url($path);

            if(!empty($request->get('image_1_old'))){
                $image_old_path = str_replace('storage','public',$request->get('image_1_old'));
                    Storage::delete($image_old_path);
            }
        }else{
            if(!empty($request->get('is_delete_image_1')) && $request->get('is_delete_image_1') == '1'){
                $attributes['image'] = '';
                 // delete old image
                $file_path = str_replace('storage','public',$request->get('image_1_old'));
                Storage::delete($file_path);
            }
        }

        // IMAGE 2
        if ($request->hasFile('image_2')) {
            $image = $request->file('image_2');
            $new_filename = 'banner-'. $request->get('id') . '-2-' . time() . "." . $image->extension();
            $path_2 = $image->storeAs(
                'public/banner',
                $new_filename
            );
            $attributes['image_2'] = Storage::url($path_2);

            if(!empty($request->get('image_2_old'))){
                $image_2_old_path = str_replace('storage','public',$request->get('image_2_old'));
                    Storage::delete($image_2_old_path);
            }
        }else{
            if(!empty($request->get('is_delete_image_2')) && $request->get('is_delete_image_2') == '1'){
                $attributes['image_2'] = '';
                 // delete old image
                $file_path = str_replace('storage','public',$request->get('image_2_old'));
                Storage::delete($file_path);
            }
        }

        // dd($attributes['image_2']);

        // IMAGE 3
        if ($request->hasFile('image_3')) {
            $image_3 = $request->file('image_3');
            $new_filename = 'banner-'. $request->get('id') . '-3-' . time() . "." . $image_3->extension();
            $path = $image_3->storeAs(
                'public/banner',
                $new_filename
            );
            $attributes['image_3'] = Storage::url($path);

            if(!empty($request->get('image_3_old'))){
                $image_2_old_path = str_replace('storage','public',$request->get('image_3_old'));
                    Storage::delete($image_2_old_path);
            }
        }else{
            if(!empty($request->get('is_delete_image_3')) && $request->get('is_delete_image_3') == '1'){
                $attributes['image_3'] = '';
                 // delete old image
                $file_path = str_replace('storage','public',$request->get('image_3_old'));
                Storage::delete($file_path);
            }
        }


        if (!empty($request->get('id'))) {
            $Banner = Banner::where('id', $request->get('id'))->update($attributes);
            $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
        } else {
            $Banner = Banner::create($attributes);
            $resp = ['success' => 1, 'code' => 200, 'msg' => 'เพิ่มรายการใหม่สำเร็จ'];
        }

        return response()->json($resp);
    }

    /**
     * Function : update banner status
     * Dev : pop
     * Update Date : 27 Jul 2021
     * @param POST
     * @return json of update status
     */
    public function set_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $status = $request->get('status');

            $banner = Banner::find($id);
            $banner->status = $status;

            if ($banner->save()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
    }

    /**
     * Function : delete banner
     * Dev : pop
     * Update Date : 27 Jul 2021
     * @param POST
     * @return json of delete status
     */
    public function set_delete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $banner = Banner::find($id);

            if ($banner->delete()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
    }
}
