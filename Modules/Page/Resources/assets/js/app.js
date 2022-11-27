$(document).ready(function () {
    //tab inti
    if ($('.first_tab').length > 0) {
        $(".first_tab").champ();
    }

    $(function () {
        $('#datetimepicker').datetimepicker();
    });

    if ($('.dropify').length > 0) {
        var drEvent = $('.dropify').dropify();
        drEvent.on('dropify.afterClear', function (event, element) {
            var form = $(element.element.form);
            var input = '<input type="hidden" name="delete_' + element.element.name + '" value="1"/>';
            form.append(input);
        });
    }
    
});
// =========================  page =========================== //
initDatatable = function () {
    if ($('#page-datatable').length > 0) {
        oTable = $('#page-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "/admin/page/datatable_ajax"
            },
            "columns": [{
                    "data": "DT_RowIndex",
                    searchable: false
                },
                {
                    "data": "image",
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "name_th"
                },
                {
                    "data": "updated_at"
                },
                {
                    "data": "action",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    }
}

ReloadPageTable = function () {
    $('#page-datatable').DataTable().ajax.reload(null, false);
}

setUpdateStatus = function (id, status) {
    event.preventDefault();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/page/set_status",
        type: "POST",
        data: {
            id: id,
            status: status,
            _token: _token
        },
        success: function (resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                ReloadPageTable();
            } else {
                mwz_noti('error', resp.msg);
                ReloadPageTable();
            }
        },
    });
}

setDelete = function (id) {
    bootbox.confirm({
        message: "ยืนยันลบ เพจ ?",
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
                    url: "/admin/page/set_delete",
                    type: "POST",
                    data: {
                        id: id,
                        status: status,
                        _token: _token
                    },
                    success: function (resp) {
                        if (resp.success) {
                            mwz_noti('success', resp.msg);
                            ReloadPageTable();
                        } else {
                            mwz_noti('error', resp.msg);
                            ReloadPageTable();
                        }
                    },
                });
            }
        }
    });
}


setSave = function () {
    event.preventDefault();
    tinyMCE.triggerSave();

    var frm_data = new FormData($('#page_frm')[0]);

    $.ajax({
        url: "/admin/page/save",
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
                description_th: {
                    required: true,
                },
                detail_th: {
                    required: true,
                },
                description_en: {
                    required: true,
                },
                detail_en: {
                    required: true,
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
                description_th: {
                    required: "กรุณาระบุคำอธิบายภาษาไทย",
                },
                description_en: {
                    required: "กรุณาระบุคำอธิบายภาษาอังกฤษ",
                },
                detail_th: {
                    required: "กรุณาระบุรายละเอียดภาษาไทย",
                },
                detail_en: {
                    required: "กรุณาระบุรายละเอียดภาษาอังกฤษ",
                },
                sequence: {
                    required: "กรุณาระบุลำดับการแสดงผล",
                    number: "กรุณาระบุลำดับการแสดงผลเป็นตัวเลขเท่านั้น"
                }
            }

            mwz_frm_validate($("#page_frm"), rules, messages)

            if( $("#page_frm").valid()) {
                return $("#page_frm").valid();
            }else{
                // mwz_noti('error',resp.msg);
                mwz_global_loading(0);
                mwz_noti('error','ข้อมูลไม่ถูกต้อง');
                return $("#page_frm").valid();
            }

        },
        success: function (resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                window.location.href = '/admin/page/index';
            } else {
                mwz_noti('error', resp.msg);
                if (resp.focus) {
                    document.getElementById(resp.focus).focus();
                }
            }
        },
    });

}