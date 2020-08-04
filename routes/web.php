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
    return view('AddStock');
});

Auth::routes();

Route::put('login','Auth\LoginController@Login')->name('login');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/iniciar','newlogin@Login')->name('inicio');
Route::put('/online/ordering','newlogin@ConsultData')->name('ConsultDato');
Route::put('/orders/cdmx','newlogin@ConsultCDMX')->name('ConsultCDMX');
Route::put('/orders/acapulco','newlogin@ConsultAcapulco')->name('ConsultAcapulco');
Route::put('/downloadEcxel', 'newlogin@exportDocument')->name('export');
Route::put('/downloadPDF', 'PDFController@downloadPDF')->name('PDF');
Route::get('/profiles', 'newlogin@profiles')->name('profiles');
Route::put('/Add/line','newlogin@addOders')->name('Addline');
Route::put('/Add/Shops','newlogin@addShops')->name('AddShops');
Route::put('/stock/Shops/cdmx','newlogin@stockcdmx')->name('stockcdmx');
Route::put('/stock/Add/Shops','newlogin@stockacapulco')->name('stockacapulco');
Route::get('/Admin/Stock', 'newlogin@ViewStock')->name('AdminStock');
Route::get('/update/orders', 'newlogin@update')->name('update');

//Rutas para rediccionar a la hora de validar
Route::get('/customer/service', 'newlogin@RouteClient')->name('service');
Route::get('/shop/cdmx', 'newlogin@RouteShop')->name('cdmx');
Route::get('/shop/acapulco', 'newlogin@RouteShopAcapulco')->name('Acapulco');
Route::get('/Accounting', 'newlogin@RouteAccounting')->name('AccountingMerkado');
Route::get('/Admin/Merkado/Croqueta', 'newlogin@RouteAdmin')->name('Admin');
Route::get('/fail','newlogin@fail')->name('fail');

Route::put('/AddStock','newlogin@addstock')->name('addstock');
Route::put('/import','newlogin@import')->name('import');

