// noinspection JSAnnotator
let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/bootstrap4/admin.js', 'public/js').options({
    processCssUrls: false,
})
   .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css');


    .sass('resources/assets/rapiden/rapiden.scss', 'public/css')
 */
//
mix
    .js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/admin.js', 'public/js')
    .sass('resources/assets/sass/admin.scss', 'public/css')
    .sass('resources/assets/AdminLTE/adminlte.scss', 'public/css')
    .sass('resources/assets/rapiden/rapiden.scss', 'public/css')
    .sass('resources/assets/sass/app.scss', 'public/css');

