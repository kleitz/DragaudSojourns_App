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
Route::get('/profile/@resetpassword', 'UsersController@redirectProfile');

Route::get('/admin/icon/store', function(){
  return redirect('/groups/create');
});
Route::get('/admin/icon/destroy', function(){
  return redirect('/groups/create');
});
Route::get('/admin', function(){
  return redirect(route('admin.login'));
});
Route::get('/admin/@resetpassword/dashboard', function(){
  return redirect(route('admin.login'));
});


// USER ROUTES & AUTHENTICATION
Route::get('/precheck', 'UsersController@precheck')->name('precheck');
Route::post('/register', 'UsersController@store')->name('register');
Route::post('/login', 'UsersController@login')->name('login');
Route::get('/logout', 'UsersController@logout')->name('logout');
Route::get('/user/search/criteria-name', 'UsersController@searchByName')->name('user.search.byname');

// PASSWORD RESET ROUTES
Route::group(['namespace' => 'Auth'], function() {
  Route::get('/user/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
  Route::post('/user/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
  Route::get('/user/password/reset/{token}', 'ResetPasswordController@showResetForm');
  Route::post('/user/password/reset', 'ResetPasswordController@reset');
});

// PROFILE ROUTES
Route::prefix('profile')->group(function(){
  Route::get('/{email}', 'AccountsController@create')->name('profile.index');
  Route::get('/{email}/payments/{page}', 'AccountsController@showPayments')->name('profile.payments');
  Route::get('/{email}/trips/{page}', 'AccountsController@showTrips')->name('profile.trips');
  Route::get('/{email}/groups/{page}', 'AccountsController@showGroups')->name('profile.groups');
  Route::post('/user/update', 'AccountsController@userUpdate')->name('profile.update');
  Route::post('/user/confidential', 'AccountsController@confidentialUpdate')->name('profile.confidential');
});

// ADMIN ROUTES
Route::prefix('admin')->group(function(){
  // - AUTHENTICATION
  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
  Route::get('/logout', 'AdminsController@logout')->name('admin.logout');
  Route::get('/precheck', 'Auth\AdminLoginController@precheck')->name('admin.precheck');

  //  - PASSWORD RESET
  Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
  Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
  Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');

  // - SECTIONS
  Route::get('/{email}/dashboard', 'AdminsController@index')->name('admin.dashboard');
  Route::get('/{email}/groups/{page}', 'AdminsController@groups')->name('admin.groups');
  Route::get('/{email}/accounts/{page}', 'AdminsController@accounts')->name('admin.accounts');
  Route::get('/{email}/payments/{page}', 'AdminsController@payments')->name('admin.payments');

  // - GROUP CRUD FUNCTIONS
  Route::get('/{email}/group/{groupNumber}', 'AdminsController@groupOverview')->name('admin.groupoverview');
  Route::get('/{email}/group/{groupNumber}/payments', 'AdminsController@groupPayments')->name('admin.grouppayments');
  Route::get('/{email}/group/{groupNumber}/coordinators', 'AdminsController@groupCoordinators')->name('admin.groupcoordinators');
  Route::get('/{email}/new/group', 'AdminsController@groupCreate')->name('admin.groupcreate');
  Route::post('/icon/store', 'GroupsController@storeIcon')->name('icon.store');
  Route::post('/icon/destroy', 'GroupsController@destroyIcon')->name('icon.destroy');
  Route::get('/{email}/report/{group_id}', 'GroupsController@bookingReport')->name('booking.report');

  // - SETTINGS
  Route::get('/{email}/settings/', 'AdminsController@settings')->name('admin.settings');
  Route::post('/profile/update', 'AdminsController@update')->name('admin.update');
  Route::post('/system/store', 'AdminsController@store')->name('admin.store');
  Route::get('/system/destroy/{admin_id}', 'AdminsController@destroy')->name('admin.destroy');
  Route::post('/auth/edit', 'AdminsController@edit')->name('admin.edit');
  Route::get('/{email}/system/update/{admin_id}', 'AdminsController@specific')->name('admin.specific');
});

// TRAVELERS ROUTES
Route::post('/newtraveler', 'TravelersController@store')->name('travelers.store');
Route::post('/updatetraveler', 'TravelersController@update')->name('travelers.update');

// GROUPS ROUTES
Route::prefix('groups')->group(function(){
  Route::get('/precheck', 'GroupsController@precheck')->name('groups.precheck');
  Route::post('/store', 'GroupsController@store')->name('groups.store');
  Route::post('/{group_id}/{email}/update', 'GroupsController@update')->name('groups.update');
  Route::get('/specific', 'GroupsController@specific')->name('groups.specific');
});

// TRIPS ROUTES
Route::prefix('trips')->group(function(){
  Route::get('/precheck', 'TripsController@precheck')->name('trips.precheck');
  Route::post('/toggleActive', 'TripsController@toggleActive')->name('trips.toggleActive');
  Route::post('/store', 'TripsController@store')->name('trips.store');
  Route::get('/receipts/{trip_id}', 'PaymentsController@createTripReceipt')->name('trips.receipt');
});

// PAYMENTS ROUTES
Route::prefix('payments')->group(function(){
  Route::post('/credit', 'PaypalController@process')->name('payments.credit');
  Route::post('/create', 'PaypalController@create')->name('payments.create');
  Route::post('/execute', 'PaypalController@execute')->name('payments.execute');
  Route::get('/details', 'PaypalController@details')->name('payments.details');
  Route::get('/update', 'PaypalController@update')->name('payments.update');
  Route::post('/store', 'PaymentsController@store')->name('payments.store');
  Route::post('/discount', 'PaymentsController@discount')->name('payments.discount');
  Route::get('/receipts/{verification}', 'PaymentsController@createReceipt')->name('payments.receipt');
});


Route::prefix('coordinators')->group(function(){
  Route::get('/precheck', 'CoordinatorsController@precheck')->name('coordinators.precheck');
  Route::post('/destroy', 'CoordinatorsController@destroy')->name('coordinators.destroy');
  Route::get('/store', 'CoordinatorsController@store')->name('coordinators.store');
  Route::get('/create', 'CoordinatorsController@create')->name('coordinators.create');
});
