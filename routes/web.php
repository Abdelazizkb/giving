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
Route::get('/membre', 'MembreController@index')->name('membre');
Route::get('/donor', 'DonorController@index')->name('donor');
Route::get('/demandeur', 'DemandeurController@index')->name('demandeur');



Route::post('/donor/register', 'Auth\RegisterController@createDonor')->name('donor-register');

Route::post('/membre/register', 'Auth\RegisterController@createMembre')->name('membre-register');
Route::post('/demandeur/register', 'Auth\RegisterController@createDemandeur')->name('demandeur-register');




Route::get('/admin/register', 'Auth\RegisterController@showAdminRegisterForm')->name('adminregister');
Route::post('/admin/register', 'Auth\RegisterController@createAdmin');

Route::get('/admin/login', 'Auth\LoginController@showAdminloginForm')->name('adminlogin');
Route::post('/admin/login', 'Auth\LoginController@adminlogin');