/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/assets/js/advancedform-rtl.js ***!
  \*************************************************/
(function ($) {
  "use strict"; //accordion-wizard

  var options = {
    mode: 'wizard',
    autoButtonsNextClass: 'btn btn-primary float-left',
    autoButtonsPrevClass: 'btn btn-info',
    stepNumberClass: 'badge badge-pill badge-primary ml-1',
    onSubmit: function onSubmit() {
      alert('Form submitted!');
      return true;
    }
  };
  $("#form").accWizard(options);
})(jQuery);
/******/ })()
;