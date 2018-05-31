<?php

use Bugger\User;

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
    $users = User::all();
    return view('welcome')->with('users', $users);
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::resource('projects', 'ProjectsController', ['names' => [
        'index' => 'projects',
        'create' => 'projects.create',
        'store' => 'projects.store',
        'show' => 'projects.show',
    ]
   ]);
Route::resource('tickets', 'TicketsController', ['names' => [
    'store' => 'tickets.store',
    'show' => 'tickets.show',
]
]);
Route::get('tickets/create/{id}', 'TicketsController@createTicket')->name('tickets.create');
Route::post('/members', 'ProjectsController@addMember')->name('members');
Route::get('/project/{project_id}/remove/{user_id}', 'ProjectsController@removeMember')->name('project.remove.member');
