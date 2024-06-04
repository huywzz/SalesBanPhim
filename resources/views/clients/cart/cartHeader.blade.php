@if (session()->get('cart') != null)
    @foreach (session()->get('cart') as $key)
        <div class="cart-product">
            <img class="cart-product__img" src="{{ Storage::url($key['product_image']) }}" alt="">
            <div class="cart-product__description">
                <div class="cart-product__description--name"> {{ $key['name'] }} </div>

                <div class="cart-product__description--price">

                    <strong>{{number_format($key['price'], 0, '.', ',')}}</strong><span> VND</span>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p style="color: white">Không có gì trong giỏ hàng</p>
@endif

