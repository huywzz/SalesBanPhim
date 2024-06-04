{{-- <div class="col l-3 shop__category">
    <div class="shop__category--title">
        Danh mục sản phẩm
    </div>
    <hr>

    <div class="shop__category--list">
        <ul>
            @foreach ($categories as $key)
                <li class="category-list__item b-b-100">
                    <a href=""> {{ $key->name }} </a>
                </li>
            @endforeach
        </ul>
    </div>
</div> --}}

<div class="col l-3 shop-sidebar-filter">
    <div class="filter-widget">
        <div class="fw-title">
            Danh mục sản phẩm
        </div>

        <div class="filter-categories">
            <ul>
                @foreach ($categories as $key)
                    <li class="category-list__item b-b-100">
                        <a href="{{ route('product.category', ['category' => $key->name]) }}"> {{ $key->name }} </a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

    <div class="filter-widget">
        <h4 class="fw-title">Giá</h4>
        <form action="{{ route('products.filter-price') }}" method="GET" enctype="multipart/form-data">
            <div class="filter-range-wrap">
                <div class="range-slider">
                    <div class="price-input">
                        <input type="text" id="minamount" name="price_min">
                        <span>-</span>
                        <input type="text" id="maxamount" name="price_max">
                    </div>
                </div>
                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                    data-min="0" data-max="10000000" data-min-value="{{ str_replace(' ₫', '', request('price_min')) }}"
                    data-max-value="{{ str_replace(' ₫', '', request('price_max')) }}">
                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                </div>
            </div>

            <button type="submit" class="filter-btn">Tìm</button>
        </form>
    </div>
</div>
