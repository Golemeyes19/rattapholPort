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
  // init for product
  initDatatable(); // init for product category

  initCategoryDatatable(); //init vendor 

  initVendorDatatable(); //init brands 

  initBrandsDatatable(); //init brands 

  initLabelDatatable(); //tab inti

  if ($('.lang_tab').length > 0) {
    $(".lang_tab").champ();
  } // if ($('.product_tab').length > 0) {
  //     $(".product_tab").champ();
  // }


  if ($('.brands_tab').length > 0) {
    $(".brands_tab").champ();
  } // if ($('.vendor_tab').length > 0) {
  //     $(".vendor_tab").champ();
  // }


  if ($('.dropify').length > 0) {
    var drEvent = $('.dropify').dropify();
    drEvent.on('dropify.afterClear', function (event, element) {
      var form = $(element.element.form);
      var input = '<input type="hidden" name="delete_' + element.element.name + '" value="1"/>';
      form.append(input);
    });
  }

  $("body").on("click", "#add-new-image", addNewImage);
  $("body").on("click", ".btn-remove-image", removeImage);
  $("#new_tag_th").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
      addNewTag(this.value, 'th');
    }
  });
  $("#new_tag_en").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
      addNewTag(this.value, 'en');
    }
  });
  $('.frm-color .circle-btn-addmore span.badge').click(function () {
    $('#color_name').val('');
    $('.frm-size .circle-btn-addmore').not(this).removeClass('added');
    $('.frm-color .circle-btn-addmore').toggleClass("added");
  });
  $('.frm-size .circle-btn-addmore span.badge').click(function () {
    $('#size_name').val('');
    $('.frm-color .circle-btn-addmore').not(this).removeClass('added');
    $('.frm-size .circle-btn-addmore').toggleClass("added");
  }); // INIT DELETE DROPIFY EVENT

  initDropifyRemoveEvent();
});

addNewImage = function addNewImage() {
  var count = $('#add-new-image').data('count') + 1;
  var html = '<div class="col-md-4 pt-4 box-image" style="text-align: right;">';
  html += '<input type="file" name="uploadfiles[' + count + ']" class="dropify" data-default-file="" />';
  html += '<label class="form-label pt-2" style="display:none;">Image Name (TH)</label>';
  html += '<input type="text" class="form-control" name="uploadfilesName_th[' + count + ']" placeholder="Image Name" value="" style="display:none;">';
  html += '<label class="form-label pt-2" style="display:none;">Image Name (EN)</label>';
  html += '<input type="text" class="form-control" name="uploadfilesName_en[' + count + ']" placeholder="Image Name" value="" style="display:none;">';
  html += '<button type="botton" class="btn btn-danger btn-float btn-remove-image" style="margin-top: 15px;"><i class="fa fa-trash"></i></button>';
  html += '</div>';
  $('.group-image').append(html);
  var drEvent2 = $('.dropify').dropify();
  drEvent2.on('dropify.afterClear', function (event, element) {
    var form = $(element.element.form);
    var input = '<input type="hidden" name="delete_' + element.element.name + '" value="1"/>';
    form.append(input);
  });
  $('#add-new-image').data('count', count);
};

removeImage = function removeImage(input) {
  var form = $('form');
  var input = '<input type="hidden" name="delete_' + $(this).data('input') + '" value="1"/>';
  form.append(input);
  $(this).closest('.box-image').remove();
}; // =========================  product =========================== //


initDatatable = function initDatatable() {
  if ($('#product-datatable').length > 0) {
    oTable = $('#product-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/product/datatable_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: false,
        searchable: false
      }, {
        "data": "images"
      }, {
        "data": "name_th"
      }, {
        "data": "category_id"
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
  $('#product-datatable').DataTable().ajax.reload(null, false);
};

setUpdateStatus = function setUpdateStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/product/set_status",
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
  bootbox.confirm("Are you sure to delete product?", function (result) {
    if (result) {
      event.preventDefault();

      var _token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/admin/product/set_delete",
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
  });
};

setSave = function setSave() {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#product_frm')[0]);
  $.ajax({
    url: "/admin/product/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {// var rules = {
      //         name_th: "required",
      //         name_en: "required",
      //         description_th: "required",
      //         description_en: "required",
      //         detail_th: "required",
      //         detail_en: "required",
      //         status: "required"
      //     }
      // var messages = {
      //         name_th: "Please enter product name",
      //         name_en: "Please enter product name",
      //         description_th: "Please enter product description",
      //         description_en: "Please enter product description",
      //         detail_th: "Please enter product detail",
      //         detail_en: "Please enter product detail",
      //         status: "Please select status"
      //     }
      // mwz_frm_validate($("#product_frm"),rules,messages)
      // if( $("#product_frm").valid()) {
      //     return $("#product_frm").valid();
      // }else{
      //     // mwz_noti('error',resp.msg);
      //     return $("#product_frm").valid();
      // }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/product/';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
};

addColor = function addColor() {
  var name = $('#color_name').val();
  var code = $('#color_code').val();
  var count = $('.color-input-group').data('color-count') + 1;
  var icon = '<div class="circle-badge color-choosen choosen" style="background-color:' + code + ';"><span class="badge">' + name + '  <i onclick="deleteColor(' + count + ',\'' + name + '\',this);" class="fa fa-times-circle delete-color" ></i></span></div>';
  var input = '<input type="hidden" class="color_input" name="color[' + count + ']" id="input_color_' + count + '" data-color-id="' + count + '" value="' + name + ',' + code + ',' + count + '" />';
  $('.color-icon-group').append(icon);
  $('.color-input-group').append(input);
  $('.frm-color .circle-btn-addmore').removeClass('added');
  $('.color-input-group').data('color-count', count);
  setPrice();
};

addSize = function addSize() {
  var name = $('#size_name').val();
  var count = $('.size-input-group').data('size-count') + 1;
  var icon = '<div class="circle-badge size-choosen choosen"><span class="badge">' + name + '  <i onclick="deleteSize(' + count + ',\'' + name + '\',this);" class="fa fa-times-circle delete-color" ></i></span></div>';
  var input = '<input type="hidden" class="size_input" name="size[' + count + ']" id="input_size_' + count + '" data-size-id="' + count + '" value="' + name + ',' + count + '" />';
  $('.size-icon-group').append(icon);
  $('.size-input-group').append(input);
  $('.frm-size .circle-btn-addmore').removeClass('added');
  $('.size-input-group').data('size-count', count);
  setPrice();
};

setPrice = function setPrice() {
  var temp_price = $('#body_manage_price');
  var colors = $('.color_input');
  var sizes = $('.size_input');
  var table = '';
  var color_name = '-';
  var color_code = '-';
  var color_id = 'c0';
  var size_name = '-';
  var size_id = 's0';
  var currency = $('#priceCur').val();

  if (colors.length > 0) {
    $.each(colors, function (color) {
      var data = $(this).val().split(",");
      color_name = data[0];
      color_code = data[1];
      color_id = 'c' + data[2];

      if (sizes.length > 0) {
        $.each(sizes, function (size) {
          var data = $(this).val().split(",");
          size_name = data[0];
          size_id = 's' + data[1];
          table += createManagePrice(color_id, color_name, size_id, size_name, currency, temp_price);
        });
      } else {
        table += createManagePrice(color_id, color_name, size_id, size_name, currency, temp_price);
      }
    });
  } else {
    if (sizes.length > 0) {
      $.each(sizes, function (size) {
        var data = $(this).val().split(",");
        size_name = data[0];
        size_id = 's' + data[1];
        table += createManagePrice(color_id, color_name, size_id, size_name, currency, temp_price);
      });
    }
  }

  $('#body_manage_price').html(table);
};

createManagePrice = function createManagePrice(color_id, color_name, size_id, size_name, currency, temp_price) {
  var np = '',
      dc = '',
      mnp = '',
      mdc = '';

  if (temp_price.find('#normal_price_' + color_id + '_' + size_id).length > 0) {
    np = $('#normal_price_' + color_id + '_' + size_id).val();
  }

  if (temp_price.find('#discount_price_' + color_id + '_' + size_id).length > 0) {
    dc = $('#discount_price_' + color_id + '_' + size_id).val();
  } // if (temp_price.find('#member_normal_price_' + color_id + '_' + size_id).length > 0) {
  //     mnp = $('#member_normal_price_' + color_id + '_' + size_id).val();
  // }
  // if (temp_price.find('#member_discount_price_' + color_id + '_' + size_id).length > 0) {
  //     mdc = $('#member_discount_price_' + color_id + '_' + size_id).val();
  // }


  table = '<tr class="row_manage_price" id="row_manage_price_' + color_id + '_' + size_id + '">';
  table += '<td style="display:none;">' + color_name + '</td>';
  table += '<td>' + size_name + '</td>';
  table += '<td>';
  table += '<div class="form-group frm-nPrice">';
  table += '<input type="text" class="form-control" placeholder="ราคาปกติ" name="normal_price_' + color_id + '_' + size_id + '" id="normal_price_' + color_id + '_' + size_id + '" value="' + np + '">';
  table += '</div>';
  table += '</td>';
  table += '<td>';
  table += '<div class="form-group frm-nPrice">';
  table += '<input type="text" class="form-control" placeholder="ราคาพิเศษ" name="discount_price_' + color_id + '_' + size_id + '" id="discount_price_' + color_id + '_' + size_id + '" value="' + dc + '">';
  table += '</div>';
  table += '</td>'; // table += '<td>';
  // table += '<div class="form-group frm-nPrice">';
  // table += '<input type="text" class="form-control" placeholder="ราคาสมาชิก" name="member_normal_price_' + color_id + '_' + size_id + '" id="member_normal_price_' + color_id + '_' + size_id + '" value="' + mnp + '">';
  // table += '</div>';
  // table += '</td>';
  // table += '<td>';
  // table += '<div class="form-group frm-nPrice">';
  // table += '<input type="text" class="form-control" placeholder="ส่วนลดสมาชิก" name="member_discount_price_' + color_id + '_' + size_id + '" id="member_discount_price_' + color_id + '_' + size_id + '" value="' + mdc + '">';
  // table += '</div>';
  // table += '</td>';

  table += '<td class="manage_price_currency">' + currency + '</td>';
  table += '</tr>';
  return table;
};

setCurrency = function setCurrency(val) {
  $('.manage_price_currency').html(val);
};

pickVendor = function pickVendor(value) {
  if (value == '0') {
    return false;
  }

  var new_vendor = value.split(",");
  var all_vendor;

  if ($('#vendors').val() == '') {
    all_vendor = new_vendor[0];
    var show_vendor = '<span class="tag" style="background: #a0f9af"> ' + new_vendor[1] + ' <i onclick="deleteVendor(\'' + new_vendor[1] + '\',' + new_vendor[0] + ',this);" class="fa fa-times-circle delete-vendor" ></i></span>';
    $('.vendor-group').append(show_vendor);
    $('#vendors').val(all_vendor); // $('#vendor').val('0').trigger('change');
  } else {
    all_vendor = $('#vendors').val().split(","); // explode

    var check = true;
    $.each(all_vendor, function (key, val) {
      if (val == new_vendor[0]) {
        check = false;
      }
    });

    if (check == true) {
      all_vendor.push(new_vendor[0]);
      all_vendor.join(); // implode

      var _show_vendor = '<span class="tag" style="background: #a0f9af"> ' + new_vendor[1] + ' <i onclick="deleteVendor(\'' + new_vendor[1] + '\',' + new_vendor[0] + ',this);" class="fa fa-times-circle delete-vendor" ></i></span>';

      $('.vendor-group').append(_show_vendor);
      $('#vendors').val(all_vendor); // $('#vendor').val('0').trigger('change');
    } else {//console.log('this vendor has already');
    }
  }

  $('#vendor').val('0').trigger('change');
};

deleteVendor = function deleteVendor(value, id, element) {
  bootbox.confirm({
    size: "small",
    message: "Delete Vendor " + value + " ?",
    callback: function callback(result) {
      if (result) {
        var all_vendor = $('#vendors').val().split(",");
        var new_vendor = [];
        $.each(all_vendor, function (key, val) {
          if (val != id) {
            new_vendor.push(val);
          }
        });
        new_vendor.join();
        $('#vendors').val(new_vendor);
        element.closest("span").remove(); // $('#vendor').val('0').trigger('change');
      }
    }
  });
};

pickLabel = function pickLabel(value) {
  if (value == '0') {
    return false;
  }

  var new_label = value.split(",");
  var all_label;

  if ($('#labels').val() == '') {
    all_label = new_label[0];
    var show_label = '<span class="tag" style="background: #a0edf9"> ' + new_label[1] + ' <i onclick="deleteLabel(\'' + new_label[1] + '\',' + new_label[0] + ',this);" class="fa fa-times-circle delete-vendor" ></i></span>';
    $('.label-group').append(show_label);
    $('#labels').val(all_label);
  } else {
    all_label = $('#labels').val().split(","); // explode

    var check = true;
    $.each(all_label, function (key, val) {
      if (val == new_label[0]) {
        check = false;
      }
    });

    if (check == true) {
      all_label.push(new_label[0]);
      all_label.join(); // implode

      var _show_label = '<span class="tag" style="background: #a0edf9"> ' + new_label[1] + ' <i onclick="deleteLabel(\'' + new_label[1] + '\',' + new_label[0] + ',this);" class="fa fa-times-circle delete-vendor" ></i></span>';

      $('.label-group').append(_show_label);
      $('#labels').val(all_label);
    } else {}
  }

  $('#label').val('0').trigger('change');
};

deleteLabel = function deleteLabel(value, id, element) {
  bootbox.confirm({
    size: "small",
    message: "Delete label " + value + " ?",
    callback: function callback(result) {
      if (result) {
        var all_label = $('#labels').val().split(",");
        var new_label = [];
        $.each(all_label, function (key, val) {
          if (val != id) {
            new_label.push(val);
          }
        });
        new_label.join();
        $('#labels').val(new_label);
        element.closest("span").remove();
      }
    }
  });
};

addNewTag = function addNewTag(tag, lang) {
  if (tag == '') {
    return false;
  }

  var all_tag;

  if ($('#tags_' + lang).val() == '') {
    all_tag = tag;
    var show_tag = '<span class="tag" > ' + tag + ' <i onclick="deleteTag(\'' + lang + '\',\'' + tag + '\',this);" class="fa fa-times-circle delete-tag" ></i></span>';
    $('.show-name-tags-' + lang).append(show_tag);
    $('#tags_' + lang).val(all_tag);
    $('#new_tag_' + lang).val('');
  } else {
    all_tag = $('#tags_' + lang).val().split(","); // explode

    var check = true;
    $.each(all_tag, function (key, val) {
      if (val == tag) {
        check = false;
      }
    });

    if (check == true) {
      all_tag.push(tag);
      all_tag.join(); // implode

      var _show_tag = '<span class="tag" > ' + tag + ' <i onclick="deleteTag(\'' + lang + '\',\'' + tag + '\',this);" class="fa fa-times-circle delete-tag" ></i></span>';

      $('.show-name-tags-' + lang).append(_show_tag);
      $('#tags_' + lang).val(all_tag);
      $('#new_tag_' + lang).val('');
    } else {
      console.log('this tag has already');
    }
  }
};

deleteTag = function deleteTag(lang, tag, element) {
  bootbox.confirm({
    size: "small",
    message: "Delete Tag " + tag + " ?",
    callback: function callback(result) {
      if (result) {
        var all_tag = $('#tags_' + lang).val().split(",");
        var new_tag = [];
        $.each(all_tag, function (key, val) {
          if (val != tag) {
            new_tag.push(tag);
          }
        });
        new_tag.join();
        $('#tags_' + lang).val(new_tag);
        element.closest("span").remove();
      }
    }
  });
};

deleteColor = function deleteColor(id, name, element) {
  bootbox.confirm({
    size: "small",
    message: "Delete Color " + name + " ?",
    callback: function callback(result) {
      if (result) {
        $("#input_color_" + id).remove();
        element.closest("div").remove();
        setPrice();
      }
    }
  });
};

deleteSize = function deleteSize(id, name, element) {
  bootbox.confirm({
    size: "small",
    message: "Delete Size " + name + " ?",
    callback: function callback(result) {
      if (result) {
        $("#input_size_" + id).remove();
        element.closest("div").remove();
        setPrice();
      }
    }
  });
}; // =========================  category =========================== //


initCategoryDatatable = function initCategoryDatatable() {
  if ($('#product-categroy-datatable').length > 0) {
    oTable = $('#product-categroy-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/product/category/datatable_ajax"
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

setReloadCategoryDataTable = function setReloadCategoryDataTable() {
  $('#product-categroy-datatable').DataTable().ajax.reload(null, false);
};

setUpdateCategoryStatus = function setUpdateCategoryStatus(category_id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/product/category/set_category_status",
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

setDeleteCategory = function setDeleteCategory(category_id) {
  bootbox.confirm("Are you sure to delete category?", function (result) {
    if (result) {
      event.preventDefault();

      var _token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/admin/product/category/set_category_delete",
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
    }
  });
};

setSaveCategory = function setSaveCategory(frm) {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#product_category_frm')[0]);
  $.ajax({
    url: "/admin/product/category/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      var rules = {
        name_th: "required",
        name_en: "required",
        description_th: "required",
        description_en: "required",
        status: "required"
      };
      var messages = {
        name_th: "Please enter category name",
        name_en: "Please enter category name",
        description_th: "Please enter category description",
        description_en: "Please enter category description",
        status: "Please select status"
      };
      mwz_frm_validate($("#product_category_frm"), rules, messages);

      if ($("#product_category_frm").valid()) {
        return $("#product_category_frm").valid();
      } else {
        mwz_noti('error', resp.msg);
        return $("#product_category_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/product/category/';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
}; // =========================  vendor =========================== //


initVendorDatatable = function initVendorDatatable() {
  if ($('#vendor-datatable').length > 0) {
    oTable = $('#vendor-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/product/vendor/datatable_ajax"
      },
      "columns": [{
        "data": "id",
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

setReloadVendorDataTable = function setReloadVendorDataTable() {
  $('#vendor-datatable').DataTable().ajax.reload(null, false);
};

setUpdateVendorStatus = function setUpdateVendorStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/product/vendor/set_status",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        setReloadVendorDataTable();
      } else {
        mwz_noti('error', resp.msg);
        setReloadVendorDataTable();
      }
    }
  });
};

setDeleteVendor = function setDeleteVendor(id) {
  bootbox.confirm("Are you sure to delete vendor ID #" + id + " ?", function (result) {
    if (result) {
      event.preventDefault();

      var _token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/admin/product/vendor/set_delete",
        type: "POST",
        data: {
          id: id,
          status: status,
          _token: _token
        },
        success: function success(resp) {
          if (resp.success) {
            mwz_noti('success', resp.msg);
            setReloadVendorDataTable();
          } else {
            mwz_noti('error', resp.msg);
            setReloadVendorDataTable();
          }
        }
      });
    }
  });
};

setSaveVendor = function setSaveVendor(frm) {
  event.preventDefault();
  tinyMCE.triggerSave();
  var frm_data = new FormData($('#vendor_frm')[0]);
  $.ajax({
    url: "/admin/product/vendor/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      var rules = {
        name_th: "required",
        name_en: "required",
        status: "required"
      };
      var messages = {
        name_th: "Please enter vendor name",
        name_en: "Please enter vendor name",
        status: "Please select status"
      };
      mwz_frm_validate($("#vendor_frm"), rules, messages);

      if ($("#vendor_frm").valid()) {
        return $("#vendor_frm").valid();
      } else {
        mwz_noti('error', 'please enter required field');
        return $("#vendor_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/product/vendor/';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
}; // =========================  Brands =========================== //


initBrandsDatatable = function initBrandsDatatable() {
  if ($('#brands-datatable').length > 0) {
    oTable = $('#brands-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/product/brands/datatable_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: false,
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

setSaveBrands = function setSaveBrands(frm) {
  event.preventDefault();
  var frm_data = new FormData($('#brands_frm')[0]);
  $.ajax({
    url: "/admin/product/brands/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      var rules = {
        name_th: "required",
        name_en: "required",
        status: "required"
      };
      var messages = {
        name_th: "Please enter brands name th",
        name_en: "Please enter brands name en",
        status: "Please select status"
      };
      mwz_frm_validate($("#brands_frm"), rules, messages);

      if ($("#brands_frm").valid()) {
        return $("#brands_frm").valid();
      } else {
        mwz_noti('error', 'Please enter required field');
        return $("#brands_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/product/brands/';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
};

setUpdateBrandsStatus = function setUpdateBrandsStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/product/brands/set_status",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        JsReloadTable('brands-datatable');
      } else {
        mwz_noti('error', resp.msg);
        JsReloadTable('brands-datatable');
      }
    }
  });
};

setDeleteBrands = function setDeleteBrands(id) {
  bootbox.confirm("Are you sure to delete brand ID #" + id + " ?", function (result) {
    if (result) {
      event.preventDefault();

      var _token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/admin/product/brands/set_delete",
        type: "POST",
        data: {
          id: id,
          status: status,
          _token: _token
        },
        success: function success(resp) {
          if (resp.success) {
            mwz_noti('success', resp.msg);
            JsReloadTable('brands-datatable');
          } else {
            mwz_noti('error', resp.msg);
            JsReloadTable('brands-datatable');
          }
        }
      });
    }
  });
}; // =========================  Brands =========================== //


initLabelDatatable = function initLabelDatatable() {
  if ($('#label-datatable').length > 0) {
    oTable = $('#label-datatable').DataTable({
      "processing": true,
      "serverSide": true,
      "stateSave": true,
      "ajax": {
        "url": "/admin/product/label/datatable_ajax"
      },
      "columns": [{
        "data": "id",
        orderable: false,
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

setSaveLabel = function setSaveLabel(frm) {
  event.preventDefault();
  var frm_data = new FormData($('#label_frm')[0]);
  $.ajax({
    url: "/admin/product/label/save",
    type: "POST",
    contentType: false,
    data: frm_data,
    processData: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function beforeSend(xhr) {
      var rules = {
        name_th: "required",
        name_en: "required",
        status: "required"
      };
      var messages = {
        name_th: "Please enter label name th",
        name_en: "Please enter label name en",
        status: "Please select status"
      };
      mwz_frm_validate($("#label_frm"), rules, messages);

      if ($("#label_frm").valid()) {
        return $("#label_frm").valid();
      } else {
        mwz_noti('error', 'Please enter required field');
        return $("#label_frm").valid();
      }
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        window.location.href = '/admin/product/label/';
      } else {
        mwz_noti('error', resp.msg);
      }
    }
  });
};

setUpdateLabelStatus = function setUpdateLabelStatus(id, status) {
  event.preventDefault();

  var _token = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: "/admin/product/label/set_status",
    type: "POST",
    data: {
      id: id,
      status: status,
      _token: _token
    },
    success: function success(resp) {
      if (resp.success) {
        mwz_noti('success', resp.msg);
        JsReloadTable('label-datatable');
      } else {
        mwz_noti('error', resp.msg);
        JsReloadTable('label-datatable');
      }
    }
  });
};

setDeleteLabel = function setDeleteLabel(id) {
  bootbox.confirm("Are you sure to delete label ID #" + id + " ?", function (result) {
    if (result) {
      event.preventDefault();

      var _token = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "/admin/product/label/set_delete",
        type: "POST",
        data: {
          id: id,
          status: status,
          _token: _token
        },
        success: function success(resp) {
          if (resp.success) {
            mwz_noti('success', resp.msg);
            JsReloadTable('label-datatable');
          } else {
            mwz_noti('error', resp.msg);
            JsReloadTable('label-datatable');
          }
        }
      });
    }
  });
}; //=========== GENERAL FUNCTION ==============//


JsReloadTable = function JsReloadTable(table) {
  $('#' + table).DataTable().ajax.reload(null, false);
};

initDropifyRemoveEvent = function initDropifyRemoveEvent() {
  if ($('#image').length > 0) {
    $("#image").next(".dropify-clear").click(function (e) {
      // e.preventDefault();
      $('#is_delete_image').val("1");
    });
  }

  if ($('#image_th').length > 0) {
    $("#image_th").next(".dropify-clear").click(function (e) {
      // e.preventDefault();
      $('#is_delete_image_th').val("1");
    });
  }

  if ($('#image_en').length > 0) {
    $("#image_en").next(".dropify-clear").click(function (e) {
      // e.preventDefault();
      $('#is_delete_image_en').val("1");
    });
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

__webpack_require__(/*! /Applications/XAMPP/xamppfiles/htdocs/yamazaki.soft.mwz/Modules/Product/Resources/assets/js/app.js */"./Resources/assets/js/app.js");
module.exports = __webpack_require__(/*! /Applications/XAMPP/xamppfiles/htdocs/yamazaki.soft.mwz/Modules/Product/Resources/assets/sass/app.scss */"./Resources/assets/sass/app.scss");


/***/ })

/******/ });