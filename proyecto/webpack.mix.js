const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .webpackConfig(require('./webpack.config'));


mix.styles([
    'resources/css/custom/main.css',
    'resources/css/custom/alertify.css'
],'public/css/global_custom.css');

mix.scripts([
    'resources/js/custom/jquery.js',
    'resources/js/custom/sweetalert.js',
    'resources/js/custom/alertify.js'
],'public/js/global_custom.js');


mix.copyDirectory('resources/img', 'public/img');
/*
   mix.copy('resource','public')
 */


