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
  // init for branch
  initDatatable();
  groupDatatable(); //ajax province

  getProvince();
}); // =========================  branch ======================================= //

initDatatable = function initDatatable() {
  if ($('#branch-datatable').length > 0) {
    oTable = $('#branch-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/branch/datatable_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: false
      }, {
        "data": "name_th"
      }, {
        "data": "group_id"
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

groupDatatable = function groupDatatable() {
  if ($('#category-datatable').length > 0) {
    oTable = $('#category-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/branch/category_datatable_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: false
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

setReloadDataTable = function setReloadDataTable() {
  $('#branch-datatable').DataTable().ajax.reload(null, false);
  $('#category-datatable').DataTable().ajax.reload(null, false);
};

setSave = function setSave() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#branch_frm')[0]);
  $.ajax({
    url: "/admin/branch/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      if ($("#branch_frm").valid()) {
        return $("#branch_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#branch_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/branch/index';
      } else {
        mwz_noti('error', resp.msg);
        document.getElementById(resp.focus), focus();
      }
    }
  });
};

setUpdateStatus = function setUpdateStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/branch/set_status",
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
    message: "Are you sure to delete branch?",
    buttons: {
      confirm: {
        label: 'OK',
        className: 'btn-success'
      },
      cancel: {
        label: 'Cancel',
        className: 'btn-danger'
      }
    },
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/branch/set_delete",
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
}; ////////////////////////////////////// get province /////////////////////////////////////////////////////////


getProvince = function getProvince() {
  var getprovince = $('#province');
  var getdistrict = $('#district');
  var getsubdistrict = $('#sub_district');

  var _token = $('meta[name="csrf-token"]').attr('content');

  getprovince.on('change', function () {
    if ($(this).val() != "") {
      var provinceId = $(this).val();
      $.ajax({
        url: "/admin/branch/province",
        type: "POST",
        data: {
          id: provinceId,
          _token: _token
        },
        success: function success(resp) {
          $('#district').html(resp);
        }
      });
    }
  });
  getdistrict.on('change', function () {
    if ($(this).val() != "") {
      var districtId = $(this).val();
      $.ajax({
        url: "/admin/branch/district",
        type: "POST",
        data: {
          id: districtId,
          _token: _token
        },
        success: function success(resp) {
          $('#sub_district').html(resp);
        }
      });
    }
  });
  getsubdistrict.on('change', function () {
    if ($(this).val() != "") {
      var subdistrictId = $(this).val();
      $.ajax({
        url: "/admin/branch/subdistrict",
        type: "POST",
        data: {
          id: subdistrictId,
          _token: _token
        },
        success: function success(resp) {
          $('#zipcode').html(resp);
        }
      });
    }
  });
}; ////////////////////////////////////////////////// branch category /////////////////////////////////////////////////////////////


setSaveCategory = function setSaveCategory(frm) {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#branch_category_frm')[0]);
  $.ajax({
    url: "/admin/branch/category/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      if ($("#branch_category_frm").valid()) {
        return $("#branch_category_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#branch_category_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/branch/category/';
      } else {
        mwz_noti('error', resp.msg);
        document.getElementById(resp.focus), focus();
      }
    }
  });
};

setUpdateCategoryStatus = function setUpdateCategoryStatus(category_id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/branch/set_category_status",
    type: "POST",
    data: {
      category_id: category_id,
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

setDeleteCategory = function setDeleteCategory(category_id) {
  bootbox.confirm({
    message: "Are you sure to delete branch category?",
    buttons: {
      confirm: {
        label: 'OK',
        className: 'btn-success'
      },
      cancel: {
        label: 'Cancel',
        className: 'btn-danger'
      }
    },
    callback: function callback(result) {
      if (result) {
        event.preventDefault();

        var _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
          url: "/admin/branch/set_category_delete",
          type: "POST",
          data: {
            category_id: category_id,
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

__webpack_require__(/*! C:\xampp\htdocs\mwz.yama\Modules\Branch\Resources\assets\js\app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\mwz.yama\Modules\Branch\Resources\assets\sass\app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });