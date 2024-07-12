let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss');
let postCssImport = require('postcss-import');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix
    .less('resources/less/landing.less', './public/css')
    .less('resources/less/app.less', './public/css')
    .js('resources/js/app.js', './public/js').vue()
    .options({
        postCss: [
            postCssImport(),
            tailwindcss('./tailwind.config.js'),
        ]
    });
