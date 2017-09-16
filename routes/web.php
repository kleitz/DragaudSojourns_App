<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// PUBLIC PAGES - BUILD 1.0
Route::get('/', function () {
    return view('public.index');
});

Route::get('/studenttours', function () {
    return view('public.studenttours');
});

Route::get('/privatetours', function () {
    return view('public.privatetours');
});

Route::get('/testimonials', function () {
    return view('public.testimonials');
});

Route::get('/aboutus', function () {
    return view('public.aboutus');
});

Route::get('/contactus', function () {
    return view('public.contactus');
});

Route::get('/messagefrommichael', function () {
    return view('public.messagefrommichael');
});

Route::get('/commitmenttoexcellence', function () {
    return view('public.commitmenttoexcellence');
});

Route::get('/newyork', function () {
    return view('public.newyork');
});

Route::get('/greece', function () {
    return view('public.greece');
});

Route::get('/london', function () {
    return view('public.london');
});

Route::get('/foodandhotels', function () {
    return view('public.foodandhotels');
});

?>
