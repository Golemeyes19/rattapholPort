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

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

$(document).ready(function () {
  // init for member
  initDatatable(); // init for member group

  initGroupdatatable(); // init for member address

  initAddressDatatable(); // init for member invoice detail

  initInvoiceDetailDatatable(); // init for wishlist datatable

  initWishlistDatatable(); //treeview

  if ($('.treeview').length > 0) {
    $('.treeview').treed();
  } //tab init


  if ($('.member_group_tab').length > 0) {
    $(".member_group_tab").champ();
  }
}); // =========================  member =========================== //

initDatatable = function initDatatable() {
  if ($('#member-datatable').length > 0) {
    oTable = $('#member-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/member/datatable_ajax"
      },
      "columns": [{
        "data": 'DT_RowIndex'
      }, {
        "data": "name"
      }, {
        "data": "email",
        orderable: false,
        searchable: false
      }, {
        "data": "mobile",
        orderable: false,
        searchable: false
      }, {
        "data": "updated_at"
      }, {
        "data": "action",
        orderable: false,
        searchable: false
      }]
    });
  }
};

setReloadDataTable = function setReloadDataTable() {
  // console.log('reload member datatable');
  $('#member-datatable').DataTable().ajax.reload(null, false);
};

setUpdateStatus = function setUpdateStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/member/set_status",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadDataTable();
      } else {
        mwz_noti('error', resp.msg);
        setReloadDataTable();
      }
    }
  });
};

setDelete = function setDelete(id) {
  bootbox.confirm({
    message: "ยืนยันลบ สมาชิก ?",
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/member/set_delete",
          type: "POST",
          data: {
            id: id,
            status: status,
            _token: _token
          },
          success: function success(resp) {
            if (resp.success) {
              mwz_noti('success', resp.msg);
              setReloadDataTable();
            } else {
              mwz_noti('error', resp.msg);
              setReloadDataTable();
            }
          }
        });
      }
    }
  });
};

setSave = function setSave() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#member_frm')[0]);
  $.ajax({
    url: "/admin/member/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      mwz_global_loading(1); // alert('before send member_id:'+$('#member_id').val());

      if ($('#member_id').val() == '' || $('#member_id').val() == 0) {
        var rules = {
          name: "required",
          mobile: "required",
          email: "required",
          password: "required",
          re_password: {
            required: true,
            equalTo: "#password"
          },
          group_id: "required",
          status: "required",
          address: "required",
          zipcode: "required",
          province_id: "required",
          city_id: "required",
          district_id: "required"
        };
        var messages = {
          name: "ต้องใส่ชื่อ",
          mobile: "ต้องใส่เบอร์โทร",
          email: "ต้องใส่อีเมล",
          password: "ต้องใส่รหัสผ่าน",
          re_password: "ต้องใส่ซ้ำรหัสผ่านและต้องเหมือนกับรหัสผ่าน",
          group_id: "ต้องเลือกกลุ่ม",
          status: "ต้องเลือกสถานะ",
          address: "ต้องใส่ที่อยู่",
          zipcode: "ต้องใส่รหัสไปรษณีย์",
          province_id: "ต้องเลือกจังหวัด",
          city_id: "ต้องเลือกอำเภอ",
          district_id: "ต้องเลือกตำบล"
        };
      } else {
        var rules = {
          name: "required",
          mobile: "required",
          email: "required",
          re_password: {
            equalTo: "#password"
          },
          group_id: "required",
          status: "required",
          address: "required",
          zipcode: "required",
          province_id: "required",
          city_id: "required",
          district_id: "required"
        };
        var messages = {
          name: "ต้องใส่ชื่อ",
          mobile: "ต้องใส่เบอร์โทร",
          email: "ต้องใส่อีเมล",
          re_password: "ซ้ำรหัสผ่านและต้องเหมือนกับรหัสผ่าน",
          group_id: "ต้องเลือกกลุ่ม",
          status: "ต้องเลือกสถานะ",
          address: "ต้องใส่ที่อยู่",
          zipcode: "ต้องใส่รหัสไปรษณีย์",
          province_id: "ต้องเลือกจังหวัด",
          city_id: "ต้องเลือกอำเภอ",
          district_id: "ต้องเลือกตำบล"
        };
      }

      mwz_frm_validate($("#member_frm"), rules, messages);

      if ($("#member_frm").valid()) {
        return $("#member_frm").valid();
      } else {
        mwz_global_loading(0);
        mwz_noti('error', 'ต้องกรอกข้อมูลให้ครบ และถูกต้อง');
        return $("#member_frm").valid();
      }
    },
    success: function success(resp) {
      mwz_global_loading(0);

      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/member/';
      } else {
        validator = $("#member_frm").validate();
        validator.showErrors(resp.error);
        $(resp.focus).focus();
        mwz_noti('error', resp.msg);
        document.getElementById(resp.focus).focus();
      }
    }
  });
};

setChangeGroup = function setChangeGroup(group_id) {
  $('#show_roles').find(':checkbox').prop("checked", false);

  if (typeof groups_default_role[group_id] != 'undefined') {
    var default_role = groups_default_role[group_id];
    $.each(default_role, function (module, roles) {
      $.each(roles, function (page, role) {
        $.each(role, function (index, action) {
          var chk_box = "#" + module + "_" + page + "_" + action;
          $(chk_box).prop("checked", true);
        });
      });
    });
  }
}; // =========================  user group =========================== //
// 


initGroupdatatable = function initGroupdatatable() {
  if ($('#member-group-datatable').length > 0) {
    oTable = $('#member-group-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/member/group_datatable_ajax"
      },
      "columns": [{
        "data": 'DT_RowIndex'
      }, {
        "data": "name_th"
      }, {
        "data": "updated_at"
      }, {
        "data": "action",
        orderable: false,
        searchable: false
      }]
    });
  }
};

setReloadGroupDataTable = function setReloadGroupDataTable() {
  $('#member-group-datatable').DataTable().ajax.reload(null, false);
};

setUpdateGroupStatus = function setUpdateGroupStatus(group_id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/member/set_group_status",
    type: "POST",
    data: {
      group_id: group_id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadGroupDataTable();
      } else {
        mwz_noti('error', resp.msg);
        setReloadGroupDataTable();
      }
    }
  });
};

setDeleteGroup = function setDeleteGroup(group_id) {
  bootbox.confirm({
    message: "ยืนยันลบ กลุ่มสมาชิก ?",
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/member/set_group_delete",
          type: "POST",
          data: {
            group_id: group_id,
            _token: _token
          },
          success: function success(resp) {
            if (resp.success) {
              mwz_noti('success', resp.msg);
              setReloadGroupDataTable();
            } else {
              mwz_noti('error', resp.msg);
              setReloadGroupDataTable();
            }
          }
        });
      }
    }
  });
};

setSaveGroup = function setSaveGroup(frm) {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#member_group_frm')[0]);
  $.ajax({
    url: "/admin/member/group/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      if ($("#member_group_frm").valid()) {
        return $("#member_group_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#member_group_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/member/group/';
      } else {
        mwz_noti('error', resp.msg);
        document.getElementById(resp.focus).focus();
      }
    }
  });
};

setCheckAllPermission = function setCheckAllPermission(ele, group) {
  var check = $(ele).is(':checked');
  $(ele).closest('li').find('input.' + group).each(function () {
    if (check) {
      $(this).prop("checked", true);
    } else {
      $(this).prop("checked", false);
    }
  });
}; // =========================  member address =========================== //


initAddressDatatable = function initAddressDatatable() {
  if ($('#member-address-datatable').length > 0) {
    var member_id = $('#member-address-datatable').attr("data-member_id");
    oTable = $('#member-address-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/member/address/datatable_ajax/" + member_id
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: false
      }, {
        "data": "address"
      }, {
        "data": "district_id",
        orderable: false,
        searchable: false
      }, {
        "data": "city_id",
        orderable: false,
        searchable: false
      }, {
        "data": "province_id",
        orderable: false,
        searchable: false
      }, {
        "data": "zipcode",
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

setReloadAddressDataTable = function setReloadAddressDataTable() {
  $('#member-address-datatable').DataTable().ajax.reload(null, false);
};

setUpdateAddressStatus = function setUpdateAddressStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/member/address/set_status",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadAddressDataTable();
      } else {
        mwz_noti('error', resp.msg);
        setReloadAddressDataTable();
      }
    }
  });
};

setUpdateAddressDefault = function setUpdateAddressDefault(id) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/member/address/set_default",
    type: "POST",
    data: {
      id: id,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadAddressDataTable();
      } else {
        mwz_noti('error', resp.msg);
        setReloadAddressDataTable();
      }
    }
  });
};

setDeleteAddress = function setDeleteAddress(id) {
  bootbox.confirm({
    message: "ยืนยันลบ ที่อยู่ ?",
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/member/address/set_delete",
          type: "POST",
          data: {
            id: id,
            status: status,
            _token: _token
          },
          success: function success(resp) {
            if (resp.success) {
              mwz_noti('success', resp.msg);
              setReloadAddressDataTable();
            } else {
              mwz_noti('error', resp.msg);
              setReloadAddressDataTable();
            }
          }
        });
      }
    }
  });
};

setSaveAddress = function setSaveAddress() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#member_address_frm')[0]);
  $.ajax({
    url: "/admin/member/address/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      mwz_global_loading(1);
      var rules = {
        address: {
          required: true
        },
        zipcode: {
          required: true
        },
        province_id: {
          required: true
        },
        city_id: {
          required: true
        },
        district_id: {
          required: true
        }
      };
      var messages = {
        address: "ต้องใส่ที่อยู่",
        zipcode: "ต้องใส่รหัสไปรษณีย์",
        province_id: "ต้องเลือกจังหวัด",
        city_id: "ต้องเลือกอำเภอ",
        district_id: "ต้องเลือกตำบล"
      };
      mwz_frm_validate($("#member_address_frm"), rules, messages);

      if ($("#member_address_frm").valid()) {
        return $("#member_address_frm").valid();
      } else {
        mwz_global_loading(0);
        mwz_noti('error', 'form data invalid');
        return $("#member_address_frm").valid();
      }
    },
    success: function success(resp) {
      mwz_global_loading(0);

      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = resp.redirect; //;'/admin/member/' ;
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
}; // =========================  member invoice detail =========================== //


initInvoiceDetailDatatable = function initInvoiceDetailDatatable() {
  if ($('#member-invoicedetail-datatable').length > 0) {
    var member_id = $('#member-invoicedetail-datatable').attr("data-member_id");
    oTable = $('#member-invoicedetail-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/member/invoice_detail/datatable_ajax/" + member_id
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: false
      }, {
        "data": "contact_name"
      }, {
        "data": "company_name"
      }, {
        "data": "address"
      }, {
        "data": "district_id",
        orderable: false,
        searchable: false
      }, {
        "data": "city_id",
        orderable: false,
        searchable: false
      }, {
        "data": "province_id",
        orderable: false,
        searchable: false
      }, {
        "data": "zipcode",
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

setReloadInvoiceDetailDataTable = function setReloadInvoiceDetailDataTable() {
  $('#member-invoicedetail-datatable').DataTable().ajax.reload(null, false);
};

setUpdateInvoiceDetailStatus = function setUpdateInvoiceDetailStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/member/invoice_detail/set_status",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadInvoiceDetailDataTable();
      } else {
        mwz_noti('error', resp.msg);
        setReloadInvoiceDetailDataTable();
      }
    }
  });
};

setDeleteInvoiceDetail = function setDeleteInvoiceDetail(id) {
  bootbox.confirm({
    message: "ยืนยันลบ ใบกำกับภาษี ?",
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/member/invoice_detail/set_delete",
          type: "POST",
          data: {
            id: id,
            status: status,
            _token: _token
          },
          success: function success(resp) {
            if (resp.success) {
              mwz_noti('success', resp.msg);
              setReloadInvoiceDetailDataTable();
            } else {
              mwz_noti('error', resp.msg);
              setReloadInvoiceDetailDataTable();
            }
          }
        });
      }
    }
  });
};

setSaveInvoiceDetail = function setSaveInvoiceDetail() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#member_invoicedetail_frm')[0]);
  $.ajax({
    url: "/admin/member/invoice_detail/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      var _rules;

      mwz_global_loading(1);
      var rules = (_rules = {
        contact_name: {
          required: true
        },
        tel: {
          required: true
        },
        email: {
          required: true
        },
        address: {
          required: true
        }
      }, _defineProperty(_rules, "address", {
        required: true
      }), _defineProperty(_rules, "zipcode", {
        required: true
      }), _defineProperty(_rules, "province_id", {
        required: true
      }), _defineProperty(_rules, "city_id", {
        required: true
      }), _defineProperty(_rules, "district_id", {
        required: true
      }), _rules);
      var messages = {
        contact_name: "ต้องใส่ชื่อ",
        tel: "ต้องใส่เบอร์โทร",
        email: "ต้องใส่อีเมล์",
        address: "ต้องใส่ที่อยู่",
        zipcode: "ต้องใส่รหัสไปรษณีย์",
        province_id: "ต้องเลือกจังหวัด",
        city_id: "ต้องเลือกอำเภอ",
        district_id: "ต้องเลือกตำบล"
      };
      mwz_frm_validate($("#member_invoicedetail_frm"), rules, messages);

      if ($("#member_invoicedetail_frm").valid()) {
        return $("#member_invoicedetail_frm").valid();
      } else {
        mwz_global_loading(0);
        mwz_noti('error', 'form data invalid');
        return $("#member_invoicedetail_frm").valid();
      }
    },
    success: function success(resp) {
      mwz_global_loading(0);

      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = resp.redirect; //;'/admin/member/' ;
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
}; // =========================  member wishlist =========================== //


initWishlistDatatable = function initWishlistDatatable() {
  if ($('#member-wishlist-datatable').length > 0) {
    var member_id = $('#member-wishlist-datatable').attr("data-member_id");
    oTable = $('#member-wishlist-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/member/wishlist/datatable_ajax/" + member_id
      },
      "columns": [{
        "data": 'DT_RowIndex'
      }, {
        "data": "product_id"
      }, {
        "data": "updated_at"
      }, {
        "data": "action",
        orderable: false,
        searchable: false
      }]
    });
  }
};

setReloadWishlistDataTable = function setReloadWishlistDataTable() {
  $('#member-wishlist-datatable').DataTable().ajax.reload(null, false);
}; // =========================  member role =========================== //


initRoleDatatable = function initRoleDatatable() {
  if ($('#member-role-datatable').length > 0) {
    oTable = $('#member-role-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/member/role_datatable_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: false
      }, {
        "data": "name"
      }, {
        "data": "updated_at"
      }, {
        "data": "action",
        orderable: false,
        searchable: false
      }]
    });
  }
};

setReloadRoleDataTable = function setReloadRoleDataTable() {
  $('#member-role-datatable').DataTable().ajax.reload(null, false);
};

setUpdateRoleStatus = function setUpdateRoleStatus(role_id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/member/set_role_status",
    type: "POST",
    data: {
      role_id: role_id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadRoleDataTable();
      } else {
        mwz_noti('error', resp.msg);
        setReloadRoleDataTable();
      }
    }
  });
};

setDeleteRole = function setDeleteRole(id) {
  bootbox.confirm({
    message: "ยืนยันลบ ิสทธิ์ ?",
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/member/set_role_delete",
          type: "POST",
          data: {
            category_id: category_id,
            status: status,
            _token: _token
          },
          success: function success(resp) {
            if (resp.success) {
              mwz_noti('success', resp.msg);
              setReloadRoleDataTable();
            } else {
              mwz_noti('error', resp.msg);
              setReloadRoleDataTable();
            }
          }
        });
      }
    }
  });
};

setSaveRole = function setSaveRole(frm) {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#member_role_frm')[0]);
  $.ajax({
    url: "/admin/member/role/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      var rules = {
        name: "required",
        description: "required",
        status: "required"
      };
      var messages = {
        name: "ต้องใส่ชื่อ role",
        description: "ต้องใส่คำอธิบาย",
        status: "ต้องเลือกสถานะ"
      };
      mwz_frm_validate($("#user_role_frm"), rules, messages);

      if ($("#user_role_frm").valid()) {
        return $("#user_role_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#user_role_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/member/role/';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
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

__webpack_require__(/*! /Applications/XAMPP/xamppfiles/htdocs/infomation.v1.master.mwz/Modules/Member/Resources/assets/js/app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! /Applications/XAMPP/xamppfiles/htdocs/infomation.v1.master.mwz/Modules/Member/Resources/assets/sass/app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });