<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest','guest:donor','guest:admin','guest:membre','guest:demandeur']);

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');




Route::post('/donor/register', 'Auth\RegisterController@createDonor')->name('donor-register');
Route::post('/membre/register', 'Auth\RegisterController@createMembre')->name('membre-register');
Route::post('/demandeur/register', 'Auth\RegisterController@createDemandeur')->name('demandeur-register');




Route::get('/admin/register', 'Auth\RegisterController@showAdminRegisterForm')->name('adminregister');
Route::post('/admin/register', 'Auth\RegisterController@createAdmin');

Route::get('/admin/login', 'Auth\LoginController@showAdminloginForm')->name('adminlogin');
Route::post('/admin/login', 'Auth\LoginController@adminlogin');



Route::post('/verify/{type}', 'verifyController@verify')->name('verify');
Route::get('/verify/{type}', 'verifyController@verifyForm')->name('verify');

Route::get('/resendcode/{type}', 'verifyController@resendcode')->name('resendcode');



Route::get('/confirm/{type}/{user}', 'Auth\ResetPasswordController@resendcode')->name('resendcode-confirm');




Route::get('/profile', 'profileController@index')->name('profile');

Route::get('/profile/{user}', 'profileController@profile')->name('profile-visite');
Route::get('/response/profile/{user}', 'profileController@profileResponse')->name('profile-resposeable');



Route::post('/password/{type}', 'Auth\ResetPasswordController@search')->name('password-search');


Route::post('/password/confirm/{type}', 'Auth\ResetPasswordController@confirm')->name('password-confirm');

Route::post('/password', 'Auth\ResetPasswordController@reset')->name('password-reset');


Route::get('/password/{type}/{phone}', 'Auth\ResetPasswordController@showresetForm')->name('password-reset-form');


Route::resource('publication', 'PublicationController')->except(['index']);
Route::resource('response', 'ResponseController')->except(['index','create']);
Route::resource('annonce', 'AnnonceController');
Route::resource('association', 'AssociationController')->only(['index','show','update','edit']);
Route::resource('domain', 'DomainController')->only(['store']);

Route::get('publication/filter/{domain}', 'PublicationController@filter')->name('filter');
