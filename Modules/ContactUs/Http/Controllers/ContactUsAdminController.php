<?php

namespace Modules\ContactUs\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

use Modules\Mwz\Http\Controllers\MwzController;
use Modules\ContactUs\Entities\Contacts ;
use Modules\ContactUs\Entities\ContactPages ;
use Modules\ContactUs\Entities\ContactSubject ;
use Modules\User\Http\Controllers\RoleController;

use Modules\ContactUs\Http\Controllers\ContactUsController;

class ContactUsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('contactus::index');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function subject()
    {
        return view('contactus::subject');
    }


    /**
    * Function : contactus datatable ajax response
    * Dev : Dave
    * Update Date : 14 jul 2021
    * @param Get
    * @return json of contactus
    */
    public function datatable_ajax(Request $request){
        if ($request->ajax()) {
            //init datatable
            $dt_name_column = array('id','name', 'subject','create_date');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // create contactus object
            $o_contactus = new Contacts;

            // add search query if have search from datable
            if(!empty($dt_search)){
                $o_contactus->where('create_date', 'like', "%".$dt_search."%")
                            ->where('name', 'like', "%".$dt_search."%")
                            ->where('subject', 'like', "%".$dt_search."%");
            }

            // set query order & limit from datatable
            $o_contactus->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                        ->offset($dt_start)
                        ->limit($dt_length);

            // query contactus as tree resule
            $contactus = $o_contactus->get();

            // $contactus = DB::table('contact')
            // ->join('contact_subject', 'contact_subject.id', '=', 'contact.subject')
            // ->select('contact.*', 'contact_subject.subject')
            // ->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
            // ->offset($dt_start)
            // ->limit($dt_length)
            // ->get();

            // count all category
            $dt_total = $contactus->count();

            // prepare datatable for resonse
            $tables = Datatables::of($contactus)
                    ->addIndexColumn()
                    ->setRowId('id')
                    ->setRowClass('master_row')
                    ->setTotalRecords($dt_total)
                    ->editColumn('created_at', function ($record) {
                        return $record->created_at->format('Y-m-d H:i:s');
                      })
                    ->addColumn('action', function ($record) {
                        $action_btn = '<div class="btn-list">';

                        if($record->status==1){
                            $action_btn .= '<a onclick="setUpdateStatus('.$record->id.',0)" href="javascript:void(0);" class="btn btn-outline-success"><i class="fa fa-check"></i></a></a>';
                        }else{
                            $action_btn .=  '<a onclick="setUpdateStatus('.$record->id.',1)" href="javascript:void(0);"  class="btn btn-outline-warning"><i class="fa fa-times"></i></a></a>';
                        }

                        $action_btn .= '<a href="'.route('admin.contactus.contactus.edit',$record->id).'" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';

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
    * Function : add con$contactus form
    * Dev : Dave
    * Update Date : 14 jul 2021
    * @param GET
    * @return category form view
    */
    public function form($id=0)
    {
        $contactus = [] ;
        if(!empty($id)){
            $contactus = Contacts::find($id) ;
        }
        return view('contactus::form',['contactus'=>$contactus]);
    }

    /**
    * Function :  member save
    * Dev : Dave
    * Update Date : 08 jul 2021
    * @param POST
    * @return json response status
    */
    public function save(Request $request)
    {
        //Check input is null
        if ($request->get('message') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุข้อความ!', 'focus' => 'message'];
            return response()->json($resp);
        }
        if ($request->get('reply') == "") {
            $resp = ['error' => 0, 'code' => 301, 'msg' => 'โปรดระบุข้อความตอบกลับ!', 'focus' => 'reply'];
            return response()->json($resp);
        }

        //validate post data
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'status' => 'required|integer',
            'message' => 'required',
            'reply' => 'required',
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            $resp = ['success'=>0,'code'=>0,'msg'=>'error','error'=>$errors] ;
            return response()->json($resp);
        }

        $now = DB::raw('NOW()');
        $attributes = [
            "message"=>$request->get('message'),
            "reply"=>$request->get('reply'),
            "status"=>$request->get('status')
        ];
        if(!empty($request->get('id'))){
            $member_category = Contacts::where('id',$request->get('id'))->update($attributes) ;
            $resp = ['success'=>1,'code'=>200,'msg'=>'บันทึกการเปลี่ยนแปลงสำเร็จ'] ;
        }else{
            $member_category = Contacts::create($attributes);
            if(!empty($request->get('id'))){
                $member_category->id = $request->get('id') ;
            }
            $member_category->save();
            $resp = ['success'=>1,'code'=>200,'msg'=>'เพิ่มข้อมูลสำเร็จ'] ;
        }

        return response()->json($resp);
    }

    /**
    * Function : update member  status
    * Dev : Dave
    * Update Date : 14 jul 2021
    * @param POST
    * @return json of update status
    */
    public function set_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $status = $request->get('status');

            $member = Contacts::find($id);
            $member->status=$status;

            if($member->save()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'บันทึกการเปลี่ยนแปลง'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'บันทึกการเปลี่ยนแปลงล้มเหลว'] ;
            }

            return response()->json($resp);
        }

    }

    /**
    * Function : delete  category
    * Dev : Dave
    * Update Date : 14 jul 2021
    * @param POST
    * @return json of delete status
    */
    public function set_delete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $member = Contacts::find($id);

            if($member->delete()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'ลบรายชื่อผู้ติดต่อสำเร็จ'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'ลบรายชื่อผู้ติดต่อล้มเหลว'] ;
            }

            return response()->json($resp);
        }
    }

    /**
    * Function : add contact_page form
    * Dev : Jang
    * Update Date : 26 october 2021
    * @param GET
    * @return category form view
    */
    public function form_contact_page($id=1)
    {
        $contact_page = [] ;
        if(!empty($id)){
            $contact_page = ContactPages::find($id) ;
            if(!empty($contact_page->description_th)){
                $contact_page->description_th = mwz_getTextString($contact_page->description_th) ;
            }
            if(!empty($contact_page->description_en)){
                $contact_page->description_en = mwz_getTextString($contact_page->description_en) ;
            }
            
        }
        // dd($contact_page);
        return view('contactus::form_contact_page',['contact_page'=>$contact_page]);
    }

    /**
    * Function :  save contact page save
    * Dev : Jang
    * Update Date : 26 october 2021
    * @param POST
    * @return json response status
    */
    public function save_contact_page(Request $request)
    {
        //validate post data
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'head_office_th' => 'max:500',
            'head_office_en' => 'max:500',
            'factory_th' => 'max:500',
            'factory_en' => 'max:500',
            'fb' => 'max:200',
            'line' => 'max:200',
            'youtube' => 'max:200',
            'phone_head_office' => 'max:10',
            'phone_factory' => 'max:10',
            'email_head_office' => 'max:250',
            'email_factory' => 'max:250',
            'gmaps' => 'max:500',
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            $resp = ['success'=>0,'code'=>0,'msg'=>'error','error'=>$errors] ;
            return response()->json($resp);
        }

        $now = DB::raw('NOW()');
        $attributes = [
            "description_th" => mwz_setTextString($request->get('description_th')),
            "description_en" => mwz_setTextString($request->get('description_en')),
            "head_office_th"=>$request->get('head_office_th'),
            "head_office_en"=>$request->get('head_office_en'),
            "factory_th"=>$request->get('factory_th'),
            "factory_en"=>$request->get('factory_en'),
            "fb"=>$request->get('fb'),
            "line"=>$request->get('line'),
            "youtube"=>$request->get('youtube'),
            "phone_head_office"=>$request->get('phone_head_office'),
            "phone_factory"=>$request->get('phone_factory'),
            "email_head_office"=>$request->get('email_head_office'),
            "email_factory"=>$request->get('email_factory'),
            "gmaps"=>$request->get('gmaps'),
        ];

        if(!empty($request->get('id'))){
            $contactpage = ContactPages::where('id',$request->get('id'))->update($attributes) ;
            $resp = ['success'=>1,'code'=>200,'msg'=>'บันทึกการเปลี่ยนแปลงสำเร็จ'] ;
        }else{
            $contactpage = ContactPages::create($attributes);
            $resp = ['success'=>1,'code'=>200,'msg'=>'เพิ่มข้อมูลสำเร็จ'] ;
        }

        return response()->json($resp);
    }

     /**
    * Function : add contact_page form
    * Dev : Jang
    * Update Date : 26 october 2021
    * @param GET
    * @return category form view
    */
    public function form_contact_subject($id=0)
    {
        $contactus_subject = [] ;
        if(!empty($id)){
            $contactus_subject = ContactSubject::find($id) ;
        }
        return view('contactus::form_contact_subject',['contactus_subject'=>$contactus_subject]);
    }

    /**
    * Function : add contact_page form
    * Dev : Jang
    * Update Date : 26 october 2021
    * @param GET
    * @return category form view
    */
    public function add_contact_subject($id=0)
    {
        $contactus_subject = [] ;
        if(!empty($id)){
            $contactus_subject = ContactSubject::find($id) ;
        }
        return view('contactus::form_contact_subject',['contactus_subject'=>$contactus_subject]);
    }

    /**
    * Function :  save contact page save
    * Dev : Jang
    * Update Date : 26 october 2021
    * @param POST
    * @return json response status
    */
    public function save_contact_subject(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'subject' => 'max:500',
            'subject_en' => 'max:500',
            'to_email' => 'max:500',
            'cc_email' => 'max:500',
            'sequence' => 'max:500',
            'status' => 'max:200',
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            $resp = ['success'=>0,'code'=>0,'msg'=>'error','error'=>$errors] ;
            return response()->json($resp);
        }

        $now = DB::raw('NOW()');
        $attributes = [
            "subject"=>$request->get('subject'),
            "subject_en"=>$request->get('subject_en'),
            "to_email"=>$request->get('to_email'),
            "cc_email"=>$request->get('cc_email'),
            "sequence"=>$request->get('sequence'),
            "status"=>$request->get('status'),
        ];

        if(!empty($request->get('id'))){
            $contactsubject = ContactSubject::where('id',$request->get('id'))->update($attributes) ;
            $resp = ['success'=>1,'code'=>200,'msg'=>'บันทึกการเปลี่ยนแปลงสำเร็จ'] ;
        }else{
            $contactsubject = ContactSubject::create($attributes);
            $resp = ['success'=>1,'code'=>200,'msg'=>'เพิ่มข้อมูลสำเร็จ'] ;
        }

        return response()->json($resp);
    }

    /**
    * Function : contact_subject datatable ajax response
    * Dev : Joe
    * Update Date : 23 nov 2021
    * @param Get
    * @return json of contactus
    */
    public function datatable_ajax_subject(Request $request){
        if ($request->ajax()) {
            //init datatable
            $dt_name_column = array('id', 'subject', 'updated_at');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // create contactus object
            $o_contactus_subject = new ContactSubject;

            // add search query if have search from datable
            if(!empty($dt_search)){
                $o_contactus_subject->where('id', 'like', "%".$dt_search."%")
                            ->where('subject', 'like', "%".$dt_search."%")
                            ->where('updated_at', 'like', "%".$dt_search."%");
            }

            // set query order & limit from datatable
            $o_contactus_subject->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                        ->offset($dt_start)
                        
                        ->limit($dt_length);

            // query contactus as tree resule
            $contactus_subject = $o_contactus_subject->orderBy('sequence', 'ASC')->get();

            // count all category
            $dt_total = $contactus_subject->count();

            // prepare datatable for resonse
            $tables = Datatables::of($contactus_subject)
                    ->addIndexColumn()
                    ->setRowId('id')
                    ->setRowClass('master_row')
                    ->setTotalRecords($dt_total)
                    ->editColumn('updated_at', function ($record) {
                        return $record->updated_at->format('Y-m-d H:i:s');
                      })
                    ->addColumn('action', function ($record) {
                        $action_btn = '<div class="btn-list">';

                        if($record->status==1){
                            $action_btn .= '<a onclick="set_status_subject('.$record->id.',0)" href="javascript:void(0);" class="btn btn-outline-success"><i class="fa fa-check"></i></a></a>';
                        }else{
                            $action_btn .=  '<a onclick="set_status_subject('.$record->id.',1)" href="javascript:void(0);"  class="btn btn-outline-warning"><i class="fa fa-times"></i></a></a>';
                        }

                        $action_btn .= '<a href="'.route('admin.contactus.contactus.edit_subject',$record->id).'" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';

                        $action_btn .= '<a onclick="set_delete_subject('.$record->id.')" href="javascript:void(0);" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></a>';

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
    * Function : update subject  status
    * Dev : Joe
    * Update Date : 24 nov 2021
    * @param POST
    * @return json of update status
    */
    public function set_status_subject(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $status = $request->get('status');

            $subject = ContactSubject::find($id);
            $subject->status=$status;

            if($subject->save()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'บันทึกการเปลี่ยนแปลง'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'การเปลี่ยนแปลงล้มเหลว'] ;
            }

            return response()->json($resp);
        }

    }

    /**
    * Function : delete  Subject
    * Dev : Joe
    * Update Date : 24 nov 2021
    * @param POST
    * @return json of delete status
    */
    public function set_delete_subject(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $subject = ContactSubject::find($id);

            if($subject->delete()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'ลบรายชื่อผู้ติดต่อสำเร็จ'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'ลบรายชื่อผู้ติดต่อล้มเหลว'] ;
            }

            return response()->json($resp);
        }
    }


}


