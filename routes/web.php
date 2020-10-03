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
    
    Route::get('sedes/estadisticas',function(){
        return 'estadisticas';
    });

    Route::resource('sedes', 'ClinicsController',[
        'except' => ['create'],
        'names' => [
            'index' => 'clinics.index',
            'store' => 'clinics.store',
            'edit' => 'clinics.edit',
            'update' => 'clinics.update',
            'destroy' => 'clinics.destroy',
            'show' => 'clinics.show',
        ]
    ]);
    
    Route::get('especialidades/datatables','SpecialtiesController@anyData')->name('specialties.datatables.data');
    Route::resource('especialidades', 'SpecialtiesController',[
        'only' => ['index','store','edit','update'],
        'names' => [
            'index' => 'specialties.index',
            'store' => 'specialties.store',
            'edit' => 'specialties.edit',
            'show' => 'specialties.show',
            'update' => 'specialties.update',
        ]
    ]);

});


Route::get('/home', 'HomeController@index')->name('home');
