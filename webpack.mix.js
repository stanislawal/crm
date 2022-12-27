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

// app js
mix.js('resources/js/app.js', 'public/js');

// app css
mix.css('resources/css/app.css', 'public/css');

// auth css
mix.css('resources/css/auth.css', 'public/css');

//project css
mix.css('resources/css/projects.css', 'public/css');

//select2 (plugin) js
mix.js('resources/js/select2.js', 'public/js');
