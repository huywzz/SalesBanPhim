@extends('clients.root.master')
@section('content')
    <div class="grid wide product-container">

        <div class="row product-main">
            <div class="col l-6 product-gallery">

                <div class="slider-for">
                    @foreach ($product->ProductImages->where('type', 'product_slider_img') as $images)
                        <div>
                            <img src="{{ asset('/storage/' . $images->file_name) }}" alt="">
                        </div>
                    @endforeach
                </div>

                <div class="slider-nav">
                    @foreach ($product->ProductImages->where('type', 'product_slider_img') as $images)
                        <div class="product-img-nav">
                            <img src="{{ asset('/storage/' . $images->file_name) }}" alt="">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col l-6 product-info-container">
                <div class="product-info">

                    <div class="product-info__nav">
                        <a href="{{ route('root') }}">Trang chủ</a>
                        <span>/</span>
                        <a href="">{{ $product->category_name }}</a>
                    </div>
                    <div class="product-info__name">{{ $product->name }}</div>
                    <hr class="hr-3">
                    <div class="price">
                        {{-- <span>Giá: </span> --}}
                        <div class="product-info__price">{{ number_format($product->price, 0, '.', ',') }}</div>
                        <span>VND</span>
                    </div>

                    <form method="post" action="{{ route('cart.add') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}" id="id">
                        <input type="hidden" name="product_name" value="{{ $product->name }}" id="name">
                        <input type="hidden" name="product_price" value="{{ $product->price }}" id="price">
                        <input type="hidden" name="product_image"
                            value="{{ $product->ProductImages->where('type', 'product_avatar_img')[0]->file_name }}"
                            id="image">

                        @if ($product->status == 'Hết hàng')
                            <div class="product-info__status">
                                <span>{{ $product->status }}</span>
                            </div>
                        @endif

                        @if ($product->status == 'Còn hàng')
                            <div class="product-info__quantity">
                                <p>Còn <strong>{{ $product->quantity }}</strong> sản phẩm</p>
                            </div>
                            <div class="product-info__btn-cart">
                                <button type="button" class="add-to-cart btn-cart">Thêm vào giỏ hàng</button>
                            </div>
                        @endif



                        {{-- <div class="product-info__btn-buy">
                            <button class="btn-buy">Mua ngay</button>
                        </div> --}}

                    </form>
                </div>

            </div>


        </div>

        <div class="product-footer">
            <div class="product-description">
                @foreach ($product->ProductImages->where('type', 'product_description_img') as $images)
                    <img src="{{ asset('/storage/' . $images->file_name) }}" alt="">
                @endforeach
            </div>
            <div class="product-specification">
                {!! $product->specs !!}
            </div>
            <div class="product-related">
                <h3 style="margin-top: 50px;">SẢN PHẨM BÁN CHẠY NHẤT</h3>
                <div class="grid wide product-container">
                    <div class="product-container-slider">

                        @foreach ($topProducts as $key)
                            <div class="product-container-item">
                                <a href="{{ route('products.show', ['product' => $key['id']]) }}">
                                    <div class="product-item">
                                        <div class="product-item__img">
                                            <img src="{{ asset('/storage/' . $key->ProductImages->where('type', 'product_avatar_img')[0]->file_name) }}"
                                                alt="" class="product-item__img--img">
                                            <img src="{{ asset('/storage/' . $key->ProductImages->where('type', 'product_avatar_img')[1]->file_name) }}"
                                                alt="" class="product-item__img--img img-2">
                                        </div>
                                        <div class="product-item__description">
                                            <div class="product-item__description--category"> {{ $key->category_name }}
                                            </div>
                                            <div class="product-item__description--name"> {{ $key->name }} </div>
                                            <div class="product-item__description--price">
                                                {{ number_format($key->price, 0, '.', ',') }} <span>₫</span></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $(document).ready(function() {
                $('.add-to-cart').click(function() {
                    let form = $(this).parents('form');
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('cart.add') }}',
                        data: form.serialize(),
                        success: function(data) {
                            // alert('Đã thêm sản phẩm vào giỏ hàng!');
                            toastr.success('Đã thêm sản phẩm vào giỏ hàng!')
                            $('#cart_products').empty();
                            $('#cart_products').html(data);
                        },
                        error: function() {
                            // console.log("error");
                            toastr.error('Lỗi, hãy thử lại!');
                        }
                    });
                });
            });
        });
    </script>
@endpush
