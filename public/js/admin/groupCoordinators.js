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
/******/ 	return __webpack_require__(__webpack_require__.s = 104);
/******/ })
/************************************************************************/
/******/ ({

/***/ 104:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(105);


/***/ }),

/***/ 105:
/***/ (function(module, exports) {

var groupCoordinatorsApp = new Vue({
  el: '#group-coordinators-app',
  data: {
    admin: adminLoaded,
    group: groupLoaded,
    coordinators: coordinatorsLoaded,
    removeIndex: { created: '', id: '', user: {
        name: '', id: '', email: ''
      } },
    coordinator: {
      new: { name: '', email: '', cell: '', home: '', street: '', zip: '', active: 0, available: null },
      existing: { selected: '-1', name: '', id: '', searched: false, active: 1 },
      valid: null
    },
    typingTimeout: null,
    searchUser: '',
    selectUser: ''
  },
  methods: {
    newCoordinator: function newCoordinator() {
      fadeIn('#coverlay');
      fadeIn('#new-coordinator-modal');
    },
    removeCoordinator: function removeCoordinator(index) {
      this.removeIndex = this.coordinators[index];
      fadeIn('#coverlay');
      fadeIn('#remove-coordinator-modal');
    },
    deleteSelected: function deleteSelected() {
      var coordApp = this;
      $.ajax({
        type: "POST",
        url: '/coordinators/destroy',
        data: { coord_id: coordApp.removeIndex.id },
        success: function success(response) {
          if (response == 'SUCCESS') {
            window.location.reload();
          }
        }
      });
    },
    updateSelected: function updateSelected() {
      if (this.coordinator.existing.selected != '-1') {
        this.coordinator.existing.name = this.selectUser[this.coordinator.existing.selected].name;
        this.coordinator.existing.id = this.selectUser[this.coordinator.existing.selected].id;
        this.checkExisting();
      } else {
        this.coordinator.valid = null;
      }
    },
    storeMethod: function storeMethod(event) {
      this.coordinator.valid = null;
      if (event.toElement.id == 'radio-new-user') {
        this.coordinator.new.active = 1;
        this.coordinator.existing.active = 0;
        this.validateNewUser();
        setTimeout(function () {
          bindFormatters();
        }, 100);
      } else {
        this.coordinator.existing.active = 1;
        this.coordinator.new.active = 0;
        this.updateSelected();
      }
    },
    searchExisting: function searchExisting() {
      this.coordinator.existing = { selected: '-1', name: '', id: '', searched: true, active: 1 };
      this.coordinator.valid = null;
      var coordApp = this;
      $.ajax({
        type: "GET",
        url: '/user/search/criteria-name',
        data: { name: coordApp.searchUser },
        success: function success(response) {
          coordApp.selectUser = response;
        }
      });
    },
    searchAuto: function searchAuto(event) {
      if (event.keyCode == 13) {
        this.coordinator.valid = null;
        this.searchExisting();
      }
    },
    checkExisting: function checkExisting() {
      var coordApp = this;
      $.ajax({
        type: "GET",
        url: '/coordinators/precheck',
        data: { user_id: coordApp.coordinator.existing.id, group_id: coordApp.group.id },
        success: function success(response) {
          if (response == 'OPEN') coordApp.coordinator.valid = true;
          if (response == 'TAKEN') coordApp.coordinator.valid = false;
        }
      });
    },
    checkNewUser: function checkNewUser() {
      var coordApp = this;
      this.coordinator.valid = false;
      clearTimeout(coordApp.typingTimeout);
      coordApp.typingTimeout = setTimeout(function () {
        $.ajax({
          type: "GET",
          url: '/precheck',
          data: { email: coordApp.coordinator.new.email },
          success: function success(response) {
            if (response == 'OPEN') coordApp.coordinator.new.available = true;
            if (response == 'TAKEN') coordApp.coordinator.new.available = false;

            coordApp.validateNewUser();
          }
        });
      }, 200);
    },
    validateNewUser: function validateNewUser() {
      var newUser = this.coordinator.new;
      if (validEmail(newUser.email) == true && newUser.name != '' && newUser.available == true && (newUser.home.length > 12 && newUser.cell == '' || newUser.home == '' && newUser.cell.length > 12 || newUser.home.length > 12 && newUser.cell.length > 12) && newUser.street != '' && newUser.zip.length > 4) {
        this.coordinator.valid = true;
      } else {
        this.coordinator.valid = false;
      }
    },
    closeModals: function closeModals() {
      this.removeIndex = { created: '', id: '', user: {
          name: '', id: '', email: ''
        } };
      this.coordinator = {
        new: { name: '', email: '', cell: '', home: '', street: '', zip: '', active: this.coordinator.new.active, available: null },
        existing: { selected: '-1', name: '', id: '', searched: false, active: this.coordinator.existing.active },
        valid: null
      };
      this.searchUser = '';
      this.selectUser = '';
      fadeOut('#coverlay');
      fadeOut('#remove-coordinator-modal');
      fadeOut('#new-coordinator-modal');
    }
  },
  mounted: function mounted() {},

  components: {
    // all imported / created compenents
  },
  computed: {}
});

/***/ })

/******/ });