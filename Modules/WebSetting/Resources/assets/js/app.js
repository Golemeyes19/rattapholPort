$(document).ready(function () {

    //tab inti
    if ($('.first_tab').length > 0) {
        $(".first_tab").champ();
    }

    lightGallery(document.getElementById('lightgallery_2'));
    lightGallery(document.getElementById('lightgallery_3'));

});



setSave = function () {
    event.preventDefault();
    tinyMCE.triggerSave();

    var frm_data = new FormData($('#setting_frm')[0]);

    $.ajax({
        url: "/admin/websetting/save",
        type: "POST",
        contentType: false,
        data: frm_data,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                window.location.href = '/admin/websetting/edit';
            } else {
                mwz_noti('error', resp.msg);
            }
        },
    });

}

setSavePrivacy = function () {
    event.preventDefault();
    tinyMCE.triggerSave();

    var frm_data = new FormData($('#privacy_frm')[0]);

    $.ajax({
        url: "/admin/websetting/save_privacy",
        type: "POST",
        contentType: false,
        data: frm_data,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function (xhr) {

            if ($("#privacy_frm").valid()) {
                return $("#privacy_frm").valid();
            } else {
                mwz_noti('error', resp.msg);
                return $("#privacy_frm").valid();
            }
        },
        success: function (resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                window.location.href = '/admin/websetting/form_privacy/1';
            } else {
                mwz_noti('error', resp.msg);
            }
        },
    });
}

JsReload = function (time) {
    setInterval(function () {
        window.location.reload();
    }, time);
}

JsRedirect = function (url, time) {
    setInterval(function () {
        window.location.replace(url);
    }, time);
}

DeleteImage = function (id) {
    bootbox.confirm({
        message: "ยืนยันลบ รูป ?",
        buttons: {
            confirm: {
                label: 'ยืนยัน',
                className: 'btn-success'
            },
            cancel: {
                label: 'ยกเลิก',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                let _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "/admin/websetting/delete_image",
                    type: "POST",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function (resp) {
                        if (resp.success) {
                            mwz_noti('success', resp.msg);
                            JsReload(1000);
                        } else {
                            mwz_noti('error', resp.msg);
                        }
                    },
                });
            }
        }
    });
}