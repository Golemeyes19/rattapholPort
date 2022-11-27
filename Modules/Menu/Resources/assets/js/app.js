$(document).ready(function() {
    // init for table all
    initDatamenu();
});

setReloadDataTable = function() {
    $('#menu-datatable').DataTable().ajax.reload(null, false);
}

// =========================  menu =========================== //
initDatamenu = function() {
    if ($('#menu-datatable').length > 0) {
        oTable = $('#menu-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "/admin/menu/datatable_ajax"
            },
            "columns": [
                // { "data": 'DT_RowIndex', orderable: false, searchable: false },
                { "data": '_lft', orderable: true, searchable: false },
                { "data": "name_th" },
                { "data": "name_en" },
                { "data": "updated_at" },
                { "data": "sort", orderable: false, searchable: false },
                { "data": "actionEdit", orderable: false, searchable: false }
            ]
        });
    }
}

setUpdateStatusMenu = function(id, status) {
    event.preventDefault();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/menu/set_status",
        type: "POST",
        data: {
            id: id,
            status: status,
            _token: _token
        },
        success: function(resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                setReloadDataTable();
            } else {
                mwz_noti('error', resp.msg);
                setReloadDataTable();
            }
        },
    });
}

setDeleteMenu = function (id) {
    bootbox.confirm({
        message: "ยืนยันลบ เมนู ?",
        buttons: {
            confirm: {
                label: 'ตกลง',
                className: 'btn-success'
            },
            cancel: {
                label: 'ยกเลิก',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                event.preventDefault();
                let _token = $('meta[name="csrf-token"]').attr('content');
    
                $.ajax({
                    url: "/admin/menu/set_delete",
                    type: "POST",
                    data: {
                        id: id,
                        status: status,
                        _token: _token
                    },
                    success: function(resp) {
                        if (resp.success) {
                            mwz_noti('success', resp.msg);
                            setReloadDataTable();
                        } else {
                            mwz_noti('error', resp.msg);
                            setReloadDataTable();
                        }
                    },
                });
            }
        }
    });
}


setSaveMenu = function() {
    event.preventDefault();
    tinyMCE.triggerSave();
    var frm_data = new FormData($('#menu_frm')[0]);
    $.ajax({
        url: "/admin/menu/save",
        type: "POST",
        contentType: false,
        data: frm_data,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function(xhr) {
            // mwz_global_loading(1);
            var rules = {
                name_th: {
                    required: true,
                    maxlength: 500
                },
                name_en: {
                    required: true,
                    maxlength: 500
                },
                slug_th: {
                    required: true,
                    maxlength: 500
                },
                slug_en: {
                    required: true,
                    maxlength: 500
                },
                sequence: {
                    required: true,
                    number: true
                },
            }

            var messages = {
                name_th: {
                    required: "กรุณาระบุชื่อเมนูภาษาไทย",
                    maxlength: "กรุณาระบุชื่อเมนูภาษาไทยไม่เกิน {0} ตัวอักษร"
                },
                name_en: {
                    required: "กรุณาระบุชื่อเมนูภาษาอังกฤษ",
                    maxlength: "กรุณาระบุชื่อเมนูภาษาอังกฤษไม่เกิน {0} ตัวอักษร"
                },
                slug_th: {
                    required: "กรุณาระบุชื่อ URL",
                    maxlength: "กรุณาระบุชื่อ URL ไม่เกิน {0} ตัวอักษร"
                },
                slug_en: {
                    required: "กรุณาระบุชื่อ URL",
                    maxlength: "กรุณาระบุชื่อ URL ไม่เกิน {0} ตัวอักษร"
                },
                sequence: {
                    required: "กรุณาระบุลำดับการแสดงผล",
                    number: "กรุณาระบุลำดับการแสดงผลเป็นตัวเลขเท่านั้น"
                }
            }

            mwz_frm_validate($("#menu_frm"), rules, messages)

            if( $("#menu_frm").valid()) {
                return $("#menu_frm").valid();
            }else{
                // mwz_noti('error',resp.msg);
                mwz_global_loading(0);
                mwz_noti('error','ข้อมูลไม่ถูกต้อง');
                return $("#menu_frm").valid();
            }

        },
        success: function(resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                window.location.href = '/admin/menu/';
            } else {
                mwz_noti('error', resp.msg);
                // document.getElementById(resp.focus).focus();
            }
        },
    });
}

setUpdateUpMenu = function(id) {
    event.preventDefault();

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/menu/menu_up",
        type: "POST",
        data: {
            id: id,
            _token: _token
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            setReloadDataTable();
              
        },
    });
}

setUpdateDownMenu = function(id) {
    event.preventDefault();

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/menu/menu_down",
        type: "POST",
        data: {
            id: id,
            _token: _token
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            setReloadDataTable();
        },
    });
}