$(document).ready(function() {
    // init for news
    initDatatable();
    initDatatableNewsCategory();

    //tab inti
    if ($('.first_tab').length > 0) {
        $(".first_tab").champ();
    }

});

// =========================  news =========================== //

initDatatable = function() {
    if ($('#news-datatable').length > 0) {
        oTable = $('#news-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "/admin/news/datatable_ajax"
            },
            "columns": [
                { "data": "id", orderable: true, searchable: false },
                { "data": "image" },
                { "data": "name_th" },
                { "data": "name_en" },
                { "data": "updated_at" },
                { "data": "action", orderable: false, searchable: false }
            ]
        });
    }
}

initDatatableNewsCategory = function() {
    if ($('#news-category-datatable').length > 0) {
        oTable = $('#news-category-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "/admin/news/datatable_ajax_news_category"
            },
            "columns": [
                { "data": "_lft", searchable: false },
                { "data": "name_th" },
                { "data": "name_en" },
                { "data": "updated_at" },
                { "data": "sort", orderable: false, searchable: false },
                { "data": "action", orderable: false, searchable: false }
            ]
        });
    }
}

setReloadDataTableNewsCategory = function() {
    $('#news-category-datatable').DataTable().ajax.reload(null, false);
}

setReloadDataTable = function() {
    $('#news-datatable').DataTable().ajax.reload(null, false);
}

setUpdateStatus = function(id, status) {
    event.preventDefault();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/news/set_status",
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


setDelete = function (id) {
    bootbox.confirm({
        message: "ยืนยันลบ ข่าว ?",
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
                    url: "/admin/news/set_delete",
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


setSave = function() {
    event.preventDefault();
    tinyMCE.triggerSave();

    var frm_data = new FormData($('#news_frm')[0]);

    $.ajax({
        url: "/admin/news/save",
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
                publish_at: {
                    required: true,
                },
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
                publish_at: {
                    required: "กรุณาระบุวันที่เผยแพร่",
                },
                name_th: {
                    required: "กรุณาระบุชื่อหัวข้อภาษาไทย",
                    maxlength: "กรุณาระบุชื่อหัวข้อภาษาไทยไม่เกิน {0} ตัวอักษร"
                },
                name_en: {
                    required: "กรุณาระบุชื่อหัวข้อภาษาอังกฤษ",
                    maxlength: "กรุณาระบุชื่อหัวข้อภาษาอังกฤษไม่เกิน {0} ตัวอักษร"
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

            mwz_frm_validate($("#news_frm"), rules, messages)

            if( $("#news_frm").valid()) {
                return $("#news_frm").valid();
            }else{
                // mwz_noti('error',resp.msg);
                mwz_global_loading(0);
                mwz_noti('error','ข้อมูลไม่ถูกต้อง');
                return $("#news_frm").valid();
            }

        },
        success: function(resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                window.location.href = '/admin/news/index';
            } else {
                mwz_noti('error', resp.msg);
                document.getElementById(resp.focus).focus();
            }
        },
    });

}

setSaveNewsCategory = function() {
    event.preventDefault();
    tinyMCE.triggerSave();

    var frm_data = new FormData($('#news_category_frm')[0]);

    // console.log(frm_data)

    $.ajax({
        url: "/admin/news/save_news_category",
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
                    required: "กรุณาระบุชื่อหมวดหมู่ภาษาไทย",
                    maxlength: "กรุณาระบุชื่อหมวดหมู่ภาษาไทยไม่เกิน {0} ตัวอักษร"
                },
                name_en: {
                    required: "กรุณาระบุชื่อหมวดหมู่ภาษาอังกฤษ",
                    maxlength: "กรุณาระบุชื่อหมวดหมู่ภาษาอังกฤษไม่เกิน {0} ตัวอักษร"
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

            mwz_frm_validate($("#news_category_frm"), rules, messages)

            if( $("#news_category_frm").valid()) {
                return $("#news_category_frm").valid();
            }else{
                // mwz_noti('error',resp.msg);
                mwz_global_loading(0);
                mwz_noti('error','ข้อมูลไม่ถูกต้อง');
                return $("#news_category_frm").valid();
            }

        },
        success: function(resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                window.location.href = '/admin/news/index_news_category';
            } else {
                mwz_noti('error', resp.msg);
                document.getElementById(resp.focus).focus();
            }
        },
    });

}

setUpdateStatusNewsCategory = function(id, status) {
    event.preventDefault();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/news/set_status_news_category",
        type: "POST",
        data: {
            id: id,
            status: status,
            _token: _token
        },
        success: function(resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                setReloadDataTableNewsCategory();
            } else {
                mwz_noti('error', resp.msg);
                setReloadDataTableNewsCategory();
            }
        },
    });
}

setDeleteNewsCategory = function (id) {
    bootbox.confirm({
        message: "ยืนยันลบ หมวดหมู่ข่าว ?",
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
                    url: "/admin/news/set_delete_news_category",
                    type: "POST",
                    data: {
                        id: id,
                        status: status,
                        _token: _token
                    },
                    success: function(resp) {
                        if (resp.success) {
                            mwz_noti('success', resp.msg);
                            setReloadDataTableNewsCategory();
                        } else {
                            mwz_noti('error', resp.msg);
                            setReloadDataTableNewsCategory();
                        }
                    },
                });
            }
        }
    });
}

/* ----------------------- Customs ----------------------------------------------------------*/
// input only number and . point
InputValidateString = function(evt) {
    var theEvent = evt || window.event;

    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }

    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

setUpdateUpMenu = function(id) {
    event.preventDefault();

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/news/menu_up",
        type: "POST",
        data: {
            id: id,
            _token: _token
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            setReloadDataTableNewsCategory();
              
        },
    });
}

setUpdateDownMenu = function(id) {
    event.preventDefault();

    var _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/news/menu_down",
        type: "POST",
        data: {
            id: id,
            _token: _token
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            setReloadDataTableNewsCategory();
        },
    });
}