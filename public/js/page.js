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
}); // =========================  page =========================== //

initDatatable = function initDatatable() {
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
      }, {
        "data": "image",
        orderable: false,
        searchable: false
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

ReloadPageTable = function ReloadPageTable() {
  $('#page-datatable').DataTable().ajax.reload(null, false);
};

setUpdateStatus = function setUpdateStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/page/set_status",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        ReloadPageTable();
      } else {
        mwz_noti('error', resp.msg);
        ReloadPageTable();
      }
    }
  });
};

setDelete = function setDelete(id) {
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/page/set_delete",
          type: "POST",
          data: {
            id: id,
            status: status,
            _token: _token
          },
          success: function success(resp) {
            if (resp.success) {
              mwz_noti('success', resp.msg);
              ReloadPageTable();
            } else {
              mwz_noti('error', resp.msg);
              ReloadPageTable();
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
    beforeSend: function beforeSend(xhr) {
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
          required: true
        },
        detail_th: {
          required: true
        },
        description_en: {
          required: true
        },
        detail_en: {
          required: true
        },
        sequence: {
          required: true,
          number: true
        }
      };
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
          required: "กรุณาระบุคำอธิบายภาษาไทย"
        },
        description_en: {
          required: "กรุณาระบุคำอธิบายภาษาอังกฤษ"
        },
        detail_th: {
          required: "กรุณาระบุรายละเอียดภาษาไทย"
        },
        detail_en: {
          required: "กรุณาระบุรายละเอียดภาษาอังกฤษ"
        },
        sequence: {
          required: "กรุณาระบุลำดับการแสดงผล",
          number: "กรุณาระบุลำดับการแสดงผลเป็นตัวเลขเท่านั้น"
        }
      };
      mwz_frm_validate($("#page_frm"), rules, messages);

      if ($("#page_frm").valid()) {
        return $("#page_frm").valid();
      } else {
        // mwz_noti('error',resp.msg);
        mwz_global_loading(0);
        mwz_noti('error', 'ข้อมูลไม่ถูกต้อง');
        return $("#page_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/page/index';
      } else {
        mwz_noti('error', resp.msg);

        if (resp.focus) {
          document.getElementById(resp.focus).focus();
        }
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

__webpack_require__(/*! C:\xampp\htdocs\informative.v1.master.mwz\Modules\Page\Resources\assets\js\app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\informative.v1.master.mwz\Modules\Page\Resources\assets\sass\app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });