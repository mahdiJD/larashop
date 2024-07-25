<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use Illuminate\Contracts\View\View;
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
        // dd(auth()->user()->role);
        if (auth()->user()->role === Role::admin) {
            return view('admin-panel.index');
        }
        return view('home');
    }
}
