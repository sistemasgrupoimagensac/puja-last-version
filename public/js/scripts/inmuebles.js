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

/***/ "./resources/js/scripts/inmuebles.js":
/*!*******************************************!*\
  !*** ./resources/js/scripts/inmuebles.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// logica para que el precio minimo siempre sea menor que el precio maximo ==========================================
var preciominimo = document.querySelector('#preciominimo');
var preciomaximo = document.querySelector('#preciomaximo');
preciominimo.addEventListener('change', function () {
  return compareMinMax(preciominimo, preciomaximo);
});
preciomaximo.addEventListener('change', function () {
  return compareMaxMin(preciomaximo, preciominimo);
});

// logica para que el área minima siempre sea menor que el area maxima
var areaminima = document.querySelector('#areaminima');
var areamaxima = document.querySelector('#areamaxima');
areaminima.addEventListener('change', function () {
  return compareMinMax(areaminima, areamaxima);
});
areamaxima.addEventListener('change', function () {
  return compareMaxMin(areamaxima, areaminima);
});

// funciones de comparacion de minimo con maximo
function compareMinMax(minimo, maximo) {
  var minValue = parseInt(minimo.value);
  var maxValue = parseInt(maximo.value);
  if (minValue > maxValue) {
    maximo.value = null;
  }
}
function compareMaxMin(maximo, minimo) {
  var minValue = parseInt(minimo.value);
  var maxValue = parseInt(maximo.value);
  if (minValue > maxValue) {
    minimo.value = null;
  }
}

// logica para cambiar nombre del titulo del filtro TRANSACCION ===================================================================
var dropdownItemsVenta = document.querySelectorAll('.filters-dropdown-li.trasaction');
var filterTitleVenta = document.getElementById('trasactionfiltertittle');
dropdownItemsVenta.forEach(function (item) {
  item.addEventListener('click', function (event) {
    event.preventDefault();
    var selectedValue = this.getAttribute('data-value');
    if (selectedValue === 'venta') {
      filterTitleVenta.textContent = 'Venta';
    } else if (selectedValue === 'alquiler') {
      filterTitleVenta.textContent = 'Alquiler';
    } else if (selectedValue === 'remate') {
      filterTitleVenta.textContent = 'Remate';
    }
  });
});

// logica para cambiar nombre del titulo del filtro TIPO INMUEBLE ===================================================================
var dropdownItemsTipo = document.querySelectorAll('.filters-dropdown-li.tipo');
var filterTitleTipo = document.getElementById('tipofiltertittle');
dropdownItemsTipo.forEach(function (item) {
  item.addEventListener('click', function (event) {
    event.preventDefault();
    var selectedValue = this.getAttribute('data-value');
    if (selectedValue === 'departamento') {
      filterTitleTipo.textContent = 'Departamento';
    } else if (selectedValue === 'casa') {
      filterTitleTipo.textContent = 'Casa';
    } else if (selectedValue === 'local_comercial') {
      filterTitleTipo.textContent = 'Local Comercial';
    } else if (selectedValue === 'oficina') {
      filterTitleTipo.textContent = 'Oficina';
    } else if (selectedValue === 'terreno') {
      filterTitleTipo.textContent = 'Terreno / Lote';
    } else if (selectedValue === 'casa_campo') {
      filterTitleTipo.textContent = 'Casa de Campo';
    } else if (selectedValue === 'casa_playa') {
      filterTitleTipo.textContent = 'Casa de Playa';
    }
  });
});

/***/ }),

/***/ 1:
/*!*************************************************!*\
  !*** multi ./resources/js/scripts/inmuebles.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\refactor_puja\resources\js\scripts\inmuebles.js */"./resources/js/scripts/inmuebles.js");


/***/ })

/******/ });