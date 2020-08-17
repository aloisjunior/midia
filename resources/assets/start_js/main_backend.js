/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../_backend/js/bootstrap'); // jquery, tether, bootstrap

// lib moment.js
window.moment = require('moment');
window.moment.locale('pt-br');

require('babel-polyfill');

// chama App Vue
require('../vue/app_backend');

require('../_backend/js/custom_backend');





