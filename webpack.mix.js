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

mix.js(['resources/js/app.js',
          'resources/js/index.js',
          'resources/js/edit.blade.jquery.js',
          'resources/js/create.blade.jquery.js'], 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css');
