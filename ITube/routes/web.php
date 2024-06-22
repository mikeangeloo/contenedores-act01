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
    return view('home',array('user'=>Auth::user()));
});

Auth::routes();


Route::get('/dashboard/view', 'HomeController@index')->name('dashboard');
//Route :: get('/dashboard/view', 'HomeController@projectsList');


Route::get('/tube_types', 'Tubes_TypesController@select_allTubeTypes');
Route::get('/tubes/{id}', 'TubesController@selectTubes');
Route::get('/cables_types', 'Cable_TypesController@selectAllCableTypes');
Route::get('/cables/{id}', 'CablesController@selectCables');
Route::get('/cablesdiameter/{id}','CablesController@getCableDiameter');

Route::post('calcular',[
    'as' => 'ProjectsController.calcularTrayectoria',
    'uses' => 'ProjectsController@calcularTrayectoria'
]);

Route::put('calcular',[
    'as' => 'ProjectsController.calcularTrayectoria',
    'uses' => 'ProjectsController@calcularTrayectoria'
]);

Route::resource('projects', 'ProjectsController');
Route::resource('tubes_types', 'Tubes_TypesController');
Route::resource('tube', 'TubesController');

//Route::get('user/profile','UserController@profile');
//Route::post('user/update','UserController@update');

Route::resource('users','UserController');
Route::post('pdfview',array('as'=>'pdfview','uses'=>'PDFController@pdfview'));