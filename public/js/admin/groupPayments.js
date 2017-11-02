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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 100);
/******/ })
/************************************************************************/
/******/ ({

/***/ 100:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(101);


/***/ }),

/***/ 101:
/***/ (function(module, exports) {

function bindAdminHelpers() {
  $(document).mouseup(function (e) {
    var container = $(".admin-helper-modal");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      $(".show-account-user").removeClass('active');
      $('.admin-helper-modal').addClass('hidden');
    }
  });
  $(".show-account-user").mouseover(function () {
    if (!$(this).hasClass('active')) {
      $(".show-account-user").removeClass('active');
      $('.admin-helper-modal').addClass('hidden');
    }
    var modal = $(this).children('.admin-helper-modal');
    var helper = $(this).find('.fix-helper');
    modal.removeClass('hidden');
    helper.css('top', modal.offset().top - $(window).scrollTop() - 25);
    helper.css('left', modal.offset().left + 25);
  });
  $(".show-account-user").mouseleave(function () {
    if (!$(this).hasClass('active')) $(this).children('.admin-helper-modal').addClass('hidden');
  });
  $(".show-account-user").click(function () {
    $(".show-account-user").removeClass('active');
    $('.admin-helper-modal').addClass('hidden');
    $(this).addClass('active');
    $(this).children('.admin-helper-modal').removeClass('hidden');
  });
}

var groupPaymentsApp = new Vue({
  el: '#group-payments-app',
  data: {
    admin: authAdmin,
    paymentsIn: '',
    paymentsOut: [],
    paymentsTotal: 0,
    feesTotal: 0,
    groupBegin: groupDate,
    dateBegin: '',
    dateEnd: '',
    minRange: 8
    // Stored data
  },
  methods: {
    // app-wise functions
    formatCurrency: function formatCurrency(val) {
      return parseFloat(Math.round(val * 100) / 100).toFixed(2);
    },
    updateRange: function updateRange() {
      var payApp = this;
      setTimeout(function () {
        payApp.dateBegin = $('#payment-begin').val();
        payApp.dateEnd = $('#payment-end').val();
        payApp.filterPayments();
      }, 100);
    },
    toDate: function toDate(dateStr) {
      var parts = dateStr.split("/");
      return new Date(parts[2], parts[0] - 1, parts[1]);
    },
    filterPayments: function filterPayments() {
      this.paymentsOut = [];
      this.paymentsTotal = 0;
      this.feesTotal = 0;
      for (var i = 0; i < this.paymentsIn.length; i++) {
        var pI = this.paymentsIn[i];
        var dI = this.toDate(pI.date);
        var dB = this.toDate(this.dateBegin);
        var dE = this.toDate(this.dateEnd);
        if (dI >= dB && dI <= dE) {
          this.paymentsOut.push(pI);
          this.paymentsTotal += parseFloat(pI.amount);
          this.feesTotal += parseFloat(pI.fee);
        }
      }
      this.paymentsTotal = this.formatCurrency(this.paymentsTotal);
      this.feesTotal = this.formatCurrency(this.feesTotal);
      mL = 8 - this.paymentsOut.length;
      this.minRange = mL > 0 ? mL : 0;
      var interval = setInterval(function () {
        if ($('.admin-helper-modal').length) {
          bindAdminHelpers();
        }
      }, 100);
    }
  },
  mounted: function mounted() {
    var pL = JSON.stringify(paymentsLoaded);
    this.paymentsIn = JSON.parse(pL);

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd;
    }
    if (mm < 10) {
      mm = '0' + mm;
    }
    var today = mm + '/' + dd + '/' + yy;

    this.dateBegin = this.groupBegin;
    this.dateEnd = today;
    this.filterPayments();
    $('#payment-begin').val(this.groupBegin);
    $('#payment-end').val(today);
    $('#payment-begin').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome'
    });
    $('#payment-end').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome'
    });
    var payApp = this;
    $('#payment-end, #payment-begin').change(function () {
      payApp.updateRange();
    });
  },

  components: {
    // all imported / created compenents
  },
  computed: {}
});

/***/ })

/******/ });