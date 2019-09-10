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

use Illuminate\Filesystem\Filesystem;
use App\Services\Twitter;

// app()->singleton('App\Services\Twitter', function() {
//   // dd('called');
//   return new \App\Services\Twitter('asfas');

// });

Route::get('/', function (Twitter $twitter) {
    
    return view('welcome');
});

Route::resource('projects', 'ProjectsController');

Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');


Route::post('/completed-tasks/{task}', 'CompletedTasksController@store');
Route::delete('/completed-tasks/{task}', 'CompletedTasksController@destroy');

// Route::get('/projects', 'ProjectsController@index');
// Route::get('/projects/create', 'ProjectsController@create');
// Route::get('/projects/{project}', 'ProjectsController@show');
// Route::post('/projects', 'ProjectsController@store');
// Route::get('/projects/{project}/edit', 'ProjectsController@edit');
// Route::patch('/projects/{project}', 'ProjectsController@update');
// Route::delete('/projects/{project}', 'ProjectsController@destroy');



/* Routing conventions 

  GET /projects (index)

  GET /projects/create (create)

  GET /projects/1 (show)

  GET /projects/1/edit (edit) 

  POST /projects (store)

  PATCH /projects/1 (update)

  DELETE /projects/2 (destroy)

*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
