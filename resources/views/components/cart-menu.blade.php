<div class="shopping-item">
    <div class="dropdown-cart-header">
        <span>{{ $items->get()->count() }} Items</span>
        <a href="{{ route('cart.index') }}">View Cart</a>
    </div>
    <ul class="shopping-list">

        @foreach ($items->get() as $item)
        <li>
            <a href="javascript:void(0)" class="remove delete"  data-delete="{{ $item->product->id }}" title="Remove this item"><i
                    class="lni lni-close"></i></a>
            <div class="cart-img-head">
                <a class="cart-img" href="{{ route('product.show',$item->product->id) }}"><img
                        src="{{ $item->product->immage_url }}" alt="#"></a>
            </div>

            <div class="content">
                <h4><a href="{{ route('product.show',$item->product->id) }}">
                        {{ $item->product->name }}</a></h4>
                <p class="quantity">{{ $item->quantity }}x - <span class="amount">${{ $item->quantity * $item->product->price }}</span></p>
            </div>
        </li>
        @endforeach

 
    </ul>
    <div class="bottom">
        <div class="total">
            <span>Total</span>
            <span class="total-amount">${{ $items->total() }}</span>
        </div>
        <div class="button">
            <a href="{{ route('checkOut')   }} " class="btn animate">Checkout</a>
        </div>
    </div>
</div>