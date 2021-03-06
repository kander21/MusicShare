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
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/{id}/{name}', function($id, $name) {
    return 'This is user '.$id.' and his/her name is '.$name;
});
*/
/*
Route::get('/about', function(){
    return view('pages.about');
});
*/
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/partners', 'PagesController@partners');
Route::resource('music', 'PostsController'); //php artisan make:controller PostsController --resource
Auth::routes(); //php artisan make:auth //iespējo default autentifikācijas sistēmu
Route::get('/dashboard', 'DashboardController@index');
Route::post('/', 'CommentsController@store');
Route::post('/music', 'SearchController@search');
Route::post('/music/create', 'PostsController@store');
