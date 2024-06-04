@extends('clients.root.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    <div class="slider-container">
        <div class="slider">

            @foreach ($homepageImages->where('type', 'homepage_slider_img') as $images)
                <div class="slide-item">
                    <a href="javascript: void(0);"><img src="{{ asset('/storage/' . $images->file_name) }}" alt=""></a>
                </div>
            @endforeach

        </div>
        <div class="slogan">
            For mechanical keyboards lovers,<br>
            By mechanical keyboards lovers.
        </div>
    </div>

    <!--------------- SECTION --------------->
    <div class="grid wide section-title-container">
        <h3 class="section-title section-title-center">
            <b></b>
            <span class="section-title-main">DANH MỤC SẢN PHẨM</span>
            <b></b>
        </h3>
    </div>

    <!--------------- PRODUCT CATEGORY --------------->
    <div class="grid wide product-category-container">
        <div class="product-category">

            @foreach ($listCategories as $key)
                <div class="product-category__product">
                    <a href="{{ route('product.category', ['category' => $key->name]) }}">
                        <img src="{{ asset('/storage/' . $key->image) }}" alt="" class="product-category__img">
                        <span class="product-category__name">{{ $key->name }}</span>
                        {{-- <span class="product-category__amount">6 sản phẩm</span> --}}
                    </a>
                </div>
            @endforeach

        </div>
    </div>

    <!--------------- BANNER --------------->
    <div class="grid wide banner-container">
        <img src="{{ asset('/storage/' . $homepageBannerImages[0]->file_name) }}" alt="" class="banner-img">
    </div>

    <!--------------- SECTION --------------->
    <div class="grid wide section-title-container">
        <h3 class="section-title section-title-center">
            <b></b>
            <span class="section-title-main">SẢN PHẨM NỔI BẬT</span>
            <b></b>
        </h3>
    </div>

    <!--------------- HIGHLIGHT PRODUCT --------------->
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
                                <div class="product-item__description--price"> {{ number_format($key->price , 0, '.', ',') }} <span>₫</span></div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>

    <!--------------- BANNER --------------->
    <div class="grid wide banner-container">
        <img src="{{ asset('/storage/' . $homepageBannerImages[1]->file_name) }}" alt="" class="banner-img">
    </div>

    <!--------------- SECTION --------------->
    <div class="grid wide section-title-container">
        <h3 class="section-title section-title-center">
            <b></b>
            <span class="section-title-main">SẢN PHẨM MỚI</span>
            <b></b>
        </h3>
    </div>

    <!--------------- NEW PRODUCT --------------->
    <div class="grid wide product-container">
        <div class="product-container-slider">

            @foreach ($newProducts as $key)
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
                                <div class="product-item__description--price"> {{ number_format($key->price , 0, '.', ',') }} <span>₫</span></div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>

    <!--------------- BANNER --------------->
    <div class="grid wide banner-container">
        <img src="{{ asset('/storage/' . $homepageBannerImages[2]->file_name) }}" alt="" class="banner-img">
    </div>

    <!--------------- SECTION --------------->
    <div class="grid wide section-title-container">
        <h3 class="section-title section-title-center">
            <b></b>
            <span class="section-title-main">THEO DÕI CHÚNG TÔI TRÊN INSTAGRAM</span>
            <b></b>
        </h3>
    </div>

    <!--------------- INSTAGRAM POST --------------->
    <div class="insta-post-slider-container">
        <div class="insta-post-slider">
            @foreach ($homepageImages->where('type', 'homepage_instagram_img') as $images)
                <div class="insta-post-item">
                    <a href="javascript: void(0);"><img src="{{ asset('/storage/' . $images->file_name) }}"
                            alt=""></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
