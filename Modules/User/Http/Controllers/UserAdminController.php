<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Yajra\DataTables\Facades\DataTables;
use Kalnoy\Nestedset\NestedSet;

use Modules\User\Entities\Users ;
use Modules\User\Entities\Roles ;
use Modules\User\Entities\Groups ;
use Modules\User\Entities\UserRoles ;
use Modules\User\Http\Controllers\RoleController;

use Illuminate\Support\Facades\Notification;
use Modules\User\Notifications\NotifyUser ;

use Modules\WebSetting\Entities\WebSettings;

// User Events 
use Modules\User\Events\UserLogin;
use Modules\User\Events\UserLogout;

class UserAdminController extends Controller
{
    /**
    * Function : __construct check admin login
    * Dev : Tong
    * Update Date : 16 Jun 2021
    * @param Get
    * @return if not login redirect to /admin
    */
   
    public $enable_feature = ['role'=>false,'group'=>false,'api'=>false];


    public function __construct()
    {
        $this->middleware('auth:admin')->except(['login','logout','forget_password','reset_password']);

        $this->middleware(function ($request, $next) {
            $role = new RoleController();
            if($role->allow()){
                return $next($request);
            }else{ 
                redirect()->route('admin.default')->send();
            }

        })->except(['login','logout','forget_password','reset_password']);
    }

    /**
    * Function : admin login from /admin
    * Dev : Tong
    * Update Date : 16 Jun 2021
    * @param Post $username, $password
    * @return redirect to /admin/dashbard
    */
    public function login(Request $request)
    {
        $websetting = websettings::find(1);
        // dd($websetting);
        if (Auth::guard('admin')->check())
        {
            return  redirect()->route('admin.default');

        }else{

            if(!empty($request->username)){
                $credentials = $request->validate([
                    'username' => ['required'],
                    'password' => ['required']
                ]) ;
                $credentials['status']=1;

                if (Auth::guard('admin')->attempt($credentials)) {
                    $request->session()->regenerate();
                    //dispatch user event
                    //UserLogin::dispatch(Auth::guard('admin')->user());
                    if ($websetting -> companyname_th == "" || $websetting -> our_story_th == "" || $websetting -> head_office_th == "" || $websetting -> factory_th == "" || $websetting -> link_login == "" ) {
                        return redirect()->route('admin.websetting.websetting.edit');
                    }else{
                        return redirect()->route('admin.homepage');
                    }
                    // return redirect()->route('admin.homepage');
                }else{
                    Redirect::back()->with('errors', 'ไม่พบผู้ดูแลระบบนี้');   
                }
            }
            return view('user::login');
        }
    }

    /**
    * Function : admin logout from /admin
    * Dev : Tong
    * Update Date : 16 Jun 2021
    * @param Get
    * @return redirect to /admin
    */
    public function logout(Request $request){

        //dispatch user event 
        UserLogout::dispatch(Auth::guard('admin')->user());

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    /**
    * Function : user index 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param Get
    * @return index.blade view
    */
    public function index()
    {   


        $user = Users::find(1) ;
        $user = Users::with('group')->find(1);

        foreach ($user->notifications as $notification) {
            //echo $notification->type;
        }


        return view('user::index',['enable_feature'=>$this->enable_feature]);
    }

    /**
    * Function : user datatable ajax response 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param Get
    * @return json of user 
    */
    public function datatable_ajax(Request $request){
        if ($request->ajax()) {
            
            //init datatable
            $dt_name_column = array('id','name','username','group','updated_at');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // count all user
            $dt_total = Users::count();

            // create user object 
            $o_user = new Users;

            // add search query if have search from datable
            if(!empty($dt_search)){
                $o_user->where('name', 'like', "%".$dt_search."%")
                       ->where('username', 'like', "%".$dt_search."%");
            }

            // set query order & limit from datatable
            $o_user->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                        ->offset($dt_start)
                        ->limit($dt_length);            

            // query user list
            $users = $o_user->with('group')->get();

            // prepare datatable for resonse
            $tables = Datatables::of($users)
                ->addIndexColumn()
                ->setRowId('id')
                ->setRowClass('user_row')
                ->setTotalRecords($dt_total)
                ->editColumn('updated_at', function ($record) {
                    return $record->updated_at->format('Y-m-d H:i:s'); 
                })
                ->addColumn('group', function ($record) {
                    return $record->group->name;
                })
                ->addColumn('action', function ($record) {
                    $action_btn = '<div class="btn-list">';
                    if($record->id!=1){
                        if($record->status==1){
                            $action_btn .= '<a onclick="setUpdateStatus('.$record->id.',0)" href="javascript:void(0);" class="btn btn-outline-success"><i class="fa fa-check"></i></a></a>';
                        }else{
                            $action_btn .=  '<a onclick="setUpdateStatus('.$record->id.',1)" href="javascript:void(0);"  class="btn btn-outline-warning"><i class="fa fa-times"></i></a></a>';
                        }
                    }
                    if(Auth::guard('admin')->user()->id==1||Auth::guard('admin')->user()->id==$record->id){
                        $action_btn .= '<a href="'.route('admin.user.user.edit',$record->id).'" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';
                    }
                    if($record->id!=1){
                        $action_btn .= '<a onclick="setDelete('.$record->id.')" href="javascript:void(0);" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></a>';
                    }
                    $action = '</div>';
                    return $action_btn;
                    })
                ->escapeColumns([]);
            // response datatable json
            return $tables->make(true);
        }
    }

    /**
    * Function : add user form
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param GET
    * @return user form view
    */
    public function form($id=0)
    {
        $user = [] ;
        if(!empty($id)){
            $user = Users::find($id) ;
            $user->role = json_decode($user->role,1) ;
        }

        $groups = mwz_setFlatCategory(Groups::all()->totree()) ;
        $roles  = RoleController::roles();

        return view('user::form',['user'=>$user,'groups'=>$groups,'roles'=>$roles,'enable_feature'=>$this->enable_feature]);
    }

    /**
    * Function : user save 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param POST
    * @return json response status
    */
    public function save(Request $request)
    {
        //validate post data
        if(!empty($request->get('id'))){
            $validator = Validator::make($request->all(), [
                'id' => 'integer',
                'group_id' => 'required|integer',
                'name' => 'required|max:250',
                'email' => 'required|email|max:320',
                'locale' => 'required|max:2',
                'status' => 'required|integer',
                'api_enable' => 'required|integer',
            ]);
        }else{
             $validator = Validator::make($request->all(), [
                'id' => 'integer',
                'group_id' => 'required|integer',
                'name' => 'required|max:250',
                'username' => 'required|max:100',
                'email' => 'required|email|max:320',
                'password' => 'required|max:100',
                'locale' => 'required|max:2',
                'status' => 'required|integer',
                'api_enable' => 'required|integer',
            ]);
        }

        if ($validator->fails()){
            $errors = $validator->errors();
            $resp = ['success'=>0,'code'=>301,'msg'=>'ข้อมูลไม่ถูกต้อง','error'=>$errors] ;
            return response()->json($resp);
        }

        if(empty($request->get('id'))){
            $check_existing = Users::where('username',$request->get('username'))->first();
            if(!empty($check_existing->id)){
                $resp = ['success'=>0,'code'=>302,'msg'=>'มีชื่อผู้ดูแลระบบนี้แล้ว'] ;
                return response()->json($resp);
            }
        }

        $now = DB::raw('NOW()');

        if(!empty($request->get('id'))){
            $attributes = [
                    "group_id"=>$request->get('group_id'),
                    "name"=>$request->get('name'),
                    "email"=>$request->get('email'),
                    "role"=>json_encode($request->get('role'),JSON_UNESCAPED_UNICODE),
                    "locale" => $request->get('locale'),
                    "status" => $request->get('status'),
                    "api_enable" => $request->get('api_enable'),
                ];
            if(!empty($request->get('password'))&&$request->get('password')!='********'){
                $attributes["password"] =Hash::make($request->get('password')); 
            }
        }else{
             $attributes = [
                    "group_id"=>$request->get('group_id'),
                    "name"=>$request->get('name'),
                    "username"=>$request->get('username'),
                    "email"=>$request->get('email'),
                    "password"=>Hash::make($request->get('password')),
                    "role"=>json_encode($request->get('role'),JSON_UNESCAPED_UNICODE),
                    "locale" => $request->get('locale'),
                    "status" => $request->get('status'),
                    "api_enable" => $request->get('api_enable'),
                ];
        }
     
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar') ;
            $new_filename = time().".".$avatar->extension();
            $path = $avatar->storeAs(
                'public/user', $new_filename
            );
            $attributes['avatar'] = Storage::url($path);
        }

        if(!empty($request->get('id'))){
            $user = Users::where('id',$request->get('id'))->update($attributes) ;
            $resp = ['success'=>1,'code'=>200,'msg'=>'อัพเดทข้อมูลสำเร็จ'] ;
        }else{
            $user = Users::create($attributes); 
            $user->save();
            $resp = ['success'=>1,'code'=>200,'msg'=>'เพิ่มผู้ดูแลระบบสำเร็จ'] ;
        }
        
        return response()->json($resp);
    }

    /**
    * Function : update user status
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param POST
    * @return json of update status
    */
    public function set_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $status = $request->get('status');

            $user = Users::find($id);
            $user->status=$status;
            
            if($user->save()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'เปลี่ยนสถานะ สำเร็จ'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'เปลี่ยนสถานะ ล้มเหลว'] ;
            }

            return response()->json($resp);
        }
    }

    /**
    * Function : delete user 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param POST
    * @return json of delete status
    */
    public function set_delete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $user = Users::find($id);
            
            if($user->delete()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'ลบชื่อผู้ดูแลระบบ สำเร็จ'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'ลบชื่อผู้ดูแลระบบ ล้มเหลว'] ;
            }
          
            return response()->json($resp);
        }
    }

    /**
    * Function : user group index 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param Get
    * @return group.blade view
    */
    public function group()
    {
        return view('user::group');
    }

    /**
    * Function : user group datatable ajax response 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param Get
    * @return json of user group
    */
    public function group_datatable_ajax(Request $request){
        if ($request->ajax()) {
            
            //init datatable
            $dt_name_column = array('_lft','name','updated_at');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // count all group
            $dt_total = Groups::count();

            // create group object 
            $o_groups = new Groups;

            // add search query if have search from datable
            if(!empty($dt_search)){
                $o_groups->where('name', 'like', "%".$dt_search."%")
                             ->where('description', 'like', "%".$dt_search."%");
            }

            // set query order & limit from datatable
            $o_groups->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                        ->offset($dt_start)
                        ->limit($dt_length);            

            // query group as tree resule
            $groups = $o_groups->get(['id','name','status','updated_at','_lft','_rgt','parent_id'])->toTree(); 

            // set flat group from helper function
            $groups = mwz_setFlatCategory($groups);

            // prepare datatable for resonse
            $tables = Datatables::of($groups)
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
                            $action_btn .= '<a onclick="setUpdateGroupStatus('.$record->id.',0)" href="javascript:void(0);" class="btn btn-outline-success"><i class="fa fa-check"></i></a></a>';
                        }else{
                            $action_btn .=  '<a onclick="setUpdateGroupStatus('.$record->id.',1)" href="javascript:void(0);"  class="btn btn-outline-warning"><i class="fa fa-times"></i></a></a>';
                        }

                        $action_btn .= '<a href="'.route('admin.user.group.edit',$record->id).'" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';

                        $action_btn .= '<a onclick="setDeleteGroup('.$record->id.')" href="javascript:void(0);" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></a>';

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
    * Function : add user group form
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param GET
    * @return group form view
    */
    public function group_form($group_id=0)
    {
        $group = [] ;
        if(!empty($group_id)){
            $group = Groups::find($group_id) ;
            $group->description = mwz_getTextString($group->description) ;
            $group->default_role = json_decode($group->default_role,1) ;
        }

        $parents = Groups::all()->totree();
        $parents = mwz_setFlatCategory($parents) ;

        $roles = RoleController::roles();

        return view('user::group_form',['parents'=>$parents,'group'=>$group,'roles'=>$roles]);
    }

    /**
    * Function : save user group 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param POST
    * @return json of response
    */
    public function group_save(Request $request)
    {
        // print_r($request->all()) ;
        //validate post data
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'name' => 'required|max:500',
            'description' => 'max:700',
            'parent_id'=>'required|integer',
            'status' => 'required|integer',
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            $resp = ['success'=>0,'code'=>0,'msg'=>'error','error'=>$errors] ;
            return response()->json($resp);
        }

        $now = DB::raw('NOW()');
        $attributes = [
            "name"=>$request->get('name'),
            "description"=>mwz_setTextString($request->get('description')),
            "default_role"=>json_encode($request->get('role'),JSON_UNESCAPED_UNICODE),
            "status"=>$request->get('status')
        ];

        if(!empty($request->get('id'))){
            $user_group = Groups::where('id',$request->get('id'))->update($attributes) ;
            $resp = ['success'=>1,'code'=>200,'msg'=>'update competet'] ;
        }else{
            $user_group = Groups::create($attributes); 
            if(!empty($request->get('parent_id'))){
                $user_group->parent_id = $request->get('parent_id') ;
            }
            $user_group->save();
            $resp = ['success'=>1,'code'=>200,'msg'=>'insert competet'] ;
        }
        
        return response()->json($resp);
    }


    /**
    * Function : update group status status
    * Dev : Tong
    * Update Date : 16 Jun 2021
    * @param POST
    * @return json of update status
    */
    public function set_group_status(Request $request)
    {
        if ($request->ajax()) {
            $group_id = $request->get('group_id');
            $status = $request->get('status');

            $group = Groups::find($group_id);
            $group->status=$status;
            
            if($category->save()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'อัพเดทสถานะ สำเร็จ'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'อัพเดทสถานะ ล้มเหลว'] ;
            }

             return response()->json($resp);
        }

    }

    /**
    * Function : delete user group 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param POST
    * @return json of delete status
    */
    public function set_group_delete(Request $request)
    {
        if ($request->ajax()) {
            $group_id = $request->get('group_id');
            $group = Groups::find($group_id);
            $descendants = Groups::descendantsOf($group_id)->count();

            if(empty($descendants)){
                if($group->delete()){
                    $resp = ['success'=>1,'code'=>200,'msg'=>'ลบกลุ่ม สำเร็จ'] ;
                }else{
                    $resp = ['success'=>0,'code'=>500,'msg'=>'ลบกลุ่ม ล้มเหลว'] ;
                }
            }else{
                $resp = ['success'=>0,'code'=>300,'msg'=>'ไม่สามารถลบกลุ่ม เนื่องจากมีกลุ่มย่อยอยู่'] ;
            }
            return response()->json($resp);
        }
    }



    /**
    * Function : user role list index
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param Get
    * @return role view of datatable
    */
    public function role(Request $request){
        return view('user::role');
    }

    /**
    * Function : role datatable ajax response 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param Get
    * @return json of user 
    */
    public function role_datatable_ajax(Request $request){
        if ($request->ajax()) {
            
            //init datatable
            $dt_name_column = array('id','name','slug','action','updated_at');
            $dt_order_column = $request->get('order')[0]['column'];
            $dt_order_dir = $request->get('order')[0]['dir'];
            $dt_start = $request->get('start');
            $dt_length = $request->get('length');
            $dt_search = $request->get('search')['value'];

            // count all user
            $dt_total = Roles::count();

            // create user object 
            $o_role = new Roles;

            // add search query if have search from datable
            if(!empty($dt_search)){
                $o_user->where('name', 'like', "%".$dt_search."%")
                       ->where('slug', 'like', "%".$dt_search."%")
                       ->where('action', 'like', "%".$dt_search."%");
            }

            // set query order & limit from datatable
            $o_role->orderBy($dt_name_column[$dt_order_column], $dt_order_dir)
                        ->offset($dt_start)
                        ->limit($dt_length);            

            // query role list
            $roles = $o_role->get(); 

            // prepare datatable for resonse
            $tables = Datatables::of($roles)
                    ->addIndexColumn()
                    ->setRowId('id')
                    ->setRowClass('user_row')
                    ->setTotalRecords($dt_total)
                    ->editColumn('updated_at', function ($record) {
                        return $record->updated_at->format('Y-m-d H:i:s'); 
                      })
                    ->addColumn('action', function ($record) {
                        $action_btn = '<div class="btn-list">';

                        if($record->status==1){
                            $action_btn .= '<a onclick="setUpdateRoleStatus('.$record->id.',0)" href="javascript:void(0);" class="btn btn-outline-success"><i class="fa fa-check"></i></a></a>';
                        }else{
                            $action_btn .=  '<a onclick="setUpdateRoleStatus('.$record->id.',1)" href="javascript:void(0);"  class="btn btn-outline-warning"><i class="fa fa-times"></i></a></a>';
                        }

                        $action_btn .= '<a href="'.route('admin.master.role.edit',$record->id).'" class="btn btn-outline-primary"><i class="fa fa-pencil"></i></a></a>';

                        $action_btn .= '<a onclick="setRoleDelete('.$record->id.')" href="javascript:void(0);" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a></a>';

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
    * Function : add role form
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param GET
    * @return role_form.blade view
    */
    public function role_form($id=0)
    {
        $role = [] ;
        if(!empty($id)){
            $role = Roles::find($id) ;
        }

        return view('user::form',['role'=>$role]);
    }

    /**
    * Function : role save 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param POST
    * @return json response status
    */
    public function role_save(Request $request)
    {
        //validate post data
        $validator = Validator::make($request->all(), [
            'id' => 'integer',
            'name' => 'required|max:255',
            'slug' => 'required|max:700',
            'action' => 'required|max:700',
            'status' => 'required|integer',
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            $resp = ['success'=>0,'code'=>301,'msg'=>'ข้อมูลไม่ถูกต้อง','error'=>$errors] ;
            return response()->json($resp);
        }

        $now = DB::raw('NOW()');
        $attributes = [
            "name"=>$request->get('name'),
            "slug"=>$request->get('slug'),
            "action"=>$request->get('action'),
            'status' => $request->get('status')
        ];

        if(!empty($request->get('id'))){
            $user = Roles::where('id',$request->get('id'))->update($attributes) ;
            $resp = ['success'=>1,'code'=>200,'msg'=>'แก้ไข role สำเร็จ'] ;
        }else{
            $user = Roles::create($attributes); 
            $user->save();
            $resp = ['success'=>1,'code'=>200,'msg'=>'เพิ่ม role สำเร็จ'] ;
        }
         
        return response()->json($resp);
    }

    /**
    * Function : update role status
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param POST
    * @return json of update status
    */
    public function set_role_status(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $status = $request->get('status');

            $role = Roles::find($id);
            $role->status=$status;
            
            if($master->save()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'อัพเดทสถานะ สำเร็จ'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'อัพเดทสถานะ ล้มเหลว'] ;
            }

            return response()->json($resp);
        }

    }

    /**
    * Function : delete role 
    * Dev : Tong
    * Update Date : 24 Jun 2021
    * @param POST
    * @return json of delete status
    */
    public function set_role_delete(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $role = Roles::find($id);
            
            if($role->delete()){
                $resp = ['success'=>1,'code'=>200,'msg'=>'ลบ role สำเร็จ'] ;
            }else{
                $resp = ['success'=>0,'code'=>500,'msg'=>'ลบ role ล้มเหลว'] ;
            }
          
            return response()->json($resp);
        }
    }

}
