<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class UsersExport implements FromView
{
    public function view(): View
    {
    //$query = DB::select('select id,name,email,password,email_verified_at from users');
     //$query = DB::select(request()->get('_token'));
     $query = DB::select('select *from pedidos');
     return view('partials.table', compact('query'));

    }
}
