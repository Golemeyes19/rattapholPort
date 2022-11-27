<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\App;

use Modules\News\Entities\NewsCategories;
use Modules\News\Entities\News;
use Modules\News\Entities\NewsCategory;
use Modules\Mwz\Http\Controllers\MwzController;


class NewsAdminController extends Controller
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

    /**
     * Function : news index
     * Dev : pop
     * Update Date : 20 Jul 2021
     * @param Get
     * @return index.blade view
     */
    public function index()
    {

        return view('news::index');
    }

     /**
     * Function : news index news categories
     * Dev : Jang
     * Update Date : 22 Nov 2021
     * @param Get
     * @return index.blade view
     */
    public function index_news_category()
    {

        return view('news::index_news_category');
    }

    /**
     * Function : add news category form
     * Dev : Jang
     * Update Date : 22 Nov 2021
     * @param GET
     * @return news form view
     */
    public function news_form_category($id = 0)
    {
     
        $news_category = [];

        if (!empty($id)) {
            $news_category = NewsCategory::find($id);
            $news_category->description_th = mwz_getTextString($news_category->description_th);
            $news_category->description_en = mwz_getTextString($news_category->description_en);
        }

        $items = NewsCategory::withDepth()->defaultOrder()->where('status', 1)->get();

        
        $list = array();
        $list['data_parent'] = [];

        foreach ($items as $item) {

            $list['data_parent'][$item->id]['id'] = $item->id;
            if (empty(App::currentLocale() || App::currentLocale() == 'th')) {
                $list['data_parent'][$item->id]['name'] = str_repeat(' - ', $item->depth) . $item->name_th ;
            }else {
                $list['data_parent'][$item->id]['name'] = str_repeat(' - ', $item->depth) . $item->name_en ;
            }

        }

        return view('news::form_new_category', ['list' => $list, 'news_category' => $news_category]);
    }

    /**
     * Function : news category save
     * Dev : Jang
     * Update Date : 22 Nov 2021
     * @param POST
     * @return json response status
     */
    public function save_news_category(Request $request)
    {

        $id = $request->get('id');

        //validate post data
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'name_th' => 'required|max:500',
            'name_en' => 'required|max:500',
            'description_th' => 'required',
            'description_en' => 'required',
            'status' => 'required',
            'image_th' => 'mimes:jpeg,jpg,png,gif|max:2048',
            'image_en' => 'mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $resp = ['success' => 0, 'code' => 301, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!', 'error' => $errors];
            return response()->json($resp);
        }

        // VALIDATOR SLUG NAME
        $slug_th = $this->createSlug($request->get('slug_th'));
        $slug_en = $this->createSlug($request->get('slug_en'));

        $slug_data['slug_th'] = $slug_th;
        $slug_data['slug_en'] = $slug_en;

        //check field slug_th and field slug_en duplicate
        if ($slug_th == $slug_en) {
            $resp = ['success' => 0, 'code' => 0, 'msg' => 'ชื่อ URL TH และ ชื่อ URL EN ต้องไม่ซ้ำ กรุณาเปลียนชื่อใหม่!'];
            return response()->json($resp);
        }
        if (!empty($request->get('id'))) {
            $validator_slug = Validator::make($slug_data, [
                'slug_th' => 'required|unique:news_category,slug_th' . ($id ? ",$id" : ''),
                'slug_en' => 'required|unique:news_category,slug_en' . ($id ? ",$id" : '')
            ]);
        }else{
            $validator_slug = Validator::make($slug_data, [
                'slug_th' => 'required|unique:news_category,slug_th',
                'slug_en' => 'required|unique:news_category,slug_en'
            ]);
        }

        if ($validator_slug->fails()) {
            $errors = $validator_slug->errors();
            $resp = ['success' => 0, 'code' => 0, 'msg' => 'ชื่อ URL TH หรือ ชื่อ URL EN ซ้ำ กรุณาเปลียนชื่อใหม่!', 'error' => $errors];
            return response()->json($resp);
        }
        // END : VALIDATOR SLUG NAME

        $now = DB::raw('NOW()');

        $attributes = [
            "name_th" => $request->get('name_th'),
            "name_en" => $request->get('name_en'),
            "description_th" => mwz_setTextString($request->get('description_th')),
            "description_en" => mwz_setTextString($request->get('description_en')),
            "slug_th" => $slug_th,
            "slug_en" => $slug_en,
            "parent_id" => $request->get('parent_id'),
            "status" => $request->get('status'),
        ];

        if ($request->hasFile('image_en')) {
            $image_en = $request->file('image_en');
            $new_filename = time() . "." . $image_en->extension();
            $path_en = $image_en->storeAs(
                'public/news',
                $new_filename
            );
            $attributes['image_en'] = Storage::url($path_en);
        }

        if ($request->hasFile('image_th')) {
            $image_th = $request->file('image_th');
            $new_filename = time() . "." . $image_th->extension();
            $path_th = $image_th->storeAs(
                'public/news',
                $new_filename
            );
            $attributes['image_th'] = Storage::url($path_th);
        }    

        if (!empty($request->get('id'))) {
            $news_category = NewsCategory::where('id', $request->get('id'))->update($attributes);

            //update the target node since it will be moved
            $news_category = NewsCategory::fixTree();

            $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
        } else {
            $news_category = NewsCategory::create($attributes);
            if (!empty($request->get('parent_id'))) {
                $news_category->parent_id = $request->get('parent_id');
            }
            $news_category->save();
            $resp = ['success' => 1, 'code' => 200, 'msg' => 'เพิ่มรายการใหม่สำเร็จ'];
        }

        return response()->json($resp);
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
            $dt_name_column = array('_lft', 'image', 'name_th', 'name_en', 'updated_at');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // count all news
            $dt_total = News::count();

            // create news object
            $o_news = new News;

            // add search query if have search from datable
            if (!empty($dt_search)) {
                $o_news->where('name_th', 'like', "%" . $dt_search . "%");
            }

            // set query order & limit from datatable
            $o_news->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                ->offset($dt_start)
                ->limit($dt_length);

            // query news
            $news = $o_news->get();

            // prepare datatable for response
            $tables = Datatables::of($news)
                ->addIndexColumn()
                ->setRowId('id')
                ->setRowClass('news_row')
                ->setTotalRecords($dt_total)
                ->editColumn('updated_at', function ($record) {
                    return $record->updated_at->format('Y-m-d H:i:s');
                })
                ->editColumn('image', function ($record) {
                    if (!CheckFileInServer($record->image)) {
                        $img = '<img class="rounded" src="/storage/18.jpg" />';
                    } else {
                        $img = '<img class="rounded" src="' . $record->image . '" />';
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

                    $action_btn .= '<a href="' . route('admin.news.news.edit', $record->id) . '" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';
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
     * Function : news datatable ajax response
     * Dev : Jang
     * Update Date : 22 Nov 2021
     * @param Get
     * @return json of news
     */
    public function datatable_ajax_news_category(Request $request)
    {
       
        if ($request->ajax()) {

            //init datatable
            $dt_name_column = array('_lft', 'name_th', 'name_en', 'updated_at');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // count all news
            $dt_total = NewsCategory::count();

            // create news object
            $o_news = new NewsCategory;

            // add search query if have search from datable
            if (!empty($dt_search)) {
                $o_news->where('name_th', 'like', "%" . $dt_search . "%");
                $o_news->where('name_en', 'like', "%" . $dt_search . "%");
            }

            // set query order & limit from datatable
            $o_news->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                ->offset($dt_start)
                ->limit($dt_length);

            // query news
            $o_news_cnt = $o_news ;
            // $news_category_row = mwz_setFlatCategory($o_news->get()->totree()) ;
            $news_category_row = NewsCategory::withDepth()->defaultOrder()->get();

            // count all menu
            $dt_total = $o_news_cnt->count();

            // prepare datatable for response
            $tables = Datatables::of($news_category_row)
                ->addIndexColumn()
                ->setRowId('id')
                ->setRowClass('news_category_row')
                ->setTotalRecords($dt_total)
                ->editColumn('name_th', function ($record) {
                    $result = array();

                    $result = str_repeat(' - ', $record->depth) . $record->name_th;
                    
                    return $result;
                })
                ->editColumn('name_en', function ($record) {
                    $result = array();

                    $result = str_repeat(' - ', $record->depth) . $record->name_en;
                    
                    return $result;
                })
                ->editColumn('updated_at', function ($record) {
                    return $record->updated_at->format('Y-m-d H:i:s');
                })
                ->addColumn('sort', function ($record) {
                    $sort_btn = '<div class="container">';
                    $sort_btn = '<div class="row justify-content-md-center">';
                    $sort_btn = '<a onclick="setUpdateUpMenu('. $record->id .');" href="javascript:void(0);"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>&nbsp;&nbsp;';
                    $sort_btn .= '<a onclick="setUpdateDownMenu('. $record->id .');" href="javascript:void(0);"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>';
                    $sort_btn .= '</div>';
                    $sort_btn .= '</div>';
                    $sort_btn .= '</div>';
                    return $sort_btn;
                })
                ->addColumn('action', function ($record) {
                    $action_btn = '<div class="btn-list">';

                    if ($record->status == 1) {
                        $action_btn .= '<a onclick="setUpdateStatusNewsCategory(' . $record->id . ',0)" href="javascript:void(0);" class="btn btn-outline-success"><i class="fa fa-check"></i></a></a>';
                    } else {
                        $action_btn .=  '<a onclick="setUpdateStatusNewsCategory(' . $record->id . ',1)" href="javascript:void(0);"  class="btn btn-outline-warning"><i class="fa fa-times"></i></a></a>';
                    }

                    $action_btn .= '<a href="' . route('admin.news.news.edit_news_category', $record->id) . '" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';
                    $action_btn .= '<a onclick="setDeleteNewsCategory(' . $record->id . ')" href="javascript:void(0);" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></a>';
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

            $news = News::find($id);
            $news->status = $status;

            if ($news->save()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
    }

    /**
     * Function : update news category status
     * Dev : Jang
     * Update Date : 22 Nov 2021
     * @param POST
     * @return json of update status
     */
    public function set_status_news_category(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $status = $request->get('status');

            $news_category = NewsCategory::find($id);
            $news_category->status = $status;

            if ($news_category->save()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
    }


    /**
     * Function : delete news
     * Dev : pop
     * Update Date : 20 Jul 2021
     * @param POST
     * @return json of delete status
     */
    public function set_delete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $news = News::find($id);

            if ($news->delete()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
    }

    /**
     * Function : delete news category
     * Dev : Jang
     * Update Date : 22 Nov 2021
     * @param POST
     * @return json of delete status
     */
    public function set_delete_news_category(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $news_category = NewsCategory::find($id);

            if ($news_category->delete()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
    }


    /**
     * Function : add news form
     * Dev : pop
     * Update Date : 20 Jul 2021
     * @param GET
     * @return news form view
     */
    public function news_form($id = 0)
    {
        $news = [];

        if (!empty($id)) {
            $news = News::find($id);
            $news->description_th = mwz_getTextString($news->description_th);
            $news->description_en = mwz_getTextString($news->description_en);
        }

        $items = [];
        $items = NewsCategory::withDepth()->defaultOrder()->where('status', 1)->get();

        $list = array();
        $list['data_parent'] = [];

        foreach ($items as $item) {

            $list['data_parent'][$item->id]['id'] = $item->id;
            if (empty(App::currentLocale() || App::currentLocale() == 'th')) {
                $list['data_parent'][$item->id]['name'] = str_repeat(' - ', $item->depth) . $item->name_th ;
            }else {
                $list['data_parent'][$item->id]['name'] = str_repeat(' - ', $item->depth) . $item->name_en ;
            }

        }

        return view('news::form', ['list' => $list, 'news' => $news]);
    }

    /**
     * Function : news save
     * Dev : Jang
     * Update Date : 22 Nov 2021
     * @param POST
     * @return json response status
     */
    public function save(Request $request)
    {
        $id = $request->get('id');

        //validate post data
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'name_th' => 'required|max:500',
            'name_en' => 'required|max:500',
            'description_th' => 'required',
            'description_en' => 'required',
            'status' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $resp = ['success' => 0, 'code' => 301, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!', 'error' => $errors];
            return response()->json($resp);
        }

        // VALIDATOR SLUG NAME
        $slug_th = $this->createSlug($request->get('slug_th'));
        $slug_en = $this->createSlug($request->get('slug_en'));

        $slug_data['slug_th'] = $slug_th;
        $slug_data['slug_en'] = $slug_en;

        //check field slug_th and field slug_en duplicate
        if ($slug_th == $slug_en) {
            $resp = ['success' => 0, 'code' => 0, 'msg' => 'ชื่อ URL TH และ ชื่อ URL EN ต้องไม่ซ้ำ กรุณาเปลียนชื่อใหม่!'];
            return response()->json($resp);
        }
        
        if (!empty($request->get('id'))) {
            $validator_slug = Validator::make($slug_data, [
                'slug_th' => 'required|unique:news,slug_th' . ($id ? ",$id" : ''),
                'slug_en' => 'required|unique:news,slug_en' . ($id ? ",$id" : '')
            ]);
        }else{
            $validator_slug = Validator::make($slug_data, [
                'slug_th' => 'required|unique:news,slug_th',
                'slug_en' => 'required|unique:news,slug_en'
            ]);
        }

        if ($validator_slug->fails()) {
            $errors = $validator_slug->errors();
            $resp = ['success' => 0, 'code' => 0, 'msg' => 'ชื่อ URL TH หรือ ชื่อ URL EN ซ้ำ กรุณาเปลียนชื่อใหม่!', 'error' => $errors];
            return response()->json($resp);
        }
        // END : VALIDATOR SLUG NAME

        $now = DB::raw('NOW()');
        $publish_at = date('Y-m-d H:i:s', strtotime($request->publish_at));
        if ($request->get('sequence') == "") {
            $sequence = DB::table('news')
                ->max('sequence');
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
            "author" => auth()->id(),
            "status" => $request->get('status'),
            "sequence" => $sequence,
            "publish_at" => $publish_at,
            "id_news_category" => $request->get('parent_id'),
            "slug_th" => $slug_th,
            "slug_en" => $slug_en,
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $new_filename = time() . "." . $image->extension();
            $path = $image->storeAs(
                'public/news',
                $new_filename
            );
            $attributes['image'] = Storage::url($path);
        } else {
            if (empty($request->get('id'))) {
                $resp = ['error' => 1, 'code' => 200, 'msg' => 'โปรดอัปโหลดรูปภาพ!', 'focus' => 'image'];
                return response()->json($resp);
            }
        }
        if (!empty($request->get('id'))) {
            $news = News::where('id', $request->get('id'))->update($attributes);

            $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
        } else {
            $news = News::create($attributes);
            if (!empty($request->get('parent_id'))) {
                $news->id_news_category = $request->get('parent_id');
            }
            $news->save();
            $resp = ['success' => 1, 'code' => 200, 'msg' => 'เพิ่มรายการใหม่สำเร็จ'];
        }

        return response()->json($resp);
    }

    /**
     * Function :  update up menu 
     * Dev : Jang
     * Update Date : 25 Nov 2021
     * @param POST
     * @return json response update menu up
     */
    public function menu_up(Request $request)
    {
        // dd($request);
        if ($request->ajax()) {
            
            $id = $request->get('id');

            $result = NewsCategory::find($id)->up();

            // dd($id);

        }
    }

    /**
     * Function :  update down menu 
     * Dev : Jang
     * Update Date : 25 Nov 2021
     * @param POST
     * @return json response update menu down
     */
    public function menu_down(Request $request)
    {

        if ($request->ajax()) {
            
            $id = $request->get('id');

            $result = NewsCategory::find($id)->down();

        }
    }

    /**
     * Function : Create Slug format
     * Dev : Soft
     * Update Date : 26 Oct 2021
     * @param Slug name
     * @return Slug name
     */
    public function createSlug($title) {
        $title = strip_tags($title);
        // Preserve escaped octets.
        $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
        // Remove percent signs that are not part of an octet.
        $title = str_replace('%', '', $title);
        // Restore octets.
        $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

        if ($this->seems_utf8($title)) {
            if (function_exists('mb_strtolower')) {
                $title = mb_strtolower($title, 'UTF-8');
            }
            $title = $this->utf8_uri_encode($title, 2048);
        }

        $title = strtolower($title);
        $title = preg_replace('/&.+?;/', '', $title); // kill entities
        $title = str_replace('.', '-', $title);
        $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
        $title = preg_replace('/\s+/', '-', $title);
        $title = preg_replace('|-+|', '-', $title);
        $title = trim($title, '-');

        return $title;
    }

    public function seems_utf8($str) {
        $length = strlen($str);
        for ($i=0; $i < $length; $i++) {
            $c = ord($str[$i]);
            if ($c < 0x80) $n = 0; # 0bbbbbbb
            elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
            elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
            elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
            elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
            elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
            else return false; # Does not match any model
            for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
                if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                    return false;
            }
        }
        return true;
    }

    public function utf8_uri_encode( $utf8_string, $length = 0 ) {
        $unicode = '';
        $values = array();
        $num_octets = 1;
        $unicode_length = 0;

        $string_length = strlen( $utf8_string );
        for ($i = 0; $i < $string_length; $i++ ) {

            $value = ord( $utf8_string[ $i ] );

            if ( $value < 128 ) {
                if ( $length && ( $unicode_length >= $length ) )
                    break;
                $unicode .= chr($value);
                $unicode_length++;
            } else {
                if ( count( $values ) == 0 ) $num_octets = ( $value < 224 ) ? 2 : 3;

                $values[] = $value;

                if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
                    break;
                if ( count( $values ) == $num_octets ) {
                    if ($num_octets == 3) {
                        $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
                        $unicode_length += 9;
                    } else {
                        $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
                        $unicode_length += 6;
                    }

                    $values = array();
                    $num_octets = 1;
                }
            }
        }

        return $unicode;
    }
}
