<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\line;
use App\Acapulco;
use App\Cdmx;
use Auth;


class routes extends Controller
{
    public function profiles()
    {
        return view('profiles');
    }
    
    public function RouteClient()
    {
        $users = DB::table('stock_linea')->get();
        return view('Client',compact('users'));
     }

    public function RouteShop()
    {
        $users = DB::table('stock_cdmx')->get();
        return view('shops',compact('users'));
    }
    public function RouteShopAcapulco()
    {
        $users = DB::table('stock_acapulco')->get();
        return view('shops',compact('users'));
    }

    public function RouteAccounting()
    {
        return view('Accounting');
    }

    public function RouteAdmin()
    {
        return view('Admin');
    }

    public function ViewStock()
    {
        return view('AddStock');
    }
    
    public function fail()
    {
        return view('home');
    }
}
