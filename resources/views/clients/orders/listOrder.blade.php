@extends('clients.root.master')

@section('content')

    <div class="grid wide cart-page-container">
        <div class="title">Đơn hàng</div>

        <div class="content">
            <div class="cart-page">
                <table style="width: 100%;" class="table-cart-page">
                    <thead style="height: 40px; border-bottom: 1px solid #000;">
                        <tr>
                            <th style="width: 15%;">Mã đơn hàng</th>
                            <th style="width: 20%;">Tổng tiền</th>
                            <th style="width: 20%;">Trạng thái</th>
                            <th style="width: 45%;">Địa chỉ</th>
                            {{-- <th style="width: 10%;"></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($orders))
                            @foreach ($orders as $key)
                                <tr>
                                    <td><a href="{{ route('order.detail', ['order' => $key->id]) }}">{{ $key->id }}</a>
                                    </td>
                                    <td><strong>{{ number_format($key->order_total, 0, '.', ',') }}</strong></td>
                                    <td>{{ $key->getStatus() }}</td>
                                    <td>{{ $key->order_address }}</td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>

                <div class="grid wide product-container">
                    <h3 style="margin-top: 100px;">SẢN PHẨM TƯƠNG TỰ</h3>

                    <div class="product-container-slider">
                        @if (isset($productRecommend))

                            @foreach ($productRecommend as $key)
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

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
