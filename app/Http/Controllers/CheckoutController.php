<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

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
        return view('checkout.checkout', compact('cartItems','subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required|string|max:255',
            'oreder_notes' => 'nullable',
        ]);

        if( auth()->user()->city !== $request->city &&
            auth()->user()->country !== $request->country){
                User::where('id',auth()->user()->id)->update([
                    'city' => $request->city,
                    'country' => $request->country
                ]);
        }

        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $subtotal = $this->totalPrice($cartItems);

        $order = Order::create([
            'user_id' => auth()->id(),
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total' => $subtotal,
        ]);

        foreach (Cart::where('user_id', auth()->id())->get() as $cartItem) {
            // dd($cartItem->count);
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