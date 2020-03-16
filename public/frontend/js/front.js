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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/frontend/js/front.js":
/*!****************************************!*\
  !*** ./resources/frontend/js/front.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./init */ "./resources/frontend/js/init.js");

/***/ }),

/***/ "./resources/frontend/js/init.js":
/*!***************************************!*\
  !*** ./resources/frontend/js/init.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  $(function () {
    $('.materialboxed').materialbox();
    $('select').formSelect();
    $("#togglesidenav").click(function () {
      var elem = document.querySelector('#productoptions');
      var instance = M.Sidenav.getInstance(elem);

      if (instance.isOpen) {
        instance.close();
      } else {
        instance.open();
      }
    });
    $('.tabs').tabs();
    $('.parallax').parallax();
    $('.sidenav').sidenav();
    $(".dropdown-trigger").dropdown({
      coverTrigger: false,
      constrainWidth: false
    });
    $('.collapsible').collapsible();
  }); // end of document ready
  //viewport animation

  $(document).ready(function () {
    // Check if element is scrolled into view
    function isScrolledIntoView(elem) {
      var docViewTop = $(window).scrollTop();
      var docViewBottom = docViewTop + $(window).height();
      var elemTop = $(elem).offset().top;
      var elemBottom = elemTop + $(elem).height();
      return elemBottom <= docViewBottom && elemTop >= docViewTop;
    } // If element is scrolled into view, fade it in


    $(window).scroll(function () {
      $('.scroll-animated').each(function () {
        var className = $('.scroll-animated').attr('class');
        var res = className.split("animate-");

        if (isScrolledIntoView(this) === true) {
          $(this).addClass('animated ' + res[1]);
        }
      });
    });
  }); //viewport animation
  //mobile bottom navigation

  var navItems = document.querySelectorAll(".mobile-bottom-nav__item");
  navItems.forEach(function (e, i) {
    e.addEventListener("click", function (e) {
      navItems.forEach(function (e2, i2) {
        e2.classList.remove("mobile-bottom-nav__item--active");
      });
      this.classList.add("mobile-bottom-nav__item--active");
    });
  }); //mobile bottm navigation
})(jQuery); // end of jQuery name space


document.addEventListener('DOMContentLoaded', function () {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);
}); //quantity

$('.quantity').change(function () {
  updateQuantity();
});

function updateQuantity() {
  alert("sdfdsf");
}

/***/ }),

/***/ 1:
/*!**********************************************!*\
  !*** multi ./resources/frontend/js/front.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/tomato/resources/frontend/js/front.js */"./resources/frontend/js/front.js");


/***/ })

/******/ });