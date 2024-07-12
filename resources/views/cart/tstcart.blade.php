@extends('layouts.header')

<br>
<br>
<br>

<br>
<br>
<br>

<br>
<br>
<br>

{{-- @section('content') --}}
    <h1>Your Cart</h1>

    @if ($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>{{ $item->product->price }}</td>
                        <td>{{ $item->product->price * $item->quantity }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>Total: {{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }}</p>
    @endif
{{-- @endsection --}}
@extends('layouts.footer')