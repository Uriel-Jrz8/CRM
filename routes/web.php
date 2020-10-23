<?php

use App\Http\Controllers\MainController;
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
Route::put('/Update/price','MainController@UpdatePrecio')->name('UpdatePrecio');
Route::put('/NewAdd/Stock','MainController@NewAddstock')->name('NewAddstock');
Route::put('/import','MainController@import')->name('import');
Route::put('/downloadEcxel', 'MainController@exportDocument')->name('export');
Route::put('/discount','MainController@Discount')->name('descuento');
Route::get('/search','MainController@search')->name('search')->middleware('auth');
Route::get('/search/cdmx','MainController@searchCDMX')->name('searchCDMX')->middleware('auth');
Route::get('/search/linea','MainController@searchLINEA')->name('searchLINEA')->middleware('auth');
Route::put('/delete','MainController@Delete')->name('Delete');

//Rutas Para vizualizar los Datos que se encuentran de la BD ViewData
Route::get('/stock/Shops/linea','ViewData@stocklinea')->name('stocklinea')->middleware('auth');
Route::get('/stock/Shops/cdmx','ViewData@stockcdmx')->name('stockcdmx')->middleware('auth');
Route::get('/stock/Add/acapulco','ViewData@stockacapulco')->name('stockacapulco')->middleware('auth'); 
Route::get('/stock/store/house','ViewData@storehouse')->name('storehouse')->middleware('auth');
Route::get('/stock/store/house/inputs','ViewData@salidas')->name('Salidas')->middleware('auth'); 
Route::get('/stock/store/house/outputs','ViewData@entradas')->name('Entradas')->middleware('auth'); 
Route::get('/stock/store/house/entradas','ViewData@filtroEntradas')->name('filtroEntradas')->middleware('auth');
Route::get('/stock/store/house/salidas','ViewData@filtroSalidas')->name('filtroSalidas')->middleware('auth');

//Rutas para rediccionar a la hora de validar ROUTES
Route::get('/profiles', 'routes@profiles')->name('profiles');
Route::get('/Accounting', 'routes@RouteAccounting')->name('AccountingMerkado')->middleware('auth');
Route::get('/Admin/Merkado/Croqueta', 'routes@RouteAdmin')->name('Admin')->middleware('auth');
Route::get('/Admin/Stock', 'routes@ViewStock')->name('AdminStock')->middleware('auth');
Route::get('/fail','routes@fail')->name('fail');

//PDF pendiente
Route::put('/downloadPDF', 'PDFController@downloadPDF')->name('PDF');
//Actualizar pedido status de linea Pendiente
//Route::get('/update/orders', 'newlogin@update')->name('update');
Route::get('/ordersLine','MainController@index')->middleware('auth');


//Proceso Venta linea
Route::get('/customer/service', 'routes@RouteClient')->name('service')->middleware('auth');
Route::delete('/productoDeVenta', 'routes@quitarProductoDeVenta')->name('quitarProductoDeVenta');
Route::put('/productoDeVenta', 'routes@agregarProductoVenta')->name('agregarProductoVenta');
Route::put('/terminarOCancelarVenta', 'routes@terminarOCancelarVenta')->name('terminarOCancelarVenta');
Route::put('/online/ordering','ViewData@ConsultData')->name('ConsultDato');
Route::put('Informacion', 'ViewData@DetalleLinea')->name('DetalleLinea');
Route::get('/date/line','ViewData@ConsultData')->name('Dateline')->middleware('auth');

//Proceso Venta CDMX
Route::get('/shop/cdmx', 'VentasCdmx@RouteShop')->name('cdmx')->middleware('auth');
Route::delete('/productoDeVentaCdmx', 'VentasCdmx@quitarProductoDeVenta')->name('quitarProductoDeVentaCdmx');
Route::put('/productoDeVentaCdmx', 'VentasCdmx@agregarProductoVenta')->name('agregarProductoVentaCdmx');
Route::put('/productoDeVentasCdmx', 'VentasCdmx@CambioCdmx')->name('CambioCdmx');
Route::put('/terminarOCancelarVentaCdmx', 'VentasCdmx@terminarOCancelarVenta')->name('terminarOCancelarVentaCdmx');
Route::put('/orders/cdmx','ViewData@ConsultCDMX')->name('ConsultCDMX');
Route::put('InformacionCdmx', 'ViewData@DetalleCdmx')->name('DetalleCdmx');
Route::get('/date/cdmx','ViewData@ConsultCDMX')->name('DateCdmx')->middleware('auth');

//Proceso Venta Acapulco
Route::get('/shop/acapulco', 'VentasAcapulco@RouteShopAcapulco')->name('Acapulco')->middleware('auth');
Route::delete('/productoDeVentaAcapulco', 'VentasAcapulco@quitarProductoDeVenta')->name('quitarProductoDeVentaAcapulco');
Route::put('/productoDeVentaAcapulco', 'VentasAcapulco@agregarProductoVenta')->name('agregarProductoVentaAcapulco');
Route::put('/terminarOCancelarVentaAcapulco', 'VentasAcapulco@terminarOCancelarVenta')->name('terminarOCancelarVentaAcapulco');
Route::put('/orders/Acapulco','ViewData@ConsultAcapulco')->name('ConsultAcapulco');
Route::put('InformacionAcapulco', 'ViewData@DetalleAcapulco')->name('DetalleAcapulco');
Route::get('/date/acapulco','ViewData@ConsultAcapulco')->name('DateAcapulco')->middleware('auth');
Route::put('/orders/acapulco','ViewData@ConsultAcapulco')->name('ConsultAcapulco');