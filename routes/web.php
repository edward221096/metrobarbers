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

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

//USER PROFILE RELATED ROUTES
Route::get('/userprofile', function () {
    return view('sidebar.userprofile');
})->middleware('auth');

//CUSTOMER RELATED ROUTES
Route::get('/customers', function (){
    return view('sidebar.customers');
})->middleware('auth');

Route::resource('customers', 'CustomerController')->middleware('auth');


//ADMIN SESSIONS RELATED ROUTES
Route::get('/sessions', function (){
        return view('sidebar.sessions');
})->middleware('auth');

Route::resource('sessions', 'SessionController')->middleware('auth');

Route::get('/search', 'SessionController@search')->middleware('auth');

//USER SESSIONS RELATED ROUTES
Route::get('/mysessions', function(){
    return view('sidebar.mysessions');
})->middleware('auth');

Route::resource('mysessions', 'MySessionController')->middleware('auth');

//EMPLOYEES RELATED ROUTES
Route::get('/employees', function (){
    return view('sidebar.employees');
})->middleware('auth');

Route::get('/employees','UserController@index')->middleware('auth');

Route::post('/employees','UserController@store')->middleware('auth');

Route::resource('employees', 'UserController')->middleware('auth');

//EMPLOYEES TIME IN OUT RELATED ROUTES

Route::get('/employeestimeinout', function (){
    return view('sidebar.employeestimeinout');
})->middleware('auth');

Route::resource('employeestimeinout', 'JoinUserTimelogsController')->middleware('auth');

//FOR SAVING THE TIMEIN

Route::post('/employeestimeinout','JoinUserTimelogsController@store')->middleware('auth');

//FOR UPDATING TIMEOUT
Route::patch('/employeestimeout/{id}','JoinUserTimelogsController@update');

//HOME RELATED ROUTES
Route::get('/home', function (){
    return view('home');
})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::post('/storesession', 'HomeController@store')->middleware('auth');

//SERVICES RELATED ROUTES
Route::get('/services', function(){
    return view('sidebar.services');
})->middleware('auth');

Route::post('/storeservices', 'ServiceController@store')->name('addimage');

Route::get('/servicepage', 'ServiceController@display');

Route::resource('services', 'ServiceController')->middleware('auth');

//STOCKS AND RELATED ROUTES
Route::get('/stocks', function (){
    return view('sidebar.stocks');
})->middleware('auth');

Route::post('/storestock', 'StockController@store')->middleware('auth');

Route::resource('stocks', 'StockController')->middleware('auth');

//CHART RELATED ROUTES
Route::get('/charts', function (){
    return view('sidebar.charts');
})->middleware('auth');

Route::get('/totalsalesperservice', 'ChartController@totalsalesperservice');

Route::get('/totalsalesperemployee', 'ChartController@totalsalesperemployee');

Route::get('/totalsalesperday', 'ChartController@totalsalesperday');
//AUTH ROUTES
Auth::routes();





