<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\line;
use App\Venta;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("productos", function () {
    return response()->json(line::all());
});

Route::get("/producto/{id}", function($id){
    $producto = line::findOrFail($id);
    return response()->json($producto);
});
Route::put("/producto", function(Request $request){
    $producto = line::findOrFail($request->input("id"));
    $producto->fill($request->input());
    $producto->saveOrFail();
    return response()->json(true);
});
Route::delete("/producto/{id}", function($id){
    $producto = line::findOrFail($id);
    $producto->delete();
    return response()->json(true);
});


// Route::get("ventas", function () {
//     return response()->json(Venta::with(["productos", "cliente"])->get());
// });
// Route::post("/venta", function(Request $request){
//     $venta = new Venta($request->input());
//     $venta->saveOrFail();
//     return response()->json(["data" => "true"]);
// });
// Route::get("/venta/{id}", function($id){
//     $venta = Venta::with(["productos", "cliente"])->findOrFail($id);
//     return response()->json($venta);
// });
// Route::delete("/venta/{id}", function($id){
//     $venta = Venta::findOrFail($id);
//     $venta->delete();
//     return response()->json(true);
//});