/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./Resources/assets/js/app.js":
/*!************************************!*\
  !*** ./Resources/assets/js/app.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // init for banner
  initDatatable();
  initTableCheckAll(); //tab inti

  if ($('.first_tab').length > 0) {
    $(".first_tab").champ();
  }
});
$(function () {
  'use strict';

  if ($('.fc-datepicker').length > 0) {
    // DATETIMEPICKER
    $('.fc-datepicker').datetimepicker({
      widgetPositioning: {
        horizontal: 'auto',
        vertical: 'bottom'
      },
      format: 'DD/MM/YYYY hh:ss A'
    });
  }

  if ($('.fc-filter-datepicker').length > 0) {
    // DATETIMEPICKER
    $('.fc-filter-datepicker').datetimepicker({
      widgetPositioning: {
        horizontal: 'auto',
        vertical: 'bottom'
      },
      format: 'DD/MM/YYYY'
    });
    $("#date_start_filter").on("dp.change", function (e) {
      oTable.draw();
    });
    $("#date_end_filter").on("dp.change", function (e) {
      oTable.draw();
    });
  }
}); // =========================  Order ======================================= //

initDatatable = function initDatatable() {
  if ($('#order-datatable').length > 0) {
    oTable = $('#order-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/order/datatable_ajax",
        data: function data(d) {
          d.member_type = $('#member_type').val(), d.payment_status = $('#payment_status').val(), d.shipping_filter_status = $('#shipping_filter_status').val(), d.period_filter = $('#period_filter').val(), d.payment_method_filter = $('#payment_method_filter').val(), d.discount_rule_filter = $('#discount_rule_filter').val(), d.date_start_filter = $('#date_start_filter').val(), d.date_end_filter = $('#date_end_filter').val();
        }
      },
      "columns": [{
        "data": "sequence",
        orderable: false,
        searchable: false
      }, {
        "data": "created_at",
        orderable: true,
        searchable: false
      }, {
        "data": "member_name",
        orderable: false,
        searchable: true
      }, {
        "data": "order_code",
        orderable: false,
        searchable: true
      }, {
        "data": "grand_total",
        orderable: false,
        searchable: false
      }, {
        "data": "action",
        orderable: false,
        searchable: false
      }]
    });
  }
};

setUpdateStatus = function setUpdateStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/order/set_order_status",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        JsReloadTable('order-datatable');
      } else {
        mwz_noti('error', resp.msg);
        JsReloadTable('order-datatable');
      }
    }
  });
};

setDelete = function setDelete(id) {
  bootbox.confirm("Are you sure to delete banner?", function (result) {
    if (result) {
      event.preventDefault();

      var _token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/admin/banner/set_delete",
        type: "POST",
        data: {
          id: id,
          status: status,
          _token: _token
        },
        success: function success(resp) {
          if (resp.success) {
            mwz_noti('success', resp.msg);
            JsReloadTable('banner-datatable');
          } else {
            mwz_noti('error', resp.msg);
            JsReloadTable('banner-datatable');
          }
        }
      });
    }
  });
};

setSave = function setSave() {
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
    beforeSend: function beforeSend(xhr) {
      if ($("#banner_frm").valid()) {
        return $("#banner_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#banner_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);

        if (resp.code == 201) {
          JsReload(1500);
        } else {
          JsRedirect('/admin/banner/index', 1500);
        }
      } else {
        mwz_noti('error', resp.msg);
        document.getElementById(resp.focus).focus();
      }
    }
  });
};

setDelete = function setDelete(id, order_code) {
  bootbox.confirm({
    title: "ยืนยันการลบข้อมูล",
    message: "คุณยืนยันที่จะลบข้อมูล Order " + order_code + " ?",
    centerVertical: true,
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/order/set_delete_order",
          type: "POST",
          data: {
            id: id,
            _token: _token
          },
          success: function success(resp) {
            if (resp.success) {
              mwz_noti('success', resp.msg);
              JsReloadTable('order-datatable');
            } else {
              mwz_noti('error', resp.msg);
              JsReloadTable('order-datatable');
            }
          }
        });
      }
    }
  });
};

setDeleteAll = function setDeleteAll() {
  var checkLength = $('input.checkbox-input:checked').length;

  if (checkLength >= 1) {
    bootbox.confirm({
      title: "ยืนยันการลบข้อมูล",
      message: "คุณยืนยันที่จะลบข้อมูล Order จำนวน " + checkLength + " รายการ ?",
      centerVertical: true,
      callback: function callback(result) {
        if (result) {
          event.preventDefault();

          var _token = $('meta[name="csrf-token"]').attr('content');

          var checkedRows = new Array();
          $("input.checkbox-input:checked").each(function () {
            checkedRows.push($(this).val());
          });
          $.ajax({
            url: "/admin/order/set_delete_order_all",
            type: "POST",
            data: {
              delete_id: checkedRows,
              _token: _token
            },
            success: function success(resp) {
              if (resp.success) {
                mwz_noti('success', resp.msg);
                JsReloadTable('order-datatable');
              } else {
                mwz_noti('error', resp.msg);
                JsReloadTable('order-datatable');
              }
            }
          });
        }
      }
    });
  }
};

setShowShippingInfo = function setShowShippingInfo(order_id) {
  event.preventDefault();
  $('#shipping_frm').trigger("reset");
  $.ajax({
    url: "/admin/order/get_shipping_info",
    type: "POST",
    data: {
      order_id: order_id
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(resp) {
      if (resp.success) {
        if (typeof resp.data.order_code !== 'undefined' && resp.data.order_code != "") {
          $('.customer_order_code').html('(' + resp.data.order_code + ')');
        }

        if (typeof resp.data.shipping_tracking_no !== 'undefined' && resp.data.shipping_tracking_no != "") {
          $('#shipping_tracking_no').val(resp.data.shipping_tracking_no);
        }

        if (typeof resp.data.shipping_date !== 'undefined' && resp.data.shipping_date != "") {
          $('input[name="shipping_date"]').val(resp.data.shipping_date); // Re-initial Datetimepicker 

          $('.fc-datepicker').datetimepicker('destroy');
          $('.fc-datepicker').datetimepicker({
            widgetPositioning: {
              horizontal: 'auto',
              vertical: 'bottom'
            },
            format: 'DD/MM/YYYY hh:ss A'
          });
        }

        if (typeof resp.data.shipping_sender_remark !== 'undefined' && resp.data.shipping_sender_remark != "") {
          $('#shipping_sender_remark').val(resp.data.shipping_sender_remark);
        }

        if (typeof resp.data.shipping_image !== 'undefined' && resp.data.shipping_image != "") {
          $("#shipping_image").attr("data-default-file", resp.data.shipping_image);
          $("#image_old").val(resp.data.shipping_image);
          resetDropify(resp.data.shipping_image);
        }

        if (typeof resp.data.shipping_status !== 'undefined' && resp.data.shipping_status != "") {
          $('#shipping_status').val(resp.data.shipping_status);
        }

        $('#shipping_order_id').val(order_id);
        $('#shipping_popup').modal('show');
      }
    }
  });
};

setSaveShippingInfo = function setSaveShippingInfo() {
  event.preventDefault();
  var frm_data = new FormData($('#shipping_frm')[0]);
  $.ajax({
    url: "/admin/order/save_shipping_info",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      if ($("#shipping_frm").valid()) {
        return $("#shipping_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#shipping_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        $('#shipping_popup').modal('hide');
        JsReloadTable('order-datatable');
      } else {
        mwz_noti('error', resp.msg); //JsReloadTable('order-datatable');
      }
    }
  });
};

setShowPaymentInfo = function setShowPaymentInfo(order_id) {
  event.preventDefault();
  $('#payment_send_mail').val(0);
  $('#payment_popup').modal('show');
  $('#shipping_frm').trigger("reset");
  $.ajax({
    url: "/admin/order/get_payment_info",
    type: "POST",
    data: {
      order_id: order_id
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(resp) {
      if (resp.success) {
        if (typeof resp.data.order_code !== 'undefined' && resp.data.order_code != "") {
          $('.payment_order_code').html('(' + resp.data.order_code + ')');
        }

        if (typeof resp.data.payment_slip !== 'undefined' && resp.data.payment_slip != "") {
          $('#payment_slip').html('หลักฐานการชำระเงิน : ' + resp.data.payment_slip);
        }

        if (typeof resp.data.payment_date !== 'undefined' && resp.data.payment_date != "") {
          $('#payment_date').html('วันที่ชำระเงิน : ' + resp.data.payment_date);
        }

        if (typeof resp.data.payment_amount !== 'undefined' && resp.data.payment_amount != "") {
          $('#payment_amount').html('จำนวนที่ชำระ : ' + resp.data.payment_amount);
        }

        if (typeof resp.data.payment_status !== 'undefined' && resp.data.payment_status != "") {
          $('#payment_info_status').val(resp.data.payment_status);
        }

        $('#payment_order_id').val(order_id);
        $('#payment_order_id_show').html(order_id);
        $('#payment_popup').modal('show');
      }
    }
  });
};

setSavePaymentInfo = function setSavePaymentInfo() {
  event.preventDefault();
  var frm_data = new FormData($('#payment_frm')[0]);

  if (confirm('ต้องการส่งอีเมล์อัพเดทสถานะการชำระเงินให้ลูกค้าหรือไม่ ?')) {
    frm_data.append('payment_send_mail', 1);
  } else {
    frm_data.append('payment_send_mail', 0);
  }

  $.ajax({
    url: "/admin/order/save_payment_info",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      if ($("#payment_frm").valid()) {
        return $("#payment_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#payment_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        $('#payment_popup').modal('hide');
        JsReloadTable('order-datatable');
      } else {
        mwz_noti('error', resp.msg); //JsReloadTable('order-datatable');
      }
    }
  });
};

setShowCustomerInfo = function setShowCustomerInfo(order_id) {
  event.preventDefault();
  $('#customer_type').removeAttr('style');
  $('#customer_type').html('-');
  $('#customer_name').html('Yamazaki ID : -');
  $('#customer_name').html('ชื่อ : -');
  $('#customer_tel').html('เบอร์ติดต่อ : -');
  $('#customer_email').html('อีเมล์ : -');
  $('#customer_address_th').html('ที่อยู่ (TH) : -');
  $('#customer_address_en').html('ที่อยู่ (EN) : -');
  $.ajax({
    url: "/admin/order/get_customer_info",
    type: "POST",
    data: {
      order_id: order_id
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(resp) {
      if (resp.success) {
        if (typeof resp.data.order_code !== 'undefined' && resp.data.order_code != "") {
          $('.customer_order_code').html('(' + resp.data.order_code + ')');
        } // if(typeof resp.data.member_id !== 'undefined'){
        //     if(resp.data.member_id != 0){
        //         $('#customer_type').css('color','#24b959');
        //         $('#customer_type').html('เป็นสมาชิก');
        //     }else{
        //         $('#customer_type').css('color','#FF4550');
        //         $('#customer_type').html('ไม่ได้เป็นสมาชิก');
        //     }
        // }


        if (typeof resp.data.yamazaki_id !== 'undefined' && resp.data.yamazaki_id != "" && resp.data.member_name != null) {
          $('#customer_yamazaki_id').html('Yamazaki ID : ' + resp.data.yamazaki_id);
        }

        if (typeof resp.data.member_name !== 'undefined' && resp.data.member_name != "" && resp.data.member_name != null) {
          $('#customer_name').html('ชื่อ : ' + resp.data.member_name);
        }

        if (typeof resp.data.member_tel !== 'undefined' && resp.data.member_tel != "" && resp.data.member_tel != null) {
          $('#customer_tel').html('เบอร์ติดต่อ : ' + resp.data.member_tel);
        }

        if (typeof resp.data.member_email !== 'undefined' && resp.data.member_email != "" && resp.data.member_email != null) {
          $('#customer_email').html('อีเมล์ : ' + resp.data.member_email);
        }

        if (typeof resp.data.member_address_th !== 'undefined' && resp.data.member_address_th != "" && resp.data.member_email != null) {
          $('#customer_address_th').html('ที่อยู่ (TH) : ' + resp.data.member_address_th);
        }

        if (typeof resp.data.member_address_en !== 'undefined' && resp.data.member_address_en != "" && resp.data.member_email != null) {
          $('#customer_address_en').html('ที่อยู่ (EN) : ' + resp.data.member_address_en);
        }

        $('#customer_popup').modal('show');
      }
    }
  });
};

setShowOrderList = function setShowOrderList(order_id) {
  event.preventDefault();
  $.ajax({
    url: "/admin/order/get_order_list_info",
    type: "POST",
    data: {
      order_id: order_id
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(resp) {
      if (resp.success) {
        if (typeof resp.data.order_code !== 'undefined' && resp.data.order_code != "") {
          $('.customer_order_code').html('(' + resp.data.order_code + ')');
        }

        $('#order_list').html(resp.data.order_list_table);
        $('#order_sub_total').html(resp.data.order_sub_total + ' ' + resp.data.order_currency);
        $('#order_discount_total').html(resp.data.order_discount_total + ' ' + resp.data.order_currency);
        $('#order_grand_total').html(resp.data.order_grand_total + ' ' + resp.data.order_currency);
        $('#products_popup').modal('show');
      }
    }
  });
};

setPeriodFilter = function setPeriodFilter(period_filter) {
  if (period_filter == 8) {
    $('#custom_date_filter').show(0);
  } else {
    $('#custom_date_filter').hide(0);
    setFilter();
  }
};

setFilter = function setFilter() {
  oTable.draw();
};

initDropifyRemoveEvent = function initDropifyRemoveEvent() {
  $("#shipping_image").next(".dropify-clear").click(function (e) {
    // e.preventDefault();
    $('#is_delete_image').val("1");
  });
};

resetDropify = function resetDropify(image_url) {
  var drEvent = $('#shipping_image').dropify({
    defaultFile: image_url
  });
  drEvent = drEvent.data('dropify');
  drEvent.resetPreview();
  drEvent.clearElement();
  drEvent.settings.defaultFile = image_url;
  drEvent.destroy();
  drEvent.init();
  initDropifyRemoveEvent(); // drEvent.on('dropify.afterClear', function (event, element) {
  //     $('#is_delete_image').val(1);
  // });
};

initTableCheckAll = function initTableCheckAll(e) {
  $('.table-checkable thead th.checkbox-column :checkbox').on('change', function () {
    var checked = $(this).prop('checked');

    if (checked) {
      $('.checkbox-input').prop('checked', true);
    } else {
      $('.checkbox-input').prop('checked', false);
    }
  });
};

setSaveInvoiceInfo = function setSaveInvoiceInfo() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#invoice_frm')[0]);
  $.ajax({
    url: "/admin/order/save_invoice_info",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      if ($("#invoice_frm").valid()) {
        return $("#invoice_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#invoice_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);

        if (resp.code == 201) {
          JsReload(1500);
        } else {
          JsRedirect('/admin/order/', 1500);
        }
      } else {
        mwz_noti('error', resp.msg);
        document.getElementById(resp.focus).focus();
      }
    }
  });
};
/* ----------------------- Customs ----------------------------------------------------------*/
// input only number and . point


InputValidateString = function InputValidateString(evt) {
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
};

/***/ }),

/***/ "./Resources/assets/sass/app.scss":
/*!****************************************!*\
  !*** ./Resources/assets/sass/app.scss ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***************************************************************************!*\
  !*** multi ./Resources/assets/js/app.js ./Resources/assets/sass/app.scss ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Applications/XAMPP/xamppfiles/htdocs/yamazaki.soft.mwz/Modules/Order/Resources/assets/js/app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! /Applications/XAMPP/xamppfiles/htdocs/yamazaki.soft.mwz/Modules/Order/Resources/assets/sass/app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });