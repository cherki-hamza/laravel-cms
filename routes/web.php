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

Route::group(['middleware' => 'auth'] , function (){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/categories' , 'CategoriesController');
    Route::resource('/posts' , 'PostsController');
// ->middleware('checkCategory')
    Route::get('/trashed-posts' , 'PostsController@trashed')->name('trashed.index');
    Route::get('/trashed-posts/{id}' , 'PostsController@restore')->name('trashed.restore');
    Route::resource('/tags' , 'TagsController');

});

Route::middleware(['auth' , 'admin'])->group(function (){

    Route::get('/users' , 'UsersController@index')->name('users.index');
    Route::get('/users/create' , 'UsersController@create')->name('users.create');
    Route::post('/users/store' , 'UsersController@store')->name('users.store');
    //Route::get('/users/{id}' , 'UsersController@show')->name('users.show');
    Route::post('/users/{user}/make-admin' , 'UsersController@makeAdmin')->name('users.make-admin');
    Route::post('/users/{user}/make-writer' , 'UsersController@makeWriter')->name('users.make-writer');

});

Route::middleware(['auth'])->group(function (){

    Route::get('/users/{user}/profile' , 'UsersController@edit')->name('users.edit');

    Route::get('/users/{user}/show' , 'UsersController@show')->name('users.show');

    Route::post('/users/{user}/profile' , 'UsersController@update')->name('users.update');

});
