<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{

    public static function roles(){
        $roles = [
            "user"=>[
                "user"=>[
                    "view"=>['admin.user.user.index','admin.user.user.datatable_ajax'],
                    "add"=>['admin.user.user.add','admin.user.user.save'],
                    "edit"=>['admin.user.user.edit','admin.user.user.save','admin.user.user.set_status'],
                    "delete"=>['admin.user.user.set_delete']
                ]
            ],
            "member"=>[
                "member"=>[
                    "view"=>['admin.member.member.index','admin.member.member.datatable_ajax'],
                    "add"=>['admin.member.member.add','admin.member.member.save'],
                    "edit"=>['admin.member.member.edit','admin.member.member.save','admin.member.member.set_status'],
                    "delete"=>['admin.member.member.set_delete']
                ]
            ],
            "menu"=>[
                "menu"=>[
                    "view"=>['admin.menu.menu.index','admin.menu.menu.type_menu','admin.menu.menu.datatable_ajax'],
                    "add"=>['admin.menu.menu.save','admin.menu.menu.edit'],
                    "edit"=>['admin.menu.menu.edit','admin.menu.menu.save','admin.menu.menu.set_status'],
                    "delete"=>['admin.menu.menu.set_delete']
                ]
            ],
            "banner"=>[
                "banner"=>[
                    "view"=>['admin.banner.banner.index','admin.banner.banner.datatable_ajax'],
                    "add"=>['admin.banner.banner.add','admin.banner.banner.save'],
                    "edit"=>['admin.banner.banner.edit','admin.banner.banner.save','admin.banner.banner.set_status'],
                    "delete"=>['BannerAdminController@set_delete']
                ]
            ],
            "promotion"=>[
                "news"=>[
                    "view"=>['admin.news.news.index','admin.news.news.datatable_ajax'],
                    "add"=>['admin.news.news.add','admin.news.news.save'],
                    "edit"=>['admin.news.news.edit','admin.news.news.save','admin.news.news.set_status'],
                    "delete"=>['admin.news.news.set_delete']
                ]
            ],
            "Product"=>[
                "product"=>[
                    "view"=>['admin.product.product.index','admin.product.product.datatable_ajax'],
                    "add"=>['admin.product.product.add','admin.product.product.save'],
                    "edit"=>['admin.product.product.edit','admin.product.product.save','admin.product.product.set_status'],
                    "delete"=>['admin.product.product.set_delete']
                ],
                "category"=>[
                    "view"=>['admin.product.category.index','admin.product.category.datatable_ajax'],
                    "add"=>['admin.product.category.add','admin.product.category.save'],
                    "edit"=>['admin.product.category.edit','admin.product.category.save','admin.product.category.set_status'],
                    "delete"=>['admin.product.category.set_delete']
                ],
                "vendor"=>[
                    "view"=>['admin.product.vendor.index','admin.product.vendor.datatable_ajax'],
                    "add"=>['admin.product.vendor.add','admin.product.vendor.save'],
                    "edit"=>['admin.product.vendor.edit','admin.product.vendor.save','admin.product.vendor.set_status'],
                    "delete"=>['admin.product.vendor.set_delete']
                ],
                "brand"=>[
                    "view"=>['admin.product.brands.index','admin.product.brands.datatable_ajax'],
                    "add"=>['admin.product.brands.add','admin.product.brands.save'],
                    "edit"=>['admin.product.brands.edit','admin.product.brands.save','admin.product.brands.set_status'],
                    "delete"=>['admin.product.brands.set_delete']
                ],
                "label"=>[
                    "view"=>['admin.product.label.index','admin.product.label.datatable_ajax'],
                    "add"=>['admin.product.label.add','admin.product.label.save'],
                    "edit"=>['admin.product.label.edit','admin.product.label.save','admin.product.label.set_status'],
                    "delete"=>['admin.product.label.set_delete']
                ]
            ],
            "order"=>[
                "order"=>[
                    "view"=>['admin.order.order.index','admin.order.order.detail','admin.order.order.invoice','admin.order.order.invoice_print','admin.order.order.invoice_info','admin.order.order.datatable_ajax','admin.order.order.get_shiping_info','admin.order.order.get_customer_info','admin.order.order.get_order_list_info','admin.order.order.get_invoice_info','admin.order.order.get_payment_info'],
                    "edit"=>['admin.order.order.set_order_status','admin.order.order.save_shipping_info','admin.order.order.save_payment_info'],
                    "delete"=>['admin.order.order.set_delete_order','admin.order.order.set_delete_order_all']
                ]
            ],
            "branch"=>[
                "branch"=>[
                    "view"=>['admin.branch.branch.index','admin.branch.branch.datatable_ajax'],
                    "add"=>['admin.branch.branch.add','admin.branch.branch.save'],
                    "edit"=>['admin.branch.branch.edit','admin.branch.branch.save','admin.branch.branch.set_status'],
                    "delete"=>['admin.branch.branch.set_delete']
                ]
            ],
            "branch"=>[
                "branch"=>[
                    "view"=>['admin.branch.branch.index','admin.branch.branch.datatable_ajax'],
                    "add"=>['admin.branch.branch.add','admin.branch.branch.save'],
                    "edit"=>['admin.branch.branch.edit','admin.branch.branch.save','admin.branch.branch.set_status'],
                    "delete"=>['admin.branch.branch.set_delete']
                ]
            ],
            "filemanager"=>[
                "filemanager"=>[
                    "view"=>['admin.filemanager.filemanager.index'],
                ]
            ],
            "pdpa"=>[
                "pdpa"=>[
                    "view"=>['admin.pdpa.pdpa.index','admin.pdpa.pdpa.datatable_ajax','admin.pdpa.pdpa.pdpa_detail','admin.pdpa.pdpa.datatable_ajax_pdpa_detail'],
                    "add"=>['admin.pdpa.pdpa.add','admin.pdpa.pdpa.save_pdpa'],
                    "edit"=>['admin.pdpa.pdpa.edit','admin.pdpa.pdpa.save_pdpa','admin.pdpa.pdpa.set_status'],
                    "delete"=>['dmin.pdpa.pdpa.set_delete']
                ]
            ],
            "contactus"=>[
                "contactus"=>[
                    "view"=>['admin.contactus.contactus.index','admin.contactus.contactus.datatable_ajax'],
                    "edit"=>['admin.contactus.contactus.edit','admin.contactus.contactus.set_status','admin.contactus.contactus.save','admin.contactus.contactus.edit_contact_page','admin.contactus.contactus.save_contact_page'],
                    "delete"=>['admin.contactus.contactus.set_delete']
                ]
            ],
           
        ];

        return $roles ; ;
    }

    public function allow(){

        $user= Auth::guard('admin')->user();
        $user->role=json_decode($user->role,1);

        $route = Route::currentRouteName();
        $roles = $this->roles() ;
        list($profix,$module,$page,$action) = explode('.',$route) ;
        if($profix=='admin'){
            if($user->id==1){
                return true;
            }else{
                if(isset($roles[$module][$page])){
                    $allow_action = '';
                    foreach($roles[$module][$page] as $action => $method){
                        if(in_array($route,$method)){
                            $allow_action=$action;
                            break;
                        }
                    }

                    if(!empty($allow_action)&&isset($user->role[$module][$page][$allow_action])){
                        return true;
                    }else{ 
                        return false;
                    }
                }
            }
        }
        if($profix=='api'){
            if(isset($roles[$module][$page])){
                $allow_action = '';
                foreach($roles[$module][$page] as $action => $method){
                    if(in_array($route,$method)){
                        $allow_action=$action;
                        break;
                    }
                }

                if(!empty($allow_action)&&isset($user->role[$module][$page][$allow_action])){
                    return true;
                }else{ 
                    return false;
                }
            }
        }
    }
}
