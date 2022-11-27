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
  initDatamenu();
});

setReloadDataTable = function setReloadDataTable() {
  $('#menu-datatable').DataTable().ajax.reload(null, false);
}; // =========================  menu =========================== //


initDatamenu = function initDatamenu() {
  if ($('#menu-datatable').length > 0) {
    oTable = $('#menu-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/menu/datatable_ajax"
      },
      "columns": [// { "data": 'DT_RowIndex', orderable: false, searchable: false },
      {
        "data": '_lft',
        orderable: true,
        searchable: false
      }, {
        "data": "name_th"
      }, {
        "data": "name_en"
      }, {
        "data": "updated_at"
      }, {
        "data": "sort",
        orderable: false,
        searchable: false
      }, {
        "data": "actionEdit",
        orderable: false,
        searchable: false
      }]
    });
  }
};

setUpdateStatusMenu = function setUpdateStatusMenu(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/menu/set_status",
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

setDeleteMenu = function setDeleteMenu(id) {
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/menu/set_delete",
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

setSaveMenu = function setSaveMenu() {
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
      };
      mwz_frm_validate($("#menu_frm"), rules, messages);

      if ($("#menu_frm").valid()) {
        return $("#menu_frm").valid();
      } else {
        // mwz_noti('error',resp.msg);
        mwz_global_loading(0);
        mwz_noti('error', 'ข้อมูลไม่ถูกต้อง');
        return $("#menu_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/menu/';
      } else {
        mwz_noti('error', resp.msg); // document.getElementById(resp.focus).focus();
      }
    }
  });
};

setUpdateUpMenu = function setUpdateUpMenu(id) {
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
    success: function success() {
      setReloadDataTable();
    }
  });
};

setUpdateDownMenu = function setUpdateDownMenu(id) {
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
    success: function success() {
      setReloadDataTable();
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

__webpack_require__(/*! C:\xampp\htdocs\informative.v1.master.mwz\Modules\Menu\Resources\assets\js\app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\informative.v1.master.mwz\Modules\Menu\Resources\assets\sass\app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });