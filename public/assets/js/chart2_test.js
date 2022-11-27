/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/js/chart2_test.js":
/*!********************************************!*\
  !*** ./resources/assets/js/chart2_test.js ***!
  \********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/* module decorator */ module = __webpack_require__.nmd(module);
(function ($) {
  /*
    ======== A Handy Little QUnit Reference ========
    http://api.qunitjs.com/
      Test methods:
      module(name, {[setup][ ,teardown]})
      test(name, callback)
      expect(numberOfAssertions)
      stop(increment)
      start(decrement)
    Test assertions:
      ok(value, [message])
      equal(actual, expected, [message])
      notEqual(actual, expected, [message])
      deepEqual(actual, expected, [message])
      notDeepEqual(actual, expected, [message])
      strictEqual(actual, expected, [message])
      notStrictEqual(actual, expected, [message])
      throws(block, [expected], [message])
  */
  module('jQuery#chart2', {
    // This will run before each test in this module.
    setup: function setup() {
      this.elems = $('#qunit-fixture').children();
    }
  });
  test('is chainable', function () {
    expect(1); // Not a bad test to run on collection methods.

    strictEqual(this.elems.chart2(), this.elems, 'should be chainable');
  });
  test('is awesome', function () {
    expect(1);
    strictEqual(this.elems.chart2().text(), 'awesome0awesome1awesome2', 'should be awesome');
  });
  module('jQuery.chart2');
  test('is awesome', function () {
    expect(2);
    strictEqual($.chart2(), 'awesome.', 'should be awesome');
    strictEqual($.chart2({
      punctuation: '!'
    }), 'awesome!', 'should be thoroughly awesome');
  });
  module(':chart2 selector', {
    // This will run before each test in this module.
    setup: function setup() {
      this.elems = $('#qunit-fixture').children();
    }
  });
  test('is awesome', function () {
    expect(1); // Use deepEqual & .get() when comparing jQuery objects.

    deepEqual(this.elems.filter(':chart2').get(), this.elems.last().get(), 'knows awesome when it sees it');
  });
})(jQuery);

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			id: moduleId,
/******/ 			loaded: false,
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/node module decorator */
/******/ 	(() => {
/******/ 		__webpack_require__.nmd = (module) => {
/******/ 			module.paths = [];
/******/ 			if (!module.children) module.children = [];
/******/ 			return module;
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/js/chart2_test.js");
/******/ 	
/******/ })()
;