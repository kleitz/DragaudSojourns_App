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

var groupTravelersApp = new Vue({
  el: '#group-travelers-app',
  data: {
    trips: '',
    group: groupLoaded,
    depart: groupDepart,
    admin: adminLoaded,
    method: 'Payment',
    today: '',
    paymentValid: false,
    paymentType: 'discount',
    payment: {
      traveler: '', user: '',
      method: '', paypal_id: 'Administrator Payment',
      user_id: '', trip_id: '',
      amount: '0.00', fee: 0,
      balance: '', balanceIn: ''
    }
  },
  methods: {
    resetData: function resetData() {
      var tL = JSON.stringify(tripsLoaded);
      this.trips = JSON.parse(tL);
      this.payment = {
        traveler: '', user: '',
        method: '', paypal_id: '',
        user_id: '', trip_id: '',
        amount: '0.00', fee: 0,
        balance: '', balanceIn: '',
        created_at: ''
      };
    },
    adminPayment: function adminPayment(index) {
      fadeIn('#poverlay');
      fadeIn('#payment-modal');
      this.updatePayment();
      this.payment.balanceIn = this.trips[index].total - this.trips[index].paid;
      this.payment.balance = this.formatCurrency(this.payment.balanceIn);
      this.payment.amount = '0.00';
      this.payment.paypal_id = 'admin-' + Date.now();
      this.payment.traveler = this.trips[index].traveler;
      this.payment.traveler_id = this.trips[index].traveler.id;
      this.payment.user = this.trips[index].user;
      this.payment.user_id = this.trips[index].user.id;
      this.payment.trip_id = this.trips[index].id;
      this.createToday();
      this.formatCreated(this.today);
    },
    updatePayment: function updatePayment() {
      this.payment.balance = this.payment.balanceIn - this.payment.amount;
      if (this.payment.amount > this.payment.balanceIn) {
        this.payment.balance = 0;
        this.payment.amount = this.payment.balanceIn;
      }
      this.checkPayment();
    },
    selectDiscount: function selectDiscount() {
      this.method = 'Discount';
    },
    selectPayment: function selectPayment() {
      this.method = 'Payment';
    },
    updateDate: function updateDate() {
      this.formatCreated($('#payment-date').val());
      this.checkPayment();
    },
    checkPayment: function checkPayment() {
      if (this.payment.amount > 0 && this.payment.method != '') {
        this.paymentValid = true;
      } else {
        this.paymentValid = false;
      }
    },
    processPayment: function processPayment() {
      var dataUrl = '/payments/store';
      var payApp = this;
      if (this.method == 'Discount') {
        dataUrl = '/payments/discount';
      }
      $.ajax({
        type: "POST",
        url: dataUrl,
        data: { payment: payApp.payment },
        success: function success(data) {
          var response = JSON.parse(data);
          if (response.status == "SUCCESS") {
            window.location.reload();
          }
        }
      });
    },
    formatCurrency: function formatCurrency(val) {
      return parseFloat(Math.round(val * 100) / 100).toFixed(2);
    },
    closePayment: function closePayment() {
      fadeOut('#poverlay');
      fadeOut('#payment-modal');
      this.resetData();
    },
    createToday: function createToday() {
      today = new Date();
      dd = today.getDate();
      if (dd < 10) {
        dd = '0' + dd;
      };
      mm = today.getMonth() + 1;
      if (mm < 10) {
        mm = '0' + mm;
      };
      yy = today.getFullYear();
      this.today = mm + '/' + dd + '/' + yy;
    },
    formatCreated: function formatCreated(date) {
      var dateExp = date.split('/');
      console.log(dateExp[0]);
      this.payment.created_at = dateExp[2] + '-' + dateExp[0] + '-' + dateExp[1] + ' 00:00:00';
    }
    // app-wise functions

  },
  mounted: function mounted() {
    this.resetData();
    $('#payment-date').datepicker({
      uiLibrary: 'bootstrap4',
      iconsLibrary: 'fontawesome'
    });
    var payApp = this;
    $('#payment-date').change(function () {
      payApp.updateDate();
    });
    $('#payment-date').attr('readonly', 'readonly');
    $('#payment-date').css('background', 'white');
    // do this when ready
  },

  components: {
    // all imported / created compenents
  },
  computed: {
    remainingBalance: function remainingBalance() {
      return this.formatCurrency(this.payment.balance);
    }
  }
});

/***/ })

/******/ });