const {mix} = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// carrega scripts iniciais JS e SCSS BACKEND
mix
    .js('resources/assets/start_js/main_backend.js', 'public/_backend/js')
    .stylus('resources/assets/_backend/stylus/main.styl', 'public/_backend/css')
    .sass('resources/assets/_backend/scss/app_backend.scss', 'public/_backend/css')
    .version()
;

// carrega scripts iniciais JS e SCSS FRONTEND
mix
    .js('resources/assets/start_js/main_frontend.js', 'public/_frontend/js')
    .sass('resources/assets/_frontend/scss/app_frontend.scss', 'public/_frontend/css')
    .version()
;

// backend rotinas
mix.combine([
    'resources/assets/_backend/css/style.css',
    'resources/assets/_backend/css/custom.css',
], 'public/_backend/css/custom_backend.css');

// mix.copy('resources/assets/css/backend/pages/layouts.css', 'public/_backend/css');


// frontend rotinas
mix.combine([
    'resources/assets/_frontend/css/essentials.css',
    'resources/assets/_frontend/css/header-1.css',
    'resources/assets/_frontend/css/layout.css',
    'resources/assets/_frontend/css/layout-dark.css',
    'resources/assets/_frontend/css/orange.css'
], 'public/_frontend/css/custom_frontend.css');



// comentado em DEV
// mix.copy('resources/assets/_frontend/js_template/plugins', 'public/_frontend/js/plugins');
//
// // assets de usp comum
// mix.copy('resources/assets/img', 'public/img');
// mix.copy('resources/assets/fonts', 'public/fonts');





