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
  // init for galleries
  initDatatable();
  initDatatableGalleriesCategory(); //tab inti

  if ($('.first_tab').length > 0) {
    $(".first_tab").champ();
  }
}); // =========================  galleries =========================== //

initDatatable = function initDatatable() {
  if ($('#galleries-datatable').length > 0) {
    oTable = $('#galleries-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/galleries/datatable_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: true,
        searchable: false
      }, {
        "className": "text-center",
        "data": "image"
      }, {
        "data": "name_th"
      }, {
        "data": "name_en"
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

initDatatableGalleriesCategory = function initDatatableGalleriesCategory() {
  if ($('#galleries-category-datatable').length > 0) {
    oTable = $('#galleries-category-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/galleries/datatable_ajax_galleries_category"
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: false
      }, {
        "className": "text-center",
        "data": "image_category"
      }, {
        "data": "name_th"
      }, {
        "data": "name_en"
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

setReloadDataTableGalleriesCategory = function setReloadDataTableGalleriesCategory() {
  $('#galleries-category-datatable').DataTable().ajax.reload(null, false);
};

setReloadDataTable = function setReloadDataTable() {
  $('#galleries-datatable').DataTable().ajax.reload(null, false);
};

setUpdateStatus = function setUpdateStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/galleries/set_status",
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/galleries/set_delete",
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
  var frm_data = new FormData($('#galleries_frm')[0]);
  $.ajax({
    url: "/admin/galleries/save",
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
        publish_at: {
          required: true
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
        }
      };
      var messages = {
        publish_at: {
          required: "กรุณาระบุวันที่เผยแพร่"
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
      };
      mwz_frm_validate($("#galleries_frm"), rules, messages);

      if ($("#galleries_frm").valid()) {
        return $("#galleries_frm").valid();
      } else {
        // mwz_noti('error',resp.msg);
        mwz_global_loading(0);
        mwz_noti('error', 'ข้อมูลไม่ถูกต้อง');
        return $("#galleries_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/galleries/index';
      } else {
        mwz_noti('error', resp.msg);
        document.getElementById(resp.focus).focus();
      }
    }
  });
};

setSaveGalleriesCategory = function setSaveGalleriesCategory() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#galleries_category_frm')[0]); // console.log(frm_data)

  $.ajax({
    url: "/admin/galleries/save_galleries_category",
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
      };
      mwz_frm_validate($("#galleries_category_frm"), rules, messages);

      if ($("#galleries_category_frm").valid()) {
        return $("#galleries_category_frm").valid();
      } else {
        // mwz_noti('error',resp.msg);
        mwz_global_loading(0);
        mwz_noti('error', 'ข้อมูลไม่ถูกต้อง');
        return $("#galleries_category_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/galleries/index_galleries_category';
      } else {
        mwz_noti('error', resp.msg);
        document.getElementById(resp.focus).focus();
      }
    }
  });
};

setUpdateStatusGalleriesCategory = function setUpdateStatusGalleriesCategory(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/galleries/set_status_galleries_category",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadDataTableGalleriesCategory();
      } else {
        mwz_noti('error', resp.msg);
        setReloadDataTableGalleriesCategory();
      }
    }
  });
};

setDeleteGalleriesCategory = function setDeleteGalleriesCategory(id) {
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
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/galleries/set_delete_galleries_category",
          type: "POST",
          data: {
            id: id,
            status: status,
            _token: _token
          },
          success: function success(resp) {
            if (resp.success) {
              mwz_noti('success', resp.msg);
              setReloadDataTableGalleriesCategory();
            } else {
              mwz_noti('error', resp.msg);
              setReloadDataTableGalleriesCategory();
            }
          }
        });
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

setUpdateUpMenu = function setUpdateUpMenu(id) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/galleries/menu_up",
    type: "POST",
    data: {
      id: id,
      _token: _token
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success() {
      setReloadDataTableGalleriesCategory();
    }
  });
};

setUpdateDownMenu = function setUpdateDownMenu(id) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/galleries/menu_down",
    type: "POST",
    data: {
      id: id,
      _token: _token
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success() {
      setReloadDataTableGalleriesCategory();
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

__webpack_require__(/*! C:\xampp\htdocs\informative.v1.master.mwz\Modules\Galleries\Resources\assets\js\app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\informative.v1.master.mwz\Modules\Galleries\Resources\assets\sass\app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });