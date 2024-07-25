<div class="input-group count mt-4 mb-4" style="width: 220px;">
    <div class="input-group-btn">
        <form action="{{ route('cart.update', $item->id) }}" method="POST" >
            @csrf
            @method('PATCH')
            <input type="hidden" name="count" value="{{ $item->count - 1 }}">
            <input type="hidden" name="cart_id" value="{{ $item->id }}">
            <button class="btn btn-sm btn-minus rounded-circle bg-light border" {{ $item->count <= 1 ? 'disabled' : '' }}>
                <i class="fa fa-minus"></i>
            </button>
        </form>
    </div>
    <form action="{{ route('cart.update', $item->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <input type="text" name="count" class="form-control form-control-sm text-center border-0" value="{{ $item->count }}" style="width: 70px;">
        <input type="hidden" name="cart_id" value="{{ $item->id }}">
        <button class="btn btn-primary m-2 rounded-pill" style="width: 100;">Add</button>
    </form>
    <div class="input-group-btn">
        <form action="{{ route('cart.update', $item->id) }}" method="POST" >
            @csrf
            @method('PATCH')
            <input type="hidden" name="count" value="{{ $item->count + 1 }}">
            <input type="hidden" name="cart_id" value="{{ $item->id }}">
            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                <i class="fa fa-plus"></i>
            </button>
        </form>
    </div>
    
</div>
                                    