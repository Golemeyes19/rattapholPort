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
  // init for bank
  initBankDatatable(); // init for online payment

  initOnlineDatatable(); //tab inti

  if ($('.first_tab').length > 0) {
    $(".first_tab").champ();
  }

  if ($('#paypal').length > 0) {
    checkOnlineType($('select[name="type"]').val());
  }
}); // =========================  config =========================== //

setSavePayment = function setSavePayment() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#payment_frm')[0]);
  $.ajax({
    url: "/admin/payment/config/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      var rules = {
        description_th: "required" // status: "required"

      };
      var messages = {
        description_th: "Please enter payment description" // status: "Please select status"

      };
      mwz_frm_validate($("#payment_frm"), rules, messages);

      if ($("#payment_frm").valid()) {
        return $("#payment_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#payment_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg); // window.location.href = '/admin/master/';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
}; // =========================  bank =========================== //


initBankDatatable = function initBankDatatable() {
  if ($('#bank-datatable').length > 0) {
    oTable = $('#bank-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/payment/datatable_bank_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: false
      }, {
        "data": "account"
      }, {
        "data": "bank"
      }, {
        "data": "account_number"
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

setReloadBankDataTable = function setReloadBankDataTable() {
  $('#bank-datatable').DataTable().ajax.reload(null, false);
};

setUpdateBankStatus = function setUpdateBankStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/payment/bank/set_status",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadBankDataTable();
      } else {
        mwz_noti('error', resp.msg);
        setReloadBankDataTable();
      }
    }
  });
};

setDeleteBank = function setDeleteBank(id) {
  bootbox.confirm("Are you sure to delete bank ?", function (result) {
    if (result) {
      event.preventDefault();

      var _token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/admin/payment/bank/set_delete",
        type: "POST",
        data: {
          id: id,
          status: status,
          _token: _token
        },
        success: function success(resp) {
          if (resp.success) {
            mwz_noti('success', resp.msg);
            setReloadBankDataTable();
          } else {
            mwz_noti('error', resp.msg);
            setReloadBankDataTable();
          }
        }
      });
    }
  });
};

setSaveBank = function setSaveBank() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#bank_frm')[0]);
  $.ajax({
    url: "/admin/payment/bank/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      var rules = {
        branch: "required",
        account: "required",
        account_number: "required",
        status: "required"
      };
      var messages = {
        branch: "Please enter branch name",
        account: "Please enter account name",
        account_number: "Please enter account number",
        status: "Please select status"
      };
      mwz_frm_validate($("#bank_frm"), rules, messages);

      if ($("#bank_frm").valid()) {
        return $("#bank_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#bank_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/payment/bank';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
}; // =========================  online =========================== //


initOnlineDatatable = function initOnlineDatatable() {
  if ($('#online-datatable').length > 0) {
    oTable = $('#online-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/payment/datatable_online_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: false
      }, {
        "data": "account"
      }, {
        "data": "type"
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

setReloadOnlineDataTable = function setReloadOnlineDataTable() {
  $('#online-datatable').DataTable().ajax.reload(null, false);
};

setUpdateOnlineStatus = function setUpdateOnlineStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/payment/online/set_status",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadOnlineDataTable();
      } else {
        mwz_noti('error', resp.msg);
        setReloadOnlineDataTable();
      }
    }
  });
};

setDeleteOnline = function setDeleteOnline(id) {
  bootbox.confirm("Are you sure to delete online payment ?", function (result) {
    if (result) {
      event.preventDefault();

      var _token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/admin/payment/online/set_delete",
        type: "POST",
        data: {
          id: id,
          status: status,
          _token: _token
        },
        success: function success(resp) {
          if (resp.success) {
            mwz_noti('success', resp.msg);
            setReloadOnlineDataTable();
          } else {
            mwz_noti('error', resp.msg);
            setReloadOnlineDataTable();
          }
        }
      });
    }
  });
};

setSaveOnline = function setSaveOnline() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#online_frm')[0]);
  $.ajax({
    url: "/admin/payment/online/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      var rules = {
        account: "required",
        status: "required"
      };
      var messages = {
        account: "Please enter account name",
        status: "Please select status"
      };
      mwz_frm_validate($("#online_frm"), rules, messages);

      if ($("#online_frm").valid()) {
        return $("#online_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#online_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/payment/online';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
};

checkOnlineType = function checkOnlineType(value) {
  switch (parseInt(value)) {
    case 2:
      $('#paypal').show();
      $('#promtpay').hide();
      break;

    case 5:
      $('#paypal').hide();
      $('#promtpay').hide();
      break;

    case 13:
      $('#paypal').hide();
      $('#promtpay').show();
      break;
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

__webpack_require__(/*! /Applications/XAMPP/xamppfiles/htdocs/yamasaki.mwz/Modules/Payment/Resources/assets/js/app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! /Applications/XAMPP/xamppfiles/htdocs/yamasaki.mwz/Modules/Payment/Resources/assets/sass/app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });