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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::match(['get', 'post'], '/', ['as' => '/', 'uses' => 'admin\LoginController@login']);
//Route::match(['get', 'post'], 'admin-login', ['as' => 'admin-login', 'uses' => 'admin\LoginController@login']);
//Route::match(['get', 'post'], 'forgotpassword', ['as' => 'forgotpassword', 'uses' => 'admin\LoginController@forgotpassword']);
//Route::match(['get', 'post'], 'resetpassword/{id}', ['as' => 'resetpassword', 'uses' => 'admin\LoginController@resetpassword']);
Route::match(['get', 'post'], '/', ['as' => '/', 'uses' => 'admin\LoginController@adminlogin']);
Route::match(['get', 'post'], 'admin-login', ['as' => 'admin-login', 'uses' => 'admin\LoginController@adminlogin']);
Route::match(['get', 'post'], 'admin-forgotpassword', ['as' => 'admin-forgotpassword', 'uses' => 'admin\LoginController@adminforgotpassword']);
Route::match(['get', 'post'], 'admin-resetpassword/{id}', ['as' => 'admin-resetpassword', 'uses' => 'admin\LoginController@adminresetpassword']);



Route::group(['middleware' => 'check-authorized-admin'], function () {
    Route::match(['get', 'post'], 'admin-dashboard', ['as' => 'admin-dashboard', 'uses' => 'admin\AdmindashboardController@dashboard']);
    
    //univercity crud by admin
    Route::match(['get', 'post'], 'univercity', ['as' => 'univercity', 'uses' => 'admin\AdmindashboardController@univercity']);
    Route::match(['get', 'post'], 'add-univercity', ['as' => 'add-univercity', 'uses' => 'admin\AdmindashboardController@add']);
    Route::match(['get', 'post'], 'edit-univercity/{id}', ['as' => 'edit-univercity', 'uses' => 'admin\AdmindashboardController@edit']);
    Route::match(['get', 'post'], 'univercity-ajaxaction', ['as' => 'univercity-ajaxaction', 'uses' => 'admin\AdmindashboardController@ajaxaction']);
    
    //company crud by admin
    Route::match(['get', 'post'], 'company', ['as' => 'company', 'uses' => 'admin\CompanyController@company']);
    Route::match(['get', 'post'], 'add-company', ['as' => 'add-company', 'uses' => 'admin\CompanyController@add']);
    Route::match(['get', 'post'], 'edit-company/{id}', ['as' => 'edit-company', 'uses' => 'admin\CompanyController@edit']);
    Route::match(['get', 'post'], 'company-ajaxaction', ['as' => 'company-ajaxaction', 'uses' => 'admin\CompanyController@ajaxaction']);
    
    //job crud by admin
    Route::match(['get', 'post'], 'job', ['as' => 'job', 'uses' => 'admin\JobController@job']);
    Route::match(['get', 'post'], 'add-job', ['as' => 'add-job', 'uses' => 'admin\JobController@add']);
    Route::match(['get', 'post'], 'edit-job/{id}', ['as' => 'edit-job', 'uses' => 'admin\JobController@edit']);
    Route::match(['get', 'post'], 'job-ajaxaction', ['as' => 'job-ajaxaction', 'uses' => 'admin\JobController@ajaxaction']);
});
Route::group(['middleware' => 'check-authorized-univercity'], function () {
    
});
Route::group(['middleware' => 'check-authorized-company'], function () {
    
});

Route::match(['get', 'post'], 'logout', ['as' => 'logout', 'uses' => 'admin\LoginController@logout']);