<div class="modal js-modal">
    <div class="cart-container js-cart-container">
        <div class="cart-header">
            <h1>Giỏ hàng</h1>
            <div class="cart-close js-cart-close">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>

        <div class="cart-body" id="cart_products">
            @if (session()->get('cart') != null)
                @foreach (session()->get('cart') as $key)
                    <div class="cart-product">
                        <img class="cart-product__img" src="{{ Storage::url($key['product_image']) }}" alt="">
                        <div class="cart-product__description">
                            <div class="cart-product__description--name">{{ $key['name'] }}</div>

                            <div class="cart-product__description--price">
                                <strong>{{ number_format($key['price'], 0, '.', ',') }}</strong><span>VND</span>
                                {{-- {{ $key['price'] }} --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p style="color: white">Không có gì trong giỏ hàng</p>
            @endif

        </div>

        <div class="cart-footer">

            <div class="page-cart-btn">
                <button type="submit" name="checkout"><a href="{{ route('cart.show') }}">Xem giỏ hàng</a></button>
            </div>

            <div class="cart-checkout-btn">
                <button type="submit" class="cart-checkout-btn--btn" name="checkout"><a
                        href="{{ route('checkoutForm') }}">Thanh toán</a></button>
            </div>
        </div>

    </div>
</div>
