<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse ;

use Modules\User\Entities\Users ;
use Modules\User\Entities\Groups ;

class UserController extends Controller
{

    /**
    * Function : __construct check admin login
    * Dev : Tong
    * Update Date : 16 Jun 2021
    * @param Get
    * @return if not login redirect to /admin
    */
    public function get_user(){
       $user =  Users::find(1);
       print_r($user);
    }
}
