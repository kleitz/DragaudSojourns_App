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

mix.babel([
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

mix.babel([
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


// ADMIN ACCOUNTS MIX

mix.babel([
  'resources/assets/js/vendor/jquery.mask.min.js',
  'resources/assets/js/vendor/form_validation.js',
  'resources/assets/js/vendor/bounce.min.js',
  'resources/assets/js/vendor/custom_animations.js',
  'resources/assets/js/admin/app/admin.js'
], 'public/js/admin/app.js');

mix.js('resources/assets/js/admin/preload.js', 'public/js/admin/preload.js')
   .js('resources/assets/js/admin/groupCreate.js', 'public/js/admin/groupCreate.js')
   .js('resources/assets/js/admin/groupFocus.js', 'public/js/admin/groupFocus.js')
   .js('resources/assets/js/admin/groupOverview.js', 'public/js/admin/groupOverview.js')
   .js('resources/assets/js/admin/groupPayments.js', 'public/js/admin/groupPayments.js')
   .js('resources/assets/js/admin/groupCoordinators.js', 'public/js/admin/groupCoordinators.js')
   .js('resources/assets/js/admin/dashboard.js', 'public/js/admin/dashboard.js')
   .sass('resources/assets/sass/admin.scss', 'public/css');
