<form action="{{ route('cart.store') }}" method="POST" style="display: inline;">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="count" value="1">
    <button type="submit" class="btn border border-secondary rounded-pill 
    px-4 py-2 mb-4 text-primary
    @if ($product->hasInCart())
    btn-success
    @endif" ><i class="fa fa-shopping-bag me-2 text-primary">
        </i>{{ $product->hasInCart() ? 'Remove from Cart' : 'Add to Cart' }}</button>
</form>