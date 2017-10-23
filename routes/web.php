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


// PUBLIC ROUTES
Route::get('home', function (){
    return view('public.index');
})->name('home');

Route::get('/', function () {
    return view('public.index');
})->middleware('guest');

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

// ROUTE POST ALT's
Route::get('/newtraveler', function(){
  return redirect('/');
});
Route::get('/updatetraveler', function(){
  return redirect('/');
});
Route::get('/login', function(){
  return redirect('/');
});
Route::get('/register', function(){
  return redirect('/');
});
Route::get('/profile/user/update', function(){
  return redirect('/');
});
Route::get('/profile/user/confidential', function(){
  return redirect('/');
});
Route::get('/groups/store', function(){
  return redirect('/');
});
Route::get('/trips/store', function(){
  return redirect('/');
});
Route::get('/payments/store', function(){
  return redirect('/');
});
Route::get('admin/group/new', function(){
  return redirect('admin/groups/new');
});
Route::get('/admins/icon/store', function(){
  return redirect('/groups/create');
});
Route::get('/admins/icon/destroy', function(){
  return redirect('/groups/create');
});


// USER ROUTES & AUTHENTICATION
Route::get('/precheck', 'UsersController@precheck');
Route::post('/register', 'UsersController@store')->name('register');
Route::post('/login', 'UsersController@login')->name('login');
Route::get('/logout', 'UsersController@logout')->name('logout');

// PASSWORD RESET ROUTES
Route::group(['namespace' => 'Auth'], function() {
  Route::get('/user/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
  Route::post('/user/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
  Route::get('/user/password/reset/{token}', 'ResetPasswordController@showResetForm');
  Route::post('/user/password/reset', 'ResetPasswordController@reset');
});

// ACCOUNTS ROUTES
Route::get('/profile/{email}', 'AccountsController@create')->name('profile.index');
Route::get('/profile/{email}/payments/{page}', 'AccountsController@showPayments')->name('profile.payments');
Route::get('/profile/{email}/trips/{page}', 'AccountsController@showTrips')->name('profile.trips');
Route::post('/profile/user/update', 'AccountsController@userUpdate');
Route::post('/profile/user/confidential', 'AccountsController@confidentialUpdate');

// ADMIN ROUTES
Route::get('/admin/{email}/dashboard', 'AdminsController@create')->name('admin.dashboard');
Route::get('/admin/{email}/groups/{page}', 'GroupsController@show')->name('admin.groups');
Route::get('/admin/{email}/accounts/{page}', 'AccountsController@show')->name('admin.accounts');
Route::get('/admin/{email}/payments/{page}', 'PaymentsController@show')->name('admin.payments');
Route::get('/admin/{email}/group/new', 'GroupsController@create')->name('admin.newgroup');
Route::post('/admin/icon/store', 'AdminsController@storeIcon');
Route::post('/admin/icon/destroy', 'AdminsController@destroyIcon');

// TRAVELERS ROUTES
Route::post('/newtraveler', 'TravelersController@store');
Route::post('/updatetraveler', 'TravelersController@update');

// GROUPS ROUTES
Route::get('/groups/precheck', 'GroupsController@precheck');
Route::post('/groups/store', 'GroupsController@store');
Route::get('/groups/specific', 'GroupsController@specific');

// TRIPS ROUTES
Route::post('/trips/store', 'TripsController@store');
Route::get('/trips/precheck', 'TripsController@precheck');

// PAYMENTS ROUTES
Route::post('/payments/store', 'PaymentsController@store');
Route::get('/payments/receipts/{verification}', 'PaymentsController@createReceipt');
Route::get('/trips/receipts/{trip_id}', 'PaymentsController@createTripReceipt');
