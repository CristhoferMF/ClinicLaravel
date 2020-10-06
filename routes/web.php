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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    
    Route::resource('clinics', 'ClinicsController',[
        'except' => ['create']
    ]);

    /* Specialties Resource */
    Route::get('specialties/datatables/data','SpecialtiesController@datatable')->name('specialties.datatables.data');
    Route::resource('specialties', 'SpecialtiesController',[
        'except' => ['create']
    ]);
    
    /* Doctors Resource */
    Route::get('doctors/datatables/data','DoctorsController@datatable')->name('doctors.datatables.data');
    Route::resource('doctors', 'DoctorsController');
});


Route::get('/home', 'HomeController@index')->name('home');
