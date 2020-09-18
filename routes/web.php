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



// **USER CRUD
// Route::get("/users", "UserController@index");
// Route::get("/create-user", "UserController@create");


// ** TODO ROUTES
Route::get("/todos", 'TodoController@index');
Route::get('/todos/edit/{id}', 'TodoController@edit')->name('todos.edit');
Route::put("/todos/edit/{id}", "TodoController@update")->name("todos.update");
Route::post('/todos', 'TodoController@insert');
Route::delete('/todos/delete/{todo}', 'TodoController@delete')->name('todos.delete');



// **UPLOAD AVATAR
Route::post("/upload-avatar", "UserController@uploadAvatar");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
