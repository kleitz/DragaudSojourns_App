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

// LOGIN MIX

mix.scripts([
  'resources/assets/js/vendor/jquery.mask.min.js',
  'resources/assets/js/vendor/form_validation.js',
  'resources/assets/js/vendor/bounce.min.js',
  'resources/assets/js/vendor/custom_animations.js',
  'resources/assets/js/vendor/maps.google.js',
  'resources/assets/js/login/app/multi_step.js',
  'resources/assets/js/login/app/button.js',
  'resources/assets/js/login/app/register.js',
], 'public/js/login/app.js');

mix.js('resources/assets/js/login/preload.js', 'public/js/login/preload.js')
   .js('resources/assets/js/login/render.js', 'public/js/login/render.js')
   .sass('resources/assets/sass/login.scss', 'public/css');

// USER ACCOUNT MIX

mix.scripts([
  'resources/assets/js/vendor/jquery.mask.min.js',
  'resources/assets/js/vendor/form_validation.js',
  'resources/assets/js/vendor/bounce.min.js',
  'resources/assets/js/vendor/custom_animations.js',
  'resources/assets/js/vendor/maps.google.js',
  'resources/assets/js/user/app/account.js'
], 'public/js/user/app.js');

mix.js('resources/assets/js/user/preload.js', 'public/js/user/preload.js')
   .js('resources/assets/js/user/render.js', 'public/js/user/render.js')
   .sass('resources/assets/sass/user.scss', 'public/css');
