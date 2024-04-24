<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $userId = Auth::id();

        $userFirstName = DB::table('managements')
        ->pluck('first_name')
        ->first();

        $userLastName = DB::table('managements')
        ->pluck('last_name')
        ->first();

        $userRole = DB::table('managements')
        ->pluck('role')
        ->first();

        return view('homepage', compact('userFirstName','userLastName','userRole'));
    }
}