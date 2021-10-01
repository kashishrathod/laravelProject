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
});
Route::get('get-dropzone-view', 'DropzoneController@getDropzoneView');
Route::get('get-dropzone-list', 'DropzoneController@getListing');
Route::post('dropzone/store','DropzoneController@store');
Route::post('save-documents','DropzoneController@save');
Route::get('edit/{id}','DropzoneController@edit');
Route::post('edit-documents/{id}','DropzoneController@editDocument')->name('edit-documents');
Route::get('delete/{id}','DropzoneController@deleteDocument')->name('delete');
