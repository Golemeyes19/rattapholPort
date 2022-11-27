$(document).ready(function() {
    // init for banner
    initDatatable();

    // Init dropify remove image event
    initDropifyRemoveEvent();

    //tab inti
    if ($('.first_tab').length > 0) {
        $(".first_tab").champ();
    }

});

// =========================  banner ======================================= //
initDatatable = function() {
    if ($('#banner-datatable').length > 0) {
        oTable = $('#banner-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "/admin/banner/datatable_ajax"
            },
            "columns": [
                { "data": "sequence", orderable: true, searchable: false },
                { "data": "image" },
                { "data": "name_th" },
                { "data": "name_en" },
                { "data": "menu_id" },
                { "data": "updated_at" },
                { "data": "action", orderable: false, searchable: false }
            ]
        });
    }
}

setReloadDataTable = function() {
    $('#banner-datatable').DataTable().ajax.reload(null, false);
}

setUpdateStatus = function(id, status) {
    event.preventDefault();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/admin/banner/set_status",
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
        message: "ยืนยันลบ แบนเนอร์ ?",
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
                    url: "/admin/banner/set_delete",
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

    var frm_data = new FormData($('#banner_frm')[0]);

    $.ajax({
        url: "/admin/banner/save",
        type: "POST",
        contentType: false,
        data: frm_data,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function(xhr) {
            if ($("#banner_frm").valid()) {
                return $("#banner_frm").valid();
            } else {
                mwz_noti('error', resp.msg);
                return $("#banner_frm").valid();
            }
        },
        success: function(resp) {
            if (resp.success) {
                mwz_noti('success', resp.msg);
                window.location.href = '/admin/banner/index';
            } else {
                mwz_noti('error', resp.msg);
                document.getElementById(resp.focus).focus();
            }
        },
    });
}

initDropifyRemoveEvent = function(){
    $("#image").next(".dropify-clear").click(function(e){
        $('#is_delete_image_1').val("1");
    });
    $("#image_2").next(".dropify-clear").click(function(e){
        $('#is_delete_image_2').val("1");
    });
    $("#image_3").next(".dropify-clear").click(function(e){
        $('#is_delete_image_3').val("1");
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