<?php

namespace Modules\Pdpa\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

use Yajra\DataTables\Facades\DataTables;

use Modules\Pdpa\Entities\Pdpas ;
use Modules\Pdpa\Entities\PdpaDetails ;

class PdpaAdminController extends Controller
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
     * Function : pdpa datatable ajax response
     * Dev : jang
     * Update Date : 12 October 2021
     * @param Get
     * @return json of pdpa
     */
    public function datatable_ajax(Request $request){
        if ($request->ajax()) {

            //init datatable
            $dt_name_column = array('id','pdpa_title_th','updated_at');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // count all pdpa
            $dt_total = Pdpas::count();

            // create pdpa object
            $o_pdpa = new Pdpas;

            // add search query if have search from datable
            if(!empty($dt_search)){
                $o_pdpa = $o_pdpa->where('pdpa_title_th', 'like', "%".$dt_search."%")
                    ->where('pdpa_title_th', 'like', "%".$dt_search."%");
            }

            // set query order & limit from datatable
            $o_pdpa = $o_pdpa->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                ->offset($dt_start)
                ->limit($dt_length);

            // query discounts
            $pdpas = $o_pdpa
                ->select('id', 'pdpa_title_th', 'status', 'updated_at')
                ->orderBy('id','ASC')
                ->get();

            // prepare datatable for response
            $tables = Datatables::of($pdpas)
                ->addIndexColumn()
                ->setRowId('id')
                ->setRowClass('pdpa_row')
                ->setTotalRecords($dt_total)
                ->editColumn('updated_at', function ($record) {
                    return $record->updated_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($record) {
                    $action_btn = '<div class="btn-list">';

                    if($record->status==1){
                        $action_btn .= '<a onclick="setUpdateStatus('.$record->id.',0)" href="javascript:void(0);" class="btn btn-outline-success"><i class="fa fa-check"></i></a></a>';
                    }else{
                        $action_btn .=  '<a onclick="setUpdateStatus('.$record->id.',1)" href="javascript:void(0);"  class="btn btn-outline-warning"><i class="fa fa-times"></i></a></a>';
                    }

                    $action_btn .= '<a href="'.route('admin.pdpa.pdpa.edit',$record->id).'" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';

                    $action_btn .= '<a onclick="setDelete('.$record->id.')" href="javascript:void(0);" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></a>';

                    $action = '</div>' ;

                    return $action_btn ;
                })
                ->escapeColumns([])
            ;

            // response datatable json
            return $tables->make(true) ;
        }
    }

    /**
     * Function : pdpa detail index
     * Dev : jang
     * Update Date : 21 October 2021
     * @param Get
     * @return category.blade view
     */
    public function pdpa_detail()
    {
        return view('pdpa::pdpa_detail');
    }

    /**
     * Function : pdpa_detail datatable ajax response
     * Dev : jang
     * Update Date : 12 October 2021
     * @param Get
     * @return json of pdpa
     */
    public function datatable_ajax_pdpa_detail(Request $request){
        if ($request->ajax()) {

            //init datatable
            $dt_name_column = array('id','pdpa_ip', 'pdpa_user_agent', 'pdpa_user_status', 'created_at');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // count all pdpa_detail
            $dt_total = PdpaDetails::count();

            // create pdpa_detail object
            $o_pdpa = new PdpaDetails;

            // add search query if have search from datable
            if(!empty($dt_search)){
                $o_pdpa = $o_pdpa->where('pdpa_ip', 'like', "%".$dt_search."%")
                    ->where('pdpa_ip', 'like', "%".$dt_search."%");
            }

            // set query order & limit from datatable
            $o_pdpa = $o_pdpa->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                ->offset($dt_start)
                ->limit($dt_length);

            // query pdpa
            $pdpas = $o_pdpa
                ->select('id', 'pdpa_ip', 'pdpa_user_agent', 'pdpa_user_status', 'created_at')
                ->orderBy('id','ASC')
                ->get();

            // prepare datatable for response
            $tables = Datatables::of($pdpas)
                ->addIndexColumn()
                ->setRowId('id')
                ->setRowClass('pdpa_detail_row')
                ->setTotalRecords($dt_total)
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->format('Y-m-d H:i:s');
                })
                ->editColumn('pdpa_user_status', function ($record) {
                    if ($record->pdpa_user_status == 1) {
                      $user_status = "Yes";
                    }else {
                      $user_status = "No";
                    };
                    return $user_status;
                })
                ->escapeColumns([])
            ;

            // response datatable json
            return $tables->make(true) ;
        }
    }

    /**
     * Function :  pdpa form
     * Dev : jang
     * Update Date : 12 October 2021
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function form($id=0)
    {
      $pdpa = [] ;

      if(!empty($id)){
          $pdpa = Pdpas::find($id) ;
          $pdpa->pdpa_detail_th = mwz_getTextString($pdpa->pdpa_detail_th) ;
          $pdpa->pdpa_detail_en = mwz_getTextString($pdpa->pdpa_detail_en) ;
          $pdpa->pdpa_detail_long_th = mwz_getTextString($pdpa->pdpa_detail_long_th) ;
          $pdpa->pdpa_detail_long_en = mwz_getTextString($pdpa->pdpa_detail_long_en) ;
      }

      return view('pdpa::form',['pdpa'=>$pdpa]);
    }

    /**
     * Function :  pdpa save
     * Dev : jang
     * Update Date : 12 October 2021
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function save(Request $request)
    {
        if ($request->get('pdpa_title_th') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'ต้องใส่ชื่อ', 'focus' => 'pdpa_title_th'];
            return response()->json($resp);
        }
        if ($request->get('pdpa_title_en') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'ต้องใส่ชื่อ', 'focus' => 'pdpa_title_en'];
            return response()->json($resp);
        }

      //validate post data
      if(!empty($request->get('id'))){
          $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'pdpa_title_th'=>'required|max:255',
            'pdpa_title_en'=>'required|max:255',
            'status' => 'required',
          ]);
      }else{
          $validator = Validator::make($request->all(), [
            'pdpa_title_th'=>'required|max:255',
            'pdpa_title_en'=>'required|max:255',
            'status' => 'required',
          ]);
      }

      if ($validator->fails()){
          $errors = $validator->errors();
          $resp = ['success'=>0,'code'=>301,'msg'=>'error data validate','error'=>$errors] ;
          return response()->json($resp);
      }

        $attributes = [
            "pdpa_title_th"=>$request->get('pdpa_title_th'),
            "pdpa_title_en"=>$request->get('pdpa_title_en'),
            "pdpa_detail_th"=>mwz_setTextString($request->get('pdpa_detail_th')),
            "pdpa_detail_en"=>mwz_setTextString($request->get('pdpa_detail_en')),
            "pdpa_detail_long_th"=>mwz_setTextString($request->get('pdpa_detail_long_th')),
            "pdpa_detail_long_en"=>mwz_setTextString($request->get('pdpa_detail_long_en')),
            "status"=>$request->get('status'),
            "created_by"=>auth()->id(),
            "updated_by"=>auth()->id(),
        ];


      if(!empty($request->get('id'))){
          $discount = Pdpas::where('id',$request->get('id'))->update($attributes) ;
          $resp = ['success'=>1,'code'=>200,'msg'=>'ปรับปรุง ข้อมูล สำเร็จ'] ;
      }else{
          $discount = Pdpas::create($attributes);
          $resp = ['success'=>1,'code'=>200,'msg'=>'เพิ่ม ข้อมูล สำเร็จ'] ;
      }

      return response()->json($resp);

    }

    /**
     * Function : update pdpa status
     * Dev : jang
     * Update Date : 12 October 2021
     * @param POST
     * @return json of update status
     */
    public function set_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $status = $request->get('status');

            $discount = Pdpas::find($id);
            $discount->status=$status;

            if($discount->save()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'ปรับปรุง ข้อมูล สำเร็จ'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'ปรับปรุง ข้อมูล ล้มเหลว'] ;
            }

            return response()->json($resp);
        }
    }

    /**
     * Function : delete pdpa
     * Dev : jang
     * Update Date : 12 October 2021
     * @param POST
     * @return json of delete status
     */
    public function set_delete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $discount = Pdpas::find($id);

            if($discount->delete()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'ปรับปรุง ข้อมูล สำเร็จ'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'ปรับปรุง ข้อมูล ล้มเหลว'] ;
            }

            return response()->json($resp);
        }
    }


}
