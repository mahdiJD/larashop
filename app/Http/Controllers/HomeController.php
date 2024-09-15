<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected $perPage=15)
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
        if (auth()->user()->role === Role::admin || auth()->user()->role === Role::root) {
            $order = Order::where('order_status', false )->latest()->take(5)->get();
            return view('admin.home',compact('order'));
        }
        $order = Order::where('user_id',auth()->user()->id)->get();
        
        return view('home.home' ,compact('order',));
    }

    public function orderHistory(){
        if (auth()->user()->role === Role::admin || auth()->user()->role === Role::root) {
            $order = Order::published()
            ->latest()
            ->paginate($this->perPage)
            -> WithQueryString();;    
            return view('admin.index',compact('order',));
        }
        $order = Order::where('user_id',auth()->user()->id)->get();
        
        return view('home.home' ,compact('order',));
    }
}
