@foreach ($cartItems as $item)
<tr>
    <th scope="row">
        <div class="d-flex align-items-center mt-2">
            <img src="{{ $item->product->fileURL() }}" 
            class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
        </div>
    </th>
    <td class="py-5">{{ $item->product->name }}</td>
    <td class="py-5">${{ $item->product->price }}</td>
    <td class="py-5">{{ $item->count }}</td>
    <td class="py-5">${{ $item->count * $item->product->price }}</td>
</tr>
@endforeach

<tr>
    <th scope="row">
    </th>
    <td class="py-5"></td>
    <td class="py-5"></td>
    <td class="py-5">
        <p class="mb-0 text-dark py-3">Subtotal</p>
    </td>
    <td class="py-5">
        <div class="py-3 border-bottom border-top">
            <p class="mb-0 text-dark">${{ $subtotal }}</p>
        </div>
    </td>
</tr>