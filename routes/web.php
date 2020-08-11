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

// Laravel
Auth::routes();
Route::put('login','Auth\LoginController@Login')->name('login');
Route::get('/home', 'HomeController@index')->name('home');

//Principales del Sistema
Route::put('/Add/line','MainController@addOders')->name('Addline');
Route::put('/Add/Shops','MainController@addShops')->name('AddShops');
Route::put('/Update/Stock','MainController@UpdateStock')->name('UpdateStock');
Route::put('/NewAdd/Stock','MainController@NewAddstock')->name('NewAddstock');
Route::put('/import','MainController@import')->name('import');
Route::put('/downloadEcxel', 'MainController@exportDocument')->name('export');

//Rutas Para vizualizar los Datos que se encuentran de la BD ViewData
Route::put('/online/ordering','ViewData@ConsultData')->name('ConsultDato');
Route::put('/orders/cdmx','ViewData@ConsultCDMX')->name('ConsultCDMX');
Route::put('/orders/acapulco','ViewData@ConsultAcapulco')->name('ConsultAcapulco');
Route::put('/stock/Shops/cdmx','ViewData@stockcdmx')->name('stockcdmx');
Route::put('/stock/Add/Shops','ViewData@stockacapulco')->name('stockacapulco'); 

//Rutas para rediccionar a la hora de validar ROUTES
Route::get('/customer/service', 'routes@RouteClient')->name('service');
Route::get('/profiles', 'routes@profiles')->name('profiles');
Route::get('/shop/cdmx', 'routes@RouteShop')->name('cdmx');
Route::get('/shop/acapulco', 'routes@RouteShopAcapulco')->name('Acapulco');
Route::get('/Accounting', 'routes@RouteAccounting')->name('AccountingMerkado');
Route::get('/Admin/Merkado/Croqueta', 'routes@RouteAdmin')->name('Admin');
Route::get('/Admin/Stock', 'routes@ViewStock')->name('AdminStock');
Route::get('/fail','routes@fail')->name('fail');

//PDF pendiente
Route::put('/downloadPDF', 'PDFController@downloadPDF')->name('PDF');
//Actualizar pedido status de linea Pendiente
//Route::get('/update/orders', 'newlogin@update')->name('update');
Route::get('/ordersLine','MainController@index');