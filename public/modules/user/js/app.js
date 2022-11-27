
$( document ).ready(function() {
    // init for user
    initDatatable();

     // init for user group
    initGroupdatatable();

    // init for user role
    initRoleDatatable();

    //treeview
    $('.treeview').treed();
   
});

// =========================  master =========================== //
initDatatable= function (){
    if($('#user-datatable').length>0){
        oTable= $('#user-datatable').DataTable( {
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "/admin/user/datatable_ajax"
            },
            "columns": [
                { "data": "id" , orderable: false, searchable: false},
                { "data": "name" },
                { "data": "group" , orderable: false, searchable: false },
                { "data": "updated_at"  },
                { "data": "action", orderable: false, searchable: false }
            ]
        } );
    }
}

setReloadDataTable = function (){
   $('#user-datatable').DataTable().ajax.reload(null, false );
}


setUpdateStatus=function(id,status){
    event.preventDefault();
    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/user/set_status",
        type:"POST",
        data:{
          id:id,
          status:status,
          _token: _token
        },
        success:function(resp){
            if(resp.success){
                mwz_noti('success',resp.msg);
                setReloadDataTable();
            }else{
                mwz_noti('error',resp.msg);
                setReloadDataTable();
            }
        },
    });
}


setDelete=function(id){
    bootbox.confirm("Are you sure to delete user?", function(result){
        if(result){
            event.preventDefault();
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/admin/user/set_delete",
                type:"POST",
                data:{
                  id:id,
                  status:status,
                  _token: _token
                },
                success:function(resp){
                    if(resp.success){
                        mwz_noti('success',resp.msg);
                        setReloadDataTable();
                    }else{
                        mwz_noti('error',resp.msg);
                        setReloadDataTable();
                    }
                },
            });
        }
    })
}


setSave=function(){
    event.preventDefault();
    tinyMCE.triggerSave();
    var frm_data = new FormData($('#user_frm')[0]);
    $.ajax({
        url: "/admin/user/save" ,
        type:"POST",
        contentType: false,
        data: frm_data ,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend:function(xhr){
            var rules = {
                    name: { required: true },
                    username: { required: true },
                    email: {
                            required: true,
                            email: true
                    },
                    password: {
                        minlength: 8,
                        required: function(){
                            if( $('#user_id').val()==0 ){
                                return true;
                            }else{
                                return false;
                            }
                        }
                    },
                    re_password: {
                        minlength: 8,
                        equalTo : "#password",
                        required: function(){
                            if( $('#user_id').val()==0 ){
                                return true;
                            }else{
                                return false;
                            }
                        }
                    }

                }

            var messages = {
                    name: "Please enter user name",
                    username: "Please enter user username",
                    email: {
                        required: "Enter a email",
                        email: "Enter valid email",
                    },
                    password: {
                        required: "Enter a username",
                        minlength: "Enter at least {0} characters",
                    },
                    re_password: {
                        required: "Enter a username",
                        minlength: "Enter at least {0} characters",
                    }
                }

            mwz_frm_validate($("#user_frm"),rules,messages)

            if( $("#user_frm").valid()) {
                return $("#user_frm").valid();
            }else{
                mwz_noti('error','form data invalid');
                return $("#user_frm").valid();
            }
        },
        success:function(resp){
            if(resp.success){
                mwz_noti('success',resp.msg);
                window.location.href = '/admin/user/' ;
            }else{
                mwz_noti('error',resp.msg);
            }
        },
    });
    
}

setChangeGroup=function(group_id){
    $('#show_roles').find(':checkbox').prop( "checked", false );
    if(typeof groups_default_role[group_id] != 'undefined'){
        var default_role = groups_default_role[group_id] ;
        $.each(default_role,function(module,roles){
            $.each(roles,function(page,role){
                $.each(role,function(index,action){
                    var chk_box = "#"+module+"_"+page+"_"+action;
                    $(chk_box).prop( "checked", true );
                });
            });
        });
    }
}

// =========================  user group =========================== //
// 
initGroupdatatable= function (){
    if($('#user-group-datatable').length>0){
        oTable= $('#user-group-datatable').DataTable( {
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "/admin/user/group_datatable_ajax"
            },
            "columns": [
                { "data": "id" , orderable: false, searchable: false},
                { "data": "name" },
                { "data": "updated_at"  },
                { "data": "action", orderable: false, searchable: false }
            ]
        } );
    }
}


setReloadGroupDataTable = function (){
   $('#user-group-datatable').DataTable().ajax.reload(null, false );
}


setUpdateGroupStatus=function(category_id,status){
    event.preventDefault();
    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/user/set_group_status",
        type:"POST",
        data:{
          category_id:category_id,
          status:status,
          _token: _token
        },
        success:function(resp){
            if(resp.success){
                mwz_noti('success',resp.msg);
                setReloadCategoryDataTable();
            }else{
                mwz_noti('error',resp.msg);
                setReloadCategoryDataTable();
            }
        },
    });
}


setDeleteGroup=function(group_id){
    bootbox.confirm("Are you sure to delete group?", function(result){
        if(result){
            event.preventDefault();
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/admin/user/set_group_delete",
                type:"POST",
                data:{
                  group_id:group_id,
                  status:status,
                  _token: _token
                },
                success:function(resp){
                    if(resp.success){
                        mwz_noti('success',resp.msg);
                        setReloadGroupDataTable();
                    }else{
                        mwz_noti('error',resp.msg);
                        setReloadGroupDataTable();
                    }
                },
            });
        }
    })
}


setSaveGroup=function(frm){
    event.preventDefault();
    tinyMCE.triggerSave();

    var frm_data = new FormData($('#user_group_frm')[0]);

    $.ajax({
        url: "/admin/user/group/save" ,
        type:"POST",
        contentType: false,
        data: frm_data ,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend:function(xhr){
            var rules = {
                    name: "required",
                    description: "required",
                    parent_id: "required",
                    status: "required"
                }

            var messages = {
                    name: "Please enter category name",
                    description: "Please enter category description",
                    parent_id: "Please select Group",
                    status: "Please select status"
                }

            mwz_frm_validate($("#user_group_frm"),rules,messages)

            if( $("#user_group_frm").valid()) {
                return $("#user_group_frm").valid();
            }else{
                mwz_noti('error',resp.msg);
                return $("#user_group_frm").valid();
            }
        },
        success:function(resp){
            if(resp.success){
                mwz_noti('success',resp.msg);
                window.location.href = '/admin/user/group/' ;
            }else{
                mwz_noti('error',resp.msg);
            }
        },
    });
    
}

setCheckAllPermission=function(ele,group){
    var check = $(ele).is(':checked'); 
    $(ele).closest('li').find('input.'+group).each(function(){
        if(check){
            $(this).prop( "checked", true );
        }else{
            $(this).prop( "checked", false );
        }
    });
}

// =========================  user role =========================== //

initRoleDatatable= function (){
    if($('#user-role-datatable').length>0){
        oTable= $('#user-role-datatable').DataTable( {
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "/admin/user/role_datatable_ajax"
            },
            "columns": [
                { "data": "id" , orderable: false, searchable: false},
                { "data": "name" },
                { "data": "updated_at"  },
                { "data": "action", orderable: false, searchable: false }
            ]
        } );
    }
}

setReloadRoleDataTable = function (){
   $('#user-role-datatable').DataTable().ajax.reload(null, false );
}

setUpdateRoleStatus=function(role_id,status){
    event.preventDefault();
    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/user/set_role_status",
        type:"POST",
        data:{
          role_id:role_id,
          status:status,
          _token: _token
        },
        success:function(resp){
            if(resp.success){
                mwz_noti('success',resp.msg);
                setReloadRoleDataTable();
            }else{
                mwz_noti('error',resp.msg);
                setReloadRoleDataTable();
            }
        },
    });
}


setDeleteRole=function(group_id){
    bootbox.confirm("Are you sure to delete role?", function(result){
        if(result){
            event.preventDefault();
            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "/admin/user/set_role_delete",
                type:"POST",
                data:{
                  category_id:category_id,
                  status:status,
                  _token: _token
                },
                success:function(resp){
                    if(resp.success){
                        mwz_noti('success',resp.msg);
                        setReloadRoleDataTable();
                    }else{
                        mwz_noti('error',resp.msg);
                        setReloadRoleDataTable();
                    }
                },
            });
        }
    })
}


setSaveRole=function(frm){
    event.preventDefault();
    tinyMCE.triggerSave();

    var frm_data = new FormData($('#user_role_frm')[0]);

    $.ajax({
        url: "/admin/user/role/save" ,
        type:"POST",
        contentType: false,
        data: frm_data ,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend:function(xhr){
            var rules = {
                    name: "required",
                    description: "required",
                    status: "required"
                }

            var messages = {
                    name: "Please enter category name",
                    description: "Please enter category description",
                    status: "Please select status"
                }

            mwz_frm_validate($("#user_role_frm"),rules,messages)

            if( $("#user_role_frm").valid()) {
                return $("#user_role_frm").valid();
            }else{
                mwz_noti('error',resp.msg);
                return $("#user_role_frm").valid();
            }
        },
        success:function(resp){
            if(resp.success){
                mwz_noti('success',resp.msg);
                window.location.href = '/admin/user/role/' ;
            }else{
                mwz_noti('error',resp.msg);
            }
        },
    });
    
}
