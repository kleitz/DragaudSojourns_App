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

// LOGIN FUNCTIONALITY

mix.js('resources/assets/js/login/preload.js', 'public/js/login/preload.js');
mix.scripts([
  'resources/assets/js/vendor/jquery.mask.min.js',
  'resources/assets/js/vendor/form_validation.js',
  'resources/assets/js/vendor/bounce.min.js',
  'resources/assets/js/vendor/bounce_presets.js',
  'resources/assets/js/vendor/maps.google.js',
  'resources/assets/js/login/app/multi_step.js',
  'resources/assets/js/login/app/button.js',
  'resources/assets/js/login/app/register.js',
], 'public/js/login/app.js');

mix.js('resources/assets/js/login/render.js', 'public/js/login/render.js')
   .sass('resources/assets/sass/login.scss', 'public/css');
