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
 */

mix
    .js('resources/assets/js/app.js', 'public/assets/js').version()

    .sass('resources/assets/sass/app.sass', 'public/assets/css/app.css').version()

    .combine([
        'node_modules/bootstrap/dist/css/bootstrap.css',
        'node_modules/bootstrap-vue/dist/bootstrap-vue.css',
        'node_modules/bootstrap/dist/css/bootstrap-theme.css',
        'node_modules/font-awesome/css/font-awesome.css',
        'node_modules/open-sans/css/open-sans.css',
        'node_modules/simple-line-icons/css/simple-line-icons.css',
        'node_modules/ladda/dist/ladda-themeless.min.css',
        'node_modules/sweetalert2/dist/sweetalert2.css',
        'node_modules/csshake/dist/csshake.css',
        'resources/assets/css/switches.css',
        'resources/assets/css/components.css',
        'resources/assets/css/darkblue.css',
        'resources/assets/css/layout.css',
        'resources/assets/css/plugins.css',
        'resources/assets/css/todo.css',
    ], 'public/assets/css/vendor.css')

    .combine(['resources/assets/css/login.css'], 'public/assets/css/login.css').version()
    .combine(['resources/assets/css/error.css'], 'public/assets/css/error.css').version()

    .copy('node_modules/font-awesome/fonts', 'public/assets/fonts')
    .copy('node_modules/npm-font-open-sans/fonts', 'public/assets/fonts')
    .copy('node_modules/simple-line-icons/fonts', 'public/assets/fonts')
    .copy('node_modules/material-design-icons-iconfont/dist/fonts', 'public/assets/fonts')

    .copyDirectory('resources/assets/img', 'public/assets/img');
