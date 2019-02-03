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

// Tenant billing information routes
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

// Account settings routes
Route::get('/account-settings/{type?}', 'Users\SettingsController@index')->name('account.settings');
Route::patch('/account-settings/security', 'Users\SettingsController@updateSecurity')->name('account.settings.security');
Route::patch('/account-settings/information', 'Users\SettingsController@updateInformation')->name('account.settings.information');
