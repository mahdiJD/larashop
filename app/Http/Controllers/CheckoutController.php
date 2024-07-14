<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function totalPrice($cartItems, $Price = 0 ){
        foreach($cartItems as $cartItem){
            $Price += $cartItem->count * $cartItem->product->price ;
        }
        return $Price;
    }

    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $subtotal = $this->totalPrice($cartItems);
        return view('checkout', compact('cartItems','subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            // 'payment_method' => 'required|string|max:255',
        ]);

        $order = Order::create([
            'user_id' => auth()->id(),
            'address' => $request->address,
            // 'payment_method' => $request->payment_method,
            'total' => Cart::where('user_id', auth()->id())->sum(\DB::raw('count * price')),
        ]);

        foreach (Cart::where('user_id', auth()->id())->get() as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'count' => $cartItem->count,
                'price' => $cartItem->product->price,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}