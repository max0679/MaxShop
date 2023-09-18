<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin;
//use App\Http\Controllers;
/*
    Урок 6 теории
    Регулярные выражения для параметров URI (id, alias и т.д.) описываются в RouteServiceProvider->boot
    В URI прописываются в {}. Вопрос говорит о том, что параметр не обязателен
    Например '/catalog/{id}/{alias?}'
*/


// посмотреть про view composer

Route::get('/', 'HomeController@index')->name('home');
Route::get('/category/{alias}', 'HomeController@singleCategory')->name('single_category');
Route::get('/product/{alias}', 'HomeController@singleProduct')->name('single_product');
Route::get('/products', 'HomeController@allProducts')->name('all_products');

Route::get('/search', 'SearchController@index')->name('search');
/*
    Группировка по:
        1) prefix - общей части в URI
        2) namespace - пространства имен Контроллеров
        3) name - общей части имени маршрута (route('admin.<имя маршрута>'))
*/
// php artisan route:list --path=admin/cat

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => 'admin'], function(){

    Route::match(['get', 'post'], '/ajax/{alias}', 'AjaxController@index'); // для асихнхронных запросов

    Route::get('/', 'MainController@index')->name('admin.index');

    Route::resource('/categories', 'CategoryController', ['parameters' => [
        'categories' => 'id'
    ]]);

    Route::resource('/stock_statuses', 'StockStatusController', ['parameters' => [
        'stock_statuses' => 'id'
    ]]);

    Route::resource('/countries', 'CountryController', ['parameters' => [
        'countries' => 'id'
    ]]);

    Route::resource('/manufacturers', 'ManufacturerController', ['parameters' => [
        'manufacturers' => 'id'
    ]]);

    Route::resource('/products', 'ProductController', ['parameters' => [
        'products' => 'id'
    ]]);


    Route::get('/{alias}/property_descriptions', 'PropertyDescriptionController@index')->name('property_descriptions');
    Route::get('/{alias}/property_descriptions/create', 'PropertyDescriptionController@create')->name('property_descriptions.create');
    Route::post('/{alias}/property_descriptions', 'PropertyDescriptionController@store')->name('property_descriptions.store');
    Route::get('/{alias}/property_descriptions/{id}/edit', 'PropertyDescriptionController@edit')->name('property_descriptions.edit');
    Route::put('/{alias}/property_descriptions/{id}', 'PropertyDescriptionController@update')->name('property_descriptions.update');
    Route::delete('/{alias}/property_descriptions/{id}', 'PropertyDescriptionController@destroy')->name('property_descriptions.destroy');


});

Route::group(['middleware' => 'guest'], function() {
    //Route::get('/registration', 'UserController@create')->name('registration.create');
    Route::post('/registration', 'UserController@store')->name('registration.store');
    //Route::get('/login', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login');
});

Route::get('/test', 'TestController@index')->name('test');


Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', 'UserController@logout')->name('logout');
});

/*
    1 случай - Все несуществующие URI перенаправлять по маршруту с именем home (главная страница)
    2 случай - Вызов функции с кодом ошибки, сообщением. Будет подключена страница resources/views/errors/<код ошибки>
*/
Route::fallback(function (){
    // return redirect()->route('home');
    abort(404, 'Страница не найдена');
});





