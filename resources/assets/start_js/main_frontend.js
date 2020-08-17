/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../_frontend/js/bootstrap'); // chama bootstrap.js na mesma pasta

// lib moment.js
window.moment = require('moment');
window.moment.locale('pt-br');

// chama App Vue
require('../vue/app_frontend');

// custom libs
require('../_frontend/js/custom_frontend');




