<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

use Yajra\DataTables\Facades\DataTables;
use Modules\Menu\Entities\Menus;

class MenuAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Function : index 
     * Dev : Jang
     * Update Date : 19 Nov 2021
     * @param Get
     * @return view of menu
     */
    public function index()
    {
        return view('menu::menu');
    }

    /**
     * Function : change type menu
     * Dev : Jang
     * Update Date : 19 Nov 2021
     * @param Get
     * @return view of menu
     */
    public function type_menu($type)
    {
        session()->put('type_menu', $type);
        return back()->withInput();
    }

    /**
     * Function : menu datatable ajax response 
     * Dev : Jang
     * Update Date : 19 Nov 2021
     * @param Get
     * @return json of menu 
     */
    public function datatable_ajax(Request $request)
    {

        if ($request->ajax()) {
            //get type menu
            $type = ((session()->get('type_menu') == "") ? 1 : session()->get('type_menu'));

            // dd($type);

            //init datatable
            $dt_name_column = array('_lft', 'name_th', 'name_en', 'updated_at');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // create menu object 
            $o_menu = new Menus;

            // add search query if have search from datable
            if (!empty($dt_search)) {
                $o_menu->where('name_th', 'like', "%" . $dt_search . "%")
                    ->where('name_en', 'like', "%" . $dt_search . "%")
                    ->where('updated_at', 'like', "%" . $dt_search . "%");
            }

            // set query order & limit from datatable
            $o_menu->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                ->offset($dt_start)
                ->limit($dt_length)
                ->orderby('_lft', 'asc');

            // query menu as tree resule
            $o_menu_cnt = $o_menu ;
            $menu = Menus::withDepth()->defaultOrder()->where('type', $type)->get();

            // count all menu
            // $dt_total = $o_menu_cnt->where('type', $type)->count();
            $dt_total = Menus::where('type', $type)->count();

            // prepare datatable for resonse
            $tables = Datatables::of($menu)
                ->addIndexColumn()
                ->setRowClass('menu_row')
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
                ->addColumn('actionEdit', function ($record) {
                    $action_btn = '<div class="btn-list">';

                    if ($record->status == 1) {
                        $action_btn .= '<a onclick="setUpdateStatusMenu(' . $record->id . ',0)" href="javascript:void(0);" class="btn btn-outline-success"><i class="fa fa-check"></i></a></a>';
                    } else {
                        $action_btn .=  '<a onclick="setUpdateStatusMenu(' . $record->id . ',1)" href="javascript:void(0);"  class="btn btn-outline-warning"><i class="fa fa-times"></i></a></a>';
                    }

                    $action_btn .= '<a href="' . route('admin.menu.menu.edit', $record->id) . '" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';
                    $action_btn .= '<a onclick="setDeleteMenu(' . $record->id . ')" href="javascript:void(0);" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></a>';
                    $action_btn .= '</div>';

                    return $action_btn;
                })
                ->escapeColumns([]);

            // response datatable json
            return $tables->make(true);
        }
    }

    /**
     * Function : add menu form
     * Dev : Jang
     * Update Date : 19 Nov 2021
     * @param GET
     * @return category form view
     */
    public function form($id = 0)
    {
        $type = ((session()->get('type_menu') == "") ? 1 : session()->get('type_menu'));

        $menu = [];
        if (!empty($id)) {
            $menu = Menus::find($id);
        }
        
        $items = [];
        $items = Menus::withDepth()->defaultOrder()->where('type', $type)->where('status', 1)->get();
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

        return view('menu::formmenu', ['menu' => $menu, 'type' => $type, 'list' => $list ]);
    }

    /**
     * Function :  manu save 
     * Dev : Jang
     * Update Date : 19 Nov 2021
     * @param POST
     * @return json response status
     */
    public function save(Request $request)
    {
    
        $id = $request->get('id');

        //validate post data
        $validator = Validator::make($request->all(), [
            'name_th' => 'required|max:500',
            'name_en' => 'required|max:500',
            'sequence' => 'required|integer',
            'status' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $resp = ['success' => 0, 'code' => 0, 'msg' => 'error', 'error' => $errors];
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
                'slug_th' => 'required|unique:menu,slug_th' . ($id ? ",$id" : ''),
                'slug_en' => 'required|unique:menu,slug_en' . ($id ? ",$id" : '')
            ]);
        }else{
            $validator_slug = Validator::make($slug_data, [
                'slug_th' => 'required|unique:menu,slug_th',
                'slug_en' => 'required|unique:menu,slug_en'
            ]);
        }

        if ($validator_slug->fails()) {
            $errors = $validator_slug->errors();
            $resp = ['success' => 0, 'code' => 0, 'msg' => 'ชื่อ URL TH หรือ ชื่อ URL EN ซ้ำ กรุณาเปลียนชื่อใหม่!', 'error', 'error' => $errors];
            return response()->json($resp);
        }
        // END : VALIDATOR SLUG NAME

        $now = DB::raw('NOW()');
        $attributes = [
            "name_th" => $request->get('name_th'),
            "name_en" => $request->get('name_en'),
            "slug_th" => $slug_th,
            "slug_en" => $slug_en,
            "sequence" => $request->get('sequence'),
            "type" => $request->get('type'),
            "parent_id" => $request->get('parent_id'),
            "status" => $request->get('status')
        ];

        if ($request->get('type') == 1) {
            $attributes['type'] = 1;
        }else{
            $attributes['type'] = 2;
        }

        if (!empty($request->get('id'))) {
            $menu = Menus::where('id', $request->get('id'))->update($attributes);

            //update the target node since it will be moved
            $menu = Menus::fixTree();

            $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
        } else {
            $menu = Menus::create($attributes);
            if (!empty($request->get('parent_id'))) {
                $menu->parent_id = $request->get('parent_id');
            }
            $menu->save();
            $resp = ['success' => 1, 'code' => 200, 'msg' => 'เพิ่มรายการสำเร็จ'];
        }

        return response()->json($resp);
    }

     /**
     * Function : update menu status
     * Dev : Jang
     * Update Date : 19 Nov 2021
     * @param POST
     * @return json of update status
     */
    public function set_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $status = $request->get('status');

            $menu = Menus::find($id);
            $menu->status = $status;

            if ($menu->save()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'บันทึกการเปลี่ยนแปลงสำเร็จ'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
    }

    /**
     * Function : delete news
     * Dev : jang
     * Update Date : 25 Nov 2021
     * @param POST
     * @return json of delete status
     */
    public function set_delete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $news = Menus::find($id);

            if ($news->delete()) {
                $resp = ['success' => 1, 'code' => 200, 'msg' => 'ลบข้อมูลเมนูสำเร็จ!'];
            } else {
                $resp = ['success' => 0, 'code' => 500, 'msg' => 'เกิดข้อผิดพลาด โปรดลองใหม่อีกครั้ง!'];
            }

            return response()->json($resp);
        }
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
        
        if ($request->ajax()) {
            
            $id = $request->get('id');

            $result = Menus::find($id)->up();
  
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

            $result = Menus::find($id)->down();

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
