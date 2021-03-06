const mix = require('laravel-mix');

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

 mix.js('resources/backend/js/back.js', 'public/backend/js')
    .sass('resources/backend/sass/back.scss', 'public/backend/css')
    .js('resources/frontend/js/front.js', 'public/frontend/js')
   .sass('resources/frontend/sass/front.scss', 'public/frontend/css');
