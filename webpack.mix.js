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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.sass('resources/assets/sass/login.scss', 'public/css');

mix.scripts([
  'resources/assets/js/components/tools/jquery.mask.min.js',
  'resources/assets/js/components/tools/form_validation.js',
  'resources/assets/js/components/tools/bounce.min.js',
  'resources/assets/js/components/tools/bounce_presets.js',
  'resources/assets/js/components/tools/zip_autofill.js',
  'resources/assets/js/components/login/multi_step.js',
  'resources/assets/js/components/login/button.js',
  'resources/assets/js/components/login/register.js',
], 'public/js/login.js');

mix.js('resources/assets/js/components/jquery.js', 'public/js');
