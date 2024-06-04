<header>
    <div id="header" class="grid wide">
        <div class="logo">
            <a href=" {{ route('root') }} "><img src="{{ asset('img/logo/Logo_1.png') }}" alt="logo"></a>
        </div>

        <div class="navigation">
            <div class="nav-left">
                <div class="nav nav--product">
                    <a href=" {{ route('products.list') }} ">Sản phẩm<i class="icon-nav fa-solid fa-caret-down"></i></a>
                    <hr>
                    <div class="product__list">
                        <ul>
                            @foreach ($categories as $key)
                                <li><a href="{{ route('product.category', ['category' => $key->name]) }}">
                                        {{ $key->name }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="nav nav--support">
                    <a href="{{ route('support') }}">Hỗ trợ</a>
                    <hr>
                </div>
                <div class="nav nav--blog">
                    <a href="javascript: void(0);">Bài viết</a>
                    <hr>
                </div>
                <div class="nav nav--news">
                    <a href="{{ route('news.newsClient') }}">Tin tức</a>
                    <hr>
                </div>
                <div class="nav nav--contact">
                    <a href="{{ route('contact.contactClient') }}">Liên hệ</a>
                    <hr>
                </div>
            </div>
            <div class="nav-right">
                <div class="nav nav--search">
                    <a href="#"><img style="width: 20px;" src="{{ asset('img/icon_header/search.png') }}"
                            alt=""></a>
                    <hr>
                    <div class="nav__search">
                        <div class="nav__search-input-icon">
                            <input type="text" name="search" id="keywords" placeholder="Tìm kiếm...">
                            <i class="search__icon fa-solid fa-magnifying-glass"></i>
                        </div>
                        
                        <div id="auto-search">
                            
                        </div>
                    </div>
                </div>

                <div class="nav nav--cart js-cart-btn">
                    <img style="width: 20px;" src="{{ asset('img/icon_header/cart.png') }}" alt="">
                    <hr>
                </div>
                
                @if (session()->get('level') === 0)
                    <div class="user-name">
                        <p>{{ $user->name }}</p>
                    </div>
                @endif
                @if (session()->get('level') === 1)
                    <div class="user-name">
                        <p>{{ $user->name }}</p>
                    </div>
                @endif
                <div class="nav nav--info">
                    <a href="#">
                        @if (session()->get('level') === 0)
                            <img class="user-avatar-header" src="{{ asset('/storage/' . $user->avatar) }}"
                                alt="">
                        @endif
                        @if (session()->get('level') === 1)
                            <img class="user-avatar-header" src="{{ asset('/storage/' . $user->avatar) }}"
                                alt="">
                        @endif
                        @if (!session()->has('level'))
                            <img class="" style="width: 20px;" src="{{ asset('img/icon_header/user.png') }}"
                                alt="">
                        @endif
                    </a>
                    <hr>
                    <div class="nav__info">
                        @if (session()->get('level') === 0)
                            <ul>
                                <li><a href="{{ route('homepage.index') }}">Trang quản trị</a></li>
                                <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                            </ul>
                        @endif
                        @if (session()->get('level') === 1)
                            <ul>
                                <li>
                                    <a href="{{ route('personal-infor') }}">Thông tin cá nhân</a>
                                </li>
                                <li>
                                    <a href="{{ route('listOrder') }}">Đơn hàng</a>
                                </li>
                                <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                            </ul>
                        @endif
                        @if (!session()->has('level'))
                            <ul>
                                <li><a href="{{ route('login') }}">Đăng nhập</a><br></li>
                                <li> <a href="{{ route('register') }}">Đăng kí</a><br></li>
                            </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--------------- CART --------------->
    @include('clients.cart.cart')
</header>
