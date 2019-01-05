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
Route::get('/werkpunten/{lokaal}/index', 'Lokalen\WerkpuntenController@index')->name('werkpunten.index');
Route::get('/werkpunten/create', 'Lokalen\WerkpuntenController@create')->name('werkpunten.create');
Route::post('/werkpunten/create', 'Lokalen\WerkpuntenController@store')->name('werkpunten.store');

// Lokalen routes
Route::get('/lokalen', 'Lokalen\IndexController@index')->name('lokalen.index');
Route::get('/lokalen/nieuw', 'Lokalen\IndexController@create')->name('lokalen.create');
Route::post('/lokalen/nieuw', 'Lokalen\IndexController@store')->name('lokalen.store');
Route::match(['get', 'delete'], '/lokalen/verwijder/{lokaal}', 'Lokalen\IndexController@destroy')->name('lokalen.delete');

// Activity log routes 
Route::get('logs/{user}', 'Users\ActivityController@show')->name('activity.user');

// Helpdesk routes
Route::get('helpdesk/huurder', 'Helpdesk\DashboardController@huurder')->name('helpdesk.index.huurder');
Route::get('helpdesk/mijn-vragen', 'Helpdesk\TenantController@index')->name('helpdesk.overview.user');
Route::post('helpdesk/ticket', 'Helpdesk\SharedController@store')->name('helpdesk.ticket.store');

// Administrator routes
Route::get('admins', 'Users\AdminController@index')->name('admins.index');
Route::match(['get', 'delete'], 'admins/delete/{admin}', 'Users\AdminController@destroy')->name('admins.destroy');
Route::get('admins/delete/{admin}/undo', 'Users\AdminController@undoDeleteRoute')->name('admins.delete.undo');
Route::get('admins/nieuw', 'Users\AdminController@create')->name('admins.create');
Route::get('admins/profile/{user}', 'Users\AdminController@show')->name('admins.show');

// Account settings routes 
Route::get('/account-settings/{type?}', 'Users\SettingsController@index')->name('account.settings');
Route::patch('/account-settings/security', 'Users\SettingsController@updateSecurity')->name('account.settings.security');
Route::patch('/account-settings/information', 'Users\SettingsController@updateInformation')->name('account.settings.information');