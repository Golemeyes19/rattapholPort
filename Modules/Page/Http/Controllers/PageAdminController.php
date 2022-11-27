<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Kalnoy\Nestedset\NestedSet;
use Carbon\Carbon;

use Modules\Page\Entities\Page;
use Modules\Mwz\Http\Controllers\MwzController;

class PageAdminController extends Controller
{
    /**
     * Function : __construct check admin login
     * Dev : pop
     * Update Date : 19 Jul 2021
     * @param Get
     * @return if not login redirect to /admin
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function pre($d){
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }

    /**
     * Function : news index
     * Dev : pop
     * Update Date : 20 Jul 2021
     * @param Get
     * @return index.blade view
     */
    public function index()
    {

        return view('page::index');
    }

    /**
     * Function : news datatable ajax response
     * Dev : pop
     * Update Date : 20 Jul 2021
     * @param Get
     * @return json of news
     */
    public function datatable_ajax(Request $request)
    {
        if ($request->ajax()) {

            //init datatable
            $dt_name_column = array('id', 'image', 'name_th', 'name_en', 'updated_at', 'action');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // count all news
            $dt_total = Page::count();

            // create news object
            $o_page = new Page();

            // add search query if have search from datable
            if (!empty($dt_search)) {
                $o_page->where('name_th', 'like', "%" . $dt_search . "%")
                    ->where('description_th', 'like', "%" . $dt_search . "%");
            }

            // set query order & limit from datatable
            $o_page->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                ->offset($dt_start)
                ->limit($dt_length);

            // query news
            $page = $o_page->get();

            // prepare datatable for response
            $tables = Datatables::of($page)
                ->addIndexColumn()
                ->setRowId('id')
                ->setRowClass('page_row')
                ->setTotalRecords($dt_total)
                ->editColumn('updated_at', function ($record) {
                    return $record->updated_at->format('d/m/Y H:i:s');
                })
                ->editColumn('image', function ($record) {
                    if (!empty($record->image) && CheckFileInServer($record->image)) {
                        $img = '<img class="rounded" src="' . $record->image . '" />';
                    } else {
                        $img = '<img class="rounded" src="/storage/18.jpg" />';
                    }
                    return $img;
                })
                ->addColumn('action', function ($record) {
                    $action_btn = '<div class="btn-list">';

                    if ($record->status == 1) {
                        $action_btn .= '<a onclick="setUpdateStatus(' . $record->id . ',0)" href="javascript:void(0);" class="btn btn-outline-success"><i class="fa fa-check"></i></a></a>';
                    } else {
                        $action_btn .=  '<a onclick="setUpdateStatus(' . $record->id . ',1)" href="javascript:void(0);"  class="btn btn-outline-warning"><i class="fa fa-times"></i></a></a>';
                    }

                    $action_btn .= '<a href="' . route('admin.page.page.edit', $record->id) . '" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';
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
     * Function : update news status
     * Dev : pop
     * Update Date : 20 Jul 2021
     * @param POST
     * @return json of update status
     */
    public function set_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $status = $request->get('status');

            $page = Page::find($id);
            $page->status = $status;

            if ($page->save()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
    }


    /**
     * Function : delete page
     * Dev : pop
     * Update Date : 20 Jul 2021
     * @param POST
     * @return json of delete status
     */
    public function set_delete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $page = Page::find($id);

            if ($page->delete()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
    }


    /**
     * Function : add page form
     * Dev : pop
     * Update Date : 20 Jul 2021
     * @param GET
     * @return page form view
     */
    public function page_form($id = 0)
    {
        $page = [];

        if (!empty($id)) {
            $page = Page::find($id);
            $page->description_th = mwz_getTextString($page->description_th);
            $page->description_en = mwz_getTextString($page->description_en);
            $page->detail_th = mwz_getTextString($page->detail_th);
            $page->detail_en = mwz_getTextString($page->detail_en);
        }

        return view('page::form', ['page' => $page]);
    }

    /**
     * Function : news save
     * Dev : pop
     * Update Date : 20 Jul 2021
     * @param POST
     * @return json response status
     */
    public function save(Request $request)
    {

        // $this->pre($request->all()); exit;
        if (empty($request->get('description_th'))) {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุคำอธิบายภาษาไทย!', 'focus' => 'description_th'];
            return response()->json($resp);
        }
        if (empty($request->get('description_en'))) {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุคำอธิบายภาษาอังกฤษ!', 'focus' => 'description_en'];
            return response()->json($resp);
        }
        if (empty($request->get('detail_th'))) {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุรายละเอียดภาษาไทย!', 'focus' => 'detail_th'];
            return response()->json($resp);
        }
        if (empty($request->get('detail_en'))) {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุรายละเอียดภาษาอังกฤษ!', 'focus' => 'detail_en'];
            return response()->json($resp);
        }

        //validate post data
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'name_th' => 'required|max:500',
            'name_en' => 'required|max:500',
            'description_th' => 'required|max:500',
            'description_en' => 'required|max:500',
            'detail_th' => 'required',
            'detail_en' => 'required',
            'status' => 'required'
        ],[
            'name_th.*' => 'โปรดระบุหัวข้อภาษาไทย ความยาวไม่เกิน 500 ตัวอักษร!',
            'name_en.*' => 'โปรดระบุหัวข้อภาษาอังกฤษ ความยาวไม่เกิน 500 ตัวอักษร!',
            'description_th.*' => 'โปรดระบุคำอธิบายภาษาไทย ความยาวไม่เกิน 500 ตัวอักษร!',
            'description_en.*' => 'โปรดระบุคำอธิบายภาษาอังกฤษ ความยาวไม่เกิน 500 ตัวอักษร!',
            'detail_th.required' => 'โปรดระบุรายละเอียดภาษาไทย!',
            'detail_en.required' => 'โปรดระบุรายละเอียดภาษาอังกฤษ!',
        ]);

        if ($validator->fails()) {
            $this->pre($validator->errors());
            $errors = $validator->errors();
            $focus = $validator->errors()->keys()[0];
            $msg = $validator->errors()->first();
            $resp = ['success' => 0, 'code' => 301, 'msg' => $msg, 'error' => $errors, 'focus' => $focus];
            return response()->json($resp);
        }


        if ($request->get('sequence') == "") {
            $sequence = DB::table('pages')->max('sequence');
            (int)$sequence += 1;
        } else {
            $sequence = $request->get('sequence');
        }

        $attributes = [
            "name_th" => $request->get('name_th'),
            "name_en" => $request->get('name_en'),
            "params" => $request->get('params'),
            "description_th" => mwz_setTextString($request->get('description_th')),
            "description_en" => mwz_setTextString($request->get('description_en')),
            "detail_th" => mwz_setTextString($request->get('detail_th')),
            "detail_en" => mwz_setTextString($request->get('detail_en')),
            "status" => $request->get('status'),
            "sequence" => $sequence,
        ];


        $delelte_temp = array();
        if (!empty($request->get('id'))) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $new_filename = time() . '.' . $image->extension();
                $path = $image->storeAs(
                    'public/page',
                    $new_filename
                );
                $attributes['image'] = Storage::url($path);

                // delete old image
                $ofile_path = str_replace('storage', 'public', $request->get('hide_image'));
                // Storage::delete($ofile_path);
                $delelte_temp[] = $ofile_path;
            } else {
                if (!empty($request->get('delete_image')) && $request->get('delete_image') == '1') {
                    $attributes['image'] = '';
                    // delete old image
                    $ofile_path = str_replace('storage', 'public', $request->get('hide_image'));
                    // Storage::delete($ofile_path);
                    $delelte_temp[] = $ofile_path;
                }
            }
        } else {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $new_filename = time() . '.' . $image->extension();
                $path = $image->storeAs(
                    'public/page',
                    $new_filename
                );
                $attributes['image'] = Storage::url($path);
            }
        }

        if (!empty($request->get('id'))) {
            $page = Page::where('id', $request->get('id'))->update($attributes);
            Storage::delete($delelte_temp);
            $resp = ['success' => 1, 'code' => 201, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
        } else {
            $page = Page::create($attributes);
            $page->save();
            $resp = ['success' => 1, 'code' => 200, 'msg' => 'เพิ่มรายการใหม่สำเร็จ'];
        }

        return response()->json($resp);
    }
}
