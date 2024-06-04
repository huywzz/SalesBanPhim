@extends('clients.root.master')

@section('title')
    Shop
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/paginate.css') }}">
@endpush

@section('content')
    <div class="shop-container">
        <div class="grid wide shop">

            <!-- shop title  -->
            <div class="shop-header">
                <div class="shop__home">
                    <a class="shop__home--home-page" href="{{ route('root') }}">Trang chủ</a>
                    <span>/</span>
                    <a class="shop__home--current-page" href="{{ route('products.list') }}">Shop</a>
                </div>

                <div class="shop__sort--quantity">Hiển thị <strong>{{ $listProduct->firstItem() }}</strong> - <strong>{{ $listProduct->lastItem() }}</strong> của <strong>{{ $listProduct->total() }}</strong> sản phẩm</div>
                {{-- <div class="shop__sort">
                    <select class="shop__sort--select" name="sort" id="sort">
                        <option value="1">Thứ tự mặc định</option>
                        <option value="2">Thứ tự theo mức độ phổ biến</option>
                        <option value="3">Thứ tự theo điểm đánh giá</option>
                        <option value="4">Mới nhất</option>
                        <option value="5">Thứ tự theo giá: thấp đến cao</option>
                        <option value="6">Thứ tự theo giá: cao đến thấp</option>
                    </select>
                </div> --}}
            </div>


            <div class="row shop-main">
                @include('clients.layout.sidebar')

                <div class="col l-9 shop__product">
                    <div class="row shop__product--container">

                        @foreach ($listProduct as $key)
                            <div class="col l-4 product-item-container">
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
                                            <div class="product-item__description--price"> {{ number_format($key->price , 0, '.', ',') }} <span>₫</span></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>

                    {{ $listProduct->withQueryString()->links() }}
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

