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
  // init for user
  initDatatable(); // init for user group

  initGroupdatatable(); // init for user role

  initRoleDatatable(); //treeview

  $('.treeview').treed();
}); // =========================  master =========================== //

initDatatable = function initDatatable() {
  if ($('#user-datatable').length > 0) {
    oTable = $('#user-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/user/datatable_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: true,
        searchable: false
      }, {
        "data": "name"
      }, {
        "data": "username"
      }, {
        "data": "group",
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
  $('#user-datatable').DataTable().ajax.reload(null, false);
};

setUpdateStatus = function setUpdateStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/user/set_status",
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
    message: "ยืนยันลบ ผู้ดูแลระบบ ?",
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
          url: "/admin/user/set_delete",
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
  var frm_data = new FormData($('#user_frm')[0]);
  $.ajax({
    url: "/admin/user/save",
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
        name: {
          required: true
        },
        username: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        password: {
          minlength: 8,
          required: function required() {
            if ($('#user_id').val() == 0) {
              return true;
            } else {
              return false;
            }
          }
        },
        re_password: {
          minlength: 8,
          equalTo: "#password",
          required: function required() {
            if ($('#user_id').val() == 0) {
              return true;
            } else {
              return false;
            }
          }
        }
      };
      var messages = {
        name: "กรุณาใส่ชื่อ",
        username: "กรุณาใส่ชื่อผู้ดูแลระบบ",
        email: {
          required: "กรุณาใส่อีเมล",
          email: "อีเมลไม่ถูกต้อง"
        },
        password: {
          required: "กรุณาใส่รหัสผ่าน",
          minlength: "รหัสผ่านต้องมีอย่างน้อย {0} ตัวอักษร"
        },
        re_password: {
          required: "กรุณาใส่รหัสผ่าน",
          minlength: "รหัสผ่านต้องมีอย่างน้อย {0} ตัวอักษร"
        }
      };
      mwz_frm_validate($("#user_frm"), rules, messages);

      if ($("#user_frm").valid()) {
        return $("#user_frm").valid();
      } else {
        mwz_global_loading(0);
        mwz_noti('error', 'ข้อมูลไม่ถูกต้อง');
        return $("#user_frm").valid();
      }
    },
    success: function success(resp) {
      mwz_global_loading(0);

      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/user/';
      } else {
        if (resp.code == 302) {
          validator = $("#user_frm").validate();
          validator.showErrors({
            "username": resp.msg
          });
          $('#username').focus();
        }

        mwz_noti('error', resp.msg);
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
  if ($('#user-group-datatable').length > 0) {
    oTable = $('#user-group-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/user/group_datatable_ajax"
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

setReloadGroupDataTable = function setReloadGroupDataTable() {
  $('#user-group-datatable').DataTable().ajax.reload(null, false);
};

setUpdateGroupStatus = function setUpdateGroupStatus(category_id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/user/set_group_status",
    type: "POST",
    data: {
      category_id: category_id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadCategoryDataTable();
      } else {
        mwz_noti('error', resp.msg);
        setReloadCategoryDataTable();
      }
    }
  });
};

setDeleteGroup = function setDeleteGroup(id) {
  bootbox.confirm({
    message: "ยืนยันลบ กลุ่มผู้ดูแลระบบ ?",
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
          url: "/admin/user/set_group_delete",
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
      }
    }
  });
};

setSaveGroup = function setSaveGroup(frm) {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#user_group_frm')[0]);
  $.ajax({
    url: "/admin/user/group/save",
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
        parent_id: "required",
        status: "required"
      };
      var messages = {
        name: "ต้องใส่ชื่อกลุ่ม",
        description: "ต้องใส่คำอธิบายกลุ่ม",
        parent_id: "ต้องเลือกกลุ่มหลัก",
        status: "ต้องเลือกสถานะ"
      };
      mwz_frm_validate($("#user_group_frm"), rules, messages);

      if ($("#user_group_frm").valid()) {
        return $("#user_group_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#user_group_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/user/group/';
      } else {
        mwz_noti('error', resp.msg);
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
}; // =========================  user role =========================== //


initRoleDatatable = function initRoleDatatable() {
  if ($('#user-role-datatable').length > 0) {
    oTable = $('#user-role-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/user/role_datatable_ajax"
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
  $('#user-role-datatable').DataTable().ajax.reload(null, false);
};

setUpdateRoleStatus = function setUpdateRoleStatus(role_id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/user/set_role_status",
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
    message: "ยืนยันลบ สิทธิ์ ?",
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
          url: "/admin/user/set_role_delete",
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
  var frm_data = new FormData($('#user_role_frm')[0]);
  $.ajax({
    url: "/admin/user/role/save",
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
        name: "ต้องใส่ชื่อ",
        description: "ต้องใส่คำอธิบาย",
        status: "ต้องใส่สถานะ"
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
        window.location.href = '/admin/user/role/';
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

__webpack_require__(/*! C:\xampp\htdocs\informative.v1.master.mwz\Modules\User\Resources\assets\js\app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\informative.v1.master.mwz\Modules\User\Resources\assets\sass\app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });