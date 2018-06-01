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
        'edit' => 'projects.edit',
        'update' => 'projects.update',
        'destroy' => 'projects.delete',
    ]
   ]);
Route::resource('tickets', 'TicketsController', ['names' => [
    'store' => 'tickets.store',
    'show' => 'tickets.show',
    'edit' => 'tickets.edit',
    'update' => 'tickets.update',
    'destroy' => 'tickets.delete',
]
]);
Route::get('tickets/create/{id}', 'TicketsController@createTicket')->name('tickets.create');
Route::post('/project/add/member', 'ProjectsController@addMember')->name('project.add.members');
Route::get('/project/{project_id}/remove/{user_id}', 'ProjectsController@removeMember')->name('project.remove.member');
Route::post('/ticket/add/member', 'TicketsController@addMember')->name('ticket.add.members');
Route::get('/tickets/{ticket_id}/remove/{user_id}', 'TicketsController@removeMember')->name('ticket.remove.member');
Route::post('comments/new', 'CommentsController@store')->name('comments.new');
Route::post('tickets/priority', 'TicketsController@changePriority')->name('tickets.priority');
Route::get('/tickets/{ticket_id}/remove/tag/{tag_id}', 'TicketsController@removeTag')->name('tag.remove');
Route::post('/tickets/{ticket_id}/add/tags', 'TicketsController@addTags')->name('tags.add');
Route::delete('/comment/{id}', 'CommentsController@destroy')->name('comments.delete');
Route::get('/ticket/{ticket_id}/assign/{user_id}', 'TicketController@selfAssign')->name('tickets.self.assign');
Route::get('/ticket/{ticket_id}/open', 'TicketsController@openTicket')->name('tickets.open');
Route::get('/ticket/{ticket_id}/close', 'TicketsController@closeTicket')->name('tickets.close');

