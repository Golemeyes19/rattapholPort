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
  // init for table all
  initDatatable();
  initDatatableSubject(); //tab inti
  // if ($('.first_tab').length > 0) {
  //     $(".first_tab").champ();
  // }
});

initDatatable = function initDatatable() {
  if ($('#contactus-datatable').length > 0) {
    oTable = $('#contactus-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/contactus/datatable_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: true
      }, {
        "data": "name"
      }, {
        "data": "subject"
      }, {
        "data": "created_at"
      }, {
        "data": "action",
        orderable: false,
        searchable: false
      }]
    });
  }
};

setReloadDataTable = function setReloadDataTable() {
  $('#contactus-datatable').DataTable().ajax.reload(null, false);
};

setUpdateStatus = function setUpdateStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/contactus/set_status",
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/contactus/set_delete",
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
    beforeSend: function beforeSend(xhr) {
      var rules = {
        message: "required",
        replay: "required",
        status: "required"
      };
      var messages = {
        message: "Please enter member message",
        replay: "Please enter member replay",
        agree: "Please select status"
      };
      mwz_frm_validate($("#contactus_frm"), rules, messages);

      if ($("#contactus_frm").valid()) {
        return $("#contactus_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#contactus_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/contactus/';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
};

setSaveContactPage = function setSaveContactPage() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#contactpage_frm')[0]);
  console.log(frm_data);
  $.ajax({
    url: "/admin/contactus/save_contact_page",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      var rules = {
        head_office_th: {
          maxlength: 500
        },
        head_office_en: {
          maxlength: 500
        },
        factory_th: {
          maxlength: 500
        },
        factory_en: {
          maxlength: 500
        },
        fb: {
          maxlength: 255
        },
        line: {
          maxlength: 255
        },
        youtube: {
          maxlength: 255
        },
        instagram_url: {
          maxlength: 255
        },
        phone_head_office: {
          maxlength: 10
        },
        phone_factory: {
          maxlength: 10
        },
        email_head_office: {
          maxlength: 250
        },
        email_factory: {
          maxlength: 250
        },
        gmaps: {
          maxlength: 500
        }
      };
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
      };
      mwz_frm_validate($("#contactpage_frm"), rules, messages);

      if ($("#contactpage_frm").valid()) {
        return $("#contactpage_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#contactpage_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/contactus/edit';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
};

setSaveContactSubject = function setSaveContactSubject() {
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
    beforeSend: function beforeSend(xhr) {
      var rules = {
        subject: "required",
        subject_en: "required",
        to_email: "required",
        cc_email: "required"
      };
      var messages = {
        subject: "Please enter subject message",
        subject_en: "Please enter subject message",
        to_email: "Please enter TO Email",
        cc_email: "Please enter CC Email"
      };
      mwz_frm_validate($("#contactsubject_frm"), rules, messages);

      if ($("#contactsubject_frm").valid()) {
        return $("#contactsubject_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#contactsubject_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/contactus/subject_index';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
};

initDatatableSubject = function initDatatableSubject() {
  if ($('#contactus-subject-datatable').length > 0) {
    oTable = $('#contactus-subject-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/contactus/datatable_ajax_subject"
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: false
      }, {
        "data": "subject"
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

set_delete_subject = function set_delete_subject(id) {
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/contactus/set_delete_subject",
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

set_status_subject = function set_status_subject(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/contactus/set_status_subject",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadDataTableSubject();
      } else {
        mwz_noti('error', resp.msg);
        setReloadDataTableSubject();
      }
    }
  });
};

setReloadDataTableSubject = function setReloadDataTableSubject() {
  $('#contactus-subject-datatable').DataTable().ajax.reload(null, false);
};

SendContactSubject = function SendContactSubject() {
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
    beforeSend: function beforeSend(xhr) {
      var rules = {
        subject: "required",
        email: "required",
        name: "required",
        phone: "required",
        message: "required"
      };
      var messages = {
        subject: "Please enter select subject",
        email: "Please enter email",
        name: "Please enter name",
        phone: "Please enter phone",
        message: "Please enter message"
      };
      mwz_frm_validate($("#send_contactsubject_frm"), rules, messages);

      if ($("#send_contactsubject_frm").valid()) {
        return $("#send_contactsubject_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#send_contactsubject_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/dev/contactus/form';
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

__webpack_require__(/*! C:\xampp\htdocs\informative.v1.master.mwz\Modules\ContactUs\Resources\assets\js\app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\informative.v1.master.mwz\Modules\ContactUs\Resources\assets\sass\app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });