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


Route::post('/login', 'AuthController@login')->name('login');
Route::get('/login', 'PageController@login')->name('login');

Route::post('/register', 'AuthController@register')->name('register');
Route::get('/register', 'PageController@register')->name('register');

Route::middleware('auth-check')->group(function () {
    Route::get('/', 'PageController@home')->name('home');
    Route::POST('/create-appointment', 'AppointmentController@createAppointment')->name('create-appointment');
    Route::get('/create-appointment', 'PageController@createAppointment')->name('create-appointment');

    
    Route::POST('/edit-appointment/{id}', 'AppointmentController@editAppointment')->name('edit-appointment');
    Route::get('/edit-appointment/{id}', 'PageController@editAppointment')->name('edit-appointment');
    
    Route::get('/delete-appointment/{id}', 'AppointmentController@deleteAppointment')->name('delete-appointment');

    Route::get('/logout', 'AuthController@logout')->name('logout');
});

