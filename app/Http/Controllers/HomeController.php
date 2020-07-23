<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Client');
    }

    // public function Query(Request $request)
    // {
    //     $request->flash();
    //     $token = $request->get('_token');
    //     $query = DB::select('SELECT * FROM users');
    //     if ($request->get('_token') !=== NULL) {
    //         try {
    //             $results = DB::select($query);
    //             return view('views', compact('results'));
    //         } catch (\Illuminate\Database\QueryException $ex) {
    //             return back()->withErrors(['db' => $ex->getMessage()]);
    //         }

    // public function exportDocument()
    // {
    //     return Excel::download(new UsersExport, 'datos.xlsx');
    // }
}
