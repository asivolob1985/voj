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

Route::group(['prefix' => 'admin'], function () {
    Route::get('pages/geturl','PagesController@geturl')->name('pages.geturl');
    Voyager::routes();
});

//Route::get('test', 'TestController');

Route::get('/', 'MainController@index')->name('main_page');//главная страница
//проекты//
Route::get('projects/{alias?}', 'ProjectsController@index')->name('projects');
// формы //
Route::get('form', 'FormController@order')->name('form.order');
//услуга создание сайтов
Route::get('create_sites', 'ServiceController@create_sites')->name('create_sites');
//услуга поддержка
Route::get('support', 'ServiceController@support')->name('support');
//обычные страницы//
Route::get('{alias}', 'PagesController@index')->where('alias', '([А-Яа-яA-Za-z0-9_\-\/]+)')->name('page');