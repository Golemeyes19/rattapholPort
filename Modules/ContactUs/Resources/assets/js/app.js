$(document).ready(function () {
    // init for table all
    initDatatable();
    initDatatableSubject();

    //tab inti
    // if ($('.first_tab').length > 0) {
    //     $(".first_tab").champ();
    // }
});

initDatatable = function () {
    if ($('#contactus-datatable').length > 0) {
        oTable = $('#contactus-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "/admin/contactus/datatable_ajax"
            },
            "columns": [
                { "data": "id", orderable: false, searchable: true },
                { "data": "name" },
                { "data": "subject" },
                { "data": "created_at" },
                { "data": "action", orderable: false, searchable: false }
            ]
        });
    }
}


setReloadDataTable = function () {
    $('#contactus-datatable').DataTable().ajax.reload(null, false);
}

setUpdateStatus = function (id, status) {
    event.preventDefault();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/contactus/set_status",
        type: "POST",
        data: {
            id: id,
            status: status,
            _token: _token
        },
        success: function (resp) {
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
        message: "ยืนยันลบ รายชื่อผู้ติดต่อ ?",
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
                    url: "/admin/contactus/set_delete",
                    type: "POST",
                    data: {
                        id: id,
                        status: status,
                        _token: _token
                    },
                    success: function (resp) {
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

setSave = function () {
    event.preventDefault();
    tinyMCE.triggerSave();
    var frm_data = new FormData($('#contactus_frm')[0]);
    $.ajax({
        url: "/admin/contactus/save",
        type: "POST",
        contentType: false,
        data: frm_data,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            var rules = {
                message: "required",
                replay: "required",
                status: "required"
            }

            var messages = {
                message: "Please enter member message",
                replay: "Please enter member replay",
                agree: "Please select status"
            }

            mwz_frm_validate($("#contactus_frm"), rules, messages)

            if ($("#contactus_frm").valid()) {
                return $("#contactus_frm").valid();
            } else {
                mwz_noti('error', resp.msg);
                return $("#contactus_frm").valid();
            }
        },
        success: function (resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                window.location.href = '/admin/contactus/';
            } else {
                mwz_noti('error', resp.msg);
            }
        },
    });
}

setSaveContactPage=function(){
    event.preventDefault();
    tinyMCE.triggerSave();
    var frm_data = new FormData($('#contactpage_frm')[0]);
    console.log(frm_data)
    $.ajax({
        url: "/admin/contactus/save_contact_page" ,
        type:"POST",
        contentType: false,
        data: frm_data ,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend:function(xhr){
            var rules = {
                    head_office_th: { maxlength: 500 },
                    head_office_en: { maxlength: 500 },
                    factory_th: { maxlength: 500 },
                    factory_en: { maxlength: 500 },
                    fb: { maxlength: 255 },
                    line: { maxlength: 255 },
                    youtube: { maxlength: 255 },
                    instagram_url: { maxlength: 255 },
                    phone_head_office: { maxlength: 10 },
                    phone_factory: { maxlength: 10 },
                    email_head_office: { maxlength: 250 },
                    email_factory: { maxlength: 250 },
                    gmaps: { maxlength: 500 }
                }
            var messages = {
                    message: "กรุณากรอกข้อความสมาชิก",
                    replay: "กรุณากรอกสมาชิกตอบกลับ",
                    agree: "กรุณาเลือกสถานะ",
                    head_office_th: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    head_office_en: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    factory_th: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    factory_en: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    fb: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    line: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    youtube: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    instagram_url: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    phone_head_office: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    phone_factory: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    email_head_office: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    email_factory: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร",
                    gmaps: "กรุณากรอกข้อมูลไม่เกิน {0} ตัวอักษร"
                }
            mwz_frm_validate($("#contactpage_frm"),rules,messages)
            if( $("#contactpage_frm").valid()) {
                return $("#contactpage_frm").valid();
            }else{
                mwz_noti('error',resp.msg);
                return $("#contactpage_frm").valid();
            }
        },
        success:function(resp){
            if(resp.success){
                mwz_noti('success',resp.msg);
                window.location.href = '/admin/contactus/edit' ;
            }else{
                mwz_noti('error',resp.msg);
            }
        },
    });
}


setSaveContactSubject = function () {
    event.preventDefault();
    tinyMCE.triggerSave();
    var frm_data = new FormData($('#contactsubject_frm')[0]);
    $.ajax({
        url: "/admin/contactus/save_subject",
        type: "POST",
        contentType: false,
        data: frm_data,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            var rules = {
                subject: "required",
                subject_en: "required",
                to_email: "required",
                cc_email: "required"
            }

            var messages = {
                subject: "Please enter subject message",
                subject_en: "Please enter subject message",
                to_email: "Please enter TO Email",
                cc_email: "Please enter CC Email"
            }

            mwz_frm_validate($("#contactsubject_frm"), rules, messages)

            if ($("#contactsubject_frm").valid()) {
                return $("#contactsubject_frm").valid();
            } else {
                mwz_noti('error', resp.msg);
                return $("#contactsubject_frm").valid();
            }
        },
        success: function (resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                window.location.href = '/admin/contactus/subject_index';
            } else {
                mwz_noti('error', resp.msg);
            }
        },
    });

}

initDatatableSubject = function () {
    if ($('#contactus-subject-datatable').length > 0) {
        oTable = $('#contactus-subject-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "/admin/contactus/datatable_ajax_subject"
            },
            "columns": [
                { "data": "id", orderable: false, searchable: false },
                { "data": "subject" },
                { "data": "updated_at" },
                { "data": "action", orderable: false, searchable: false }
            ]
        });
    }
}

set_delete_subject = function (id) {
    bootbox.confirm({
        message: "ยืนยันลบ รายชื่อหัวข้อที่ติดต่อเรา ?",
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
                    url: "/admin/contactus/set_delete_subject",
                    type: "POST",
                    data: {
                        id: id,
                        status: status,
                        _token: _token
                    },
                    success: function (resp) {
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

set_status_subject = function (id, status) {
    event.preventDefault();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/contactus/set_status_subject",
        type: "POST",
        data: {
            id: id,
            status: status,
            _token: _token
        },
        success: function (resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                setReloadDataTableSubject();
            } else {
                mwz_noti('error', resp.msg);
                setReloadDataTableSubject();
            }
        },
    });
}

setReloadDataTableSubject = function () {
    $('#contactus-subject-datatable').DataTable().ajax.reload(null, false);
}

SendContactSubject = function () {
    event.preventDefault();
    tinyMCE.triggerSave();
    var frm_data = new FormData($('#send_contactsubject_frm')[0]);
    $.ajax({
        url: "/dev/contactus/send",
        type: "POST",
        contentType: false,
        data: frm_data,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {
            var rules = {
                subject: "required",
                email: "required",
                name: "required",
                phone: "required",
                message: "required"
            }

            var messages = {
                subject: "Please enter select subject",
                email: "Please enter email",
                name: "Please enter name",
                phone: "Please enter phone",
                message: "Please enter message"
            }

            mwz_frm_validate($("#send_contactsubject_frm"), rules, messages)

            if ($("#send_contactsubject_frm").valid()) {
                return $("#send_contactsubject_frm").valid();
            } else {
                mwz_noti('error', resp.msg);
                return $("#send_contactsubject_frm").valid();
            }
        },
        success: function (resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                window.location.href = '/dev/contactus/form';
            } else {
                mwz_noti('error', resp.msg);
            }
        },
    });

}