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

mix.sass('resources/sass/app.scss', 'public/css/app-sass.css').options({ processCssUrls: false })
    .scripts([
        'public/js/bootstrap.min.js',
        'public/js/move-top.js',
        'public/js/easing.js',
        'public/js/remodal.min.js',
        'public/js/main.js',
    ], 'public/js/all-min.js')
    .styles([
        'public/css/remodal.css',
        'public/css/remodal-default-theme.css',
        'public/css/icomoon.css',
        'public/fonts/stylesheet.css',
        'public/css/app-sass.css',
        'public/css/styles.css'
    ], 'public/css/all-min.css');