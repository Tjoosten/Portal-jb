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



Auth::routes(['register' => false]);

Route::get('/', 'HomeController@indexFrontend')->name('/');
Route::get('/home', 'HomeController@indexBackend')->name('home');

// Disclaimer routes 
Route::view('/gebruikersvoorwaarden', 'disclaimers.terms-of-service')->name('disclaimer.terms');

// Werkpunten routes
Route::get('/werkpunten/index', 'Lokalen\WerkpuntenController@index')->name('werkpunten.index');
Route::get('{lokaal}/werkpunten/{status}', 'Lokalen\WerkpuntenController@lokaal')->name('werkpunten.lokaal');
Route::get('/werkpunten/create', 'Lokalen\WerkpuntenController@create')->name('werkpunten.create');
Route::post('/werkpunten/create', 'Lokalen\WerkpuntenController@store')->name('werkpunten.store');

// Lokalen routes
Route::get('/lokalen', 'Lokalen\IndexController@index')->name('lokalen.index');
Route::get('/lokalen/nieuw', 'Lokalen\IndexController@create')->name('lokalen.create');
Route::post('/lokalen/nieuw', 'Lokalen\IndexController@store')->name('lokalen.store');
Route::get('/lokalen/wijzig/{lokaal}', 'Lokalen\IndexController@edit')->name('lokalen.edit');
Route::patch('/lokalen/wijzig/{lokaal}', 'Lokalen\IndexController@update')->name('lokalen.update');
Route::match(['get', 'delete'], '/lokalen/verwijder/{lokaal}', 'Lokalen\IndexController@destroy')->name('lokalen.delete');

// Activity log routes
Route::get('logs/{user}', 'Users\ActivityController@show')->name('activity.user');

// Helpdesk routes
Route::get('helpdesk/huurder', 'Helpdesk\DashboardController@huurder')->name('helpdesk.index.huurder');
Route::get('helpdesk/mijn-vragen/{filter?}', 'Helpdesk\TenantController@index')->name('helpdesk.overview.user');
Route::post('helpdesk/ticket', 'Helpdesk\SharedController@store')->name('helpdesk.ticket.store');
Route::get('helpdesk/ticket/{ticket}', 'Helpdesk\SharedController@show')->name('helpdesk.ticket.show');
Route::get('helpdesk/ticket/assign/{ticket}', 'Helpdesk\AdminController@assign')->name('helpdesk.ticket.assign');
Route::get('helpdesk/ticket/{ticket}/{status}', 'Helpdesk\SharedController@status')->name('helpdesk.ticket.status');

// Login lock routes
Route::get('/users/lock/{user}', 'Users\LockController@create')->name('logins.lock');
Route::post('/users/lock/{user}', 'Users\LockController@store')->name('logins.lock.store');
Route::match(['get', 'delete'], '/users/unlock/{user}', 'Users\LockController@destroy')->name('logins.unlock');

// Calendar Routes
Route::get('calendar', 'Lease\CalendarController@index')->name('calendar.index');
Route::get('calendar/create', 'Lease\CalendarController@create')->name('calendar.create');
Route::post('calendar/create', 'Lease\CalendarController@store')->name('calendar.store');
Route::get('calendar/{lease}', 'Lease\CalendarController@show')->name('calendar.show');
Route::match(['get', 'delete'], 'calendar/delete/{lease}', 'Lease\CalendarController@destroy')->name('calendar.delete');

// Calender notes routes
Route::get('calendar/notes/{lease}', 'Lease\NoteController@show')->name('calendar.notes');
Route::get('calendar/notes/show/{note}', 'Lease\NoteController@showNote')->name('calendar.notes.show');
Route::get('calendar/notes/new/{lease}', 'Lease\NoteController@create')->name('calendar.notes.create');
Route::get('calendar/notes/delete/{note}', 'Lease\NoteController@destroy')->name('calendar.notes.delete');
Route::get('calendar/notes/edit/{note}', 'Lease\NoteController@edit')->name('calendar.notes.edit');
Route::patch('calendar/notes/edit/{note}', 'Lease\NoteController@update')->name('calendar.notes.update');
Route::post('calendar/notes/new/{lease}', 'Lease\NoteController@store')->name('calendar.notes.store');

// Tenant billing information routes
Route::get('lease/billing/{lease}', 'Lease\BillingController@index')->name('lease.billing');
Route::patch('lease/billing/{lease}', 'Lease\BillingController@update')->name('lease.billing.update');
Route::patch('huurders/facturatie/{user}', 'Lease\Tenants\BillableController@store')->name('tenants.billing.store');
Route::get('huurders/facturatie/{user}', 'Lease\Tenants\BillableController@index')->name('tenants.billing');

// Tenant Routes
Route::get('huurders', 'Lease\Tenants\IndexController@index')->name('tenants.index');
Route::get('huurders/{tenant}', 'Lease\Tenants\IndexController@show')->name('tenants.show');
Route::get('huurders/{tenant}/{status}', 'Lease\Tenants\IndexController@status')->name('tenants.status');
Route::match(['get', 'delete'], 'huurders/verwijder/{tenant}', 'Lease\Tenants\IndexController@destroy')->name('tenants.destroy');

// Helpdesk comment routes
Route::post('helpdesk/{ticket}/reageer', 'Helpdesk\CommentController@store')->name('helpdesk.comment');
Route::get('helpdesk/comment/delete/{comment}', 'Helpdesk\CommentController@destroy')->name('helpdesk.comment.delete');

// Administrator routes
Route::get('admins', 'Users\AdminController@index')->name('admins.index');
Route::get('admins/zoek', 'Users\AdminController@search')->name('admins.search');
Route::match(['get', 'delete'], 'admins/delete/{admin}', 'Users\AdminController@destroy')->name('admins.destroy');
Route::get('admins/delete/{admin}/undo', 'Users\AdminController@undoDeleteRoute')->name('admins.delete.undo');
Route::get('admins/nieuw', 'Users\AdminController@create')->name('admins.create');
Route::post('admins/nieuw', 'Users\AdminController@store')->name('admins.store');
Route::get('admins/profile/{user}', 'Users\AdminController@show')->name('admins.show');
Route::patch('admins/profile/{user}', 'Users\AdminController@update')->name('admins.update');

// Account settings routes
Route::get('/account-settings/{type?}', 'Users\SettingsController@index')->name('account.settings');
Route::patch('/account-settings/security', 'Users\SettingsController@updateSecurity')->name('account.settings.security');
Route::patch('/account-settings/information', 'Users\SettingsController@updateInformation')->name('account.settings.information');
