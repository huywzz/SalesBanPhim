<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <!-- LOGO -->
    <a href="{{ route('root') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img style="width: 75%; margin-left: -20px;" src=" {{ asset('img/logo/Logo_2.png') }} " alt="Logo">
        </span>
    </a>

    <div class="h-100 mt-2" id="left-side-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="metismenu side-nav">

            <li class="side-nav-item">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="fa-solid fa-users-gear"></i>
                    <span>Trang quản lý</span>
                    <i style="padding: 0 5px" class="fa-solid fa-chevron-down"></i>
                </a>
                <ul class="sidebar-admin side-nav-second-level" aria-expanded="false">
                    <li data-namePage='homepage'>
                        <a href="{{ route('homepage.index') }}"><i class="fa-solid fa-house"></i>Trang chủ</a>
                    </li>
                    <li data-namePage='users'>
                        <a href="{{ route('users.index') }}"><i class="fa-solid fa-user"></i>Người dùng</a>
                    </li>
                    <li data-namePage='products'>
                        <a href="{{ route('products.index') }}"><i class="fa-solid fa-keyboard"></i>Sản phẩm</a>
                    </li>
                    <li data-namePage='categories'>
                        <a href="{{ route('categories.index') }}"><i class="fa-solid fa-list"></i>Danh mục</a>
                    </li>
                    <li data-namePage='manufactures'>
                        <a href="{{ route('manufactures.index') }}"><i class="fa-solid fa-industry"></i>Nhà sản xuất</a>
                    </li>
                    <li data-namePage='orders'>
                        <a href="{{ route('orders.index') }}"><i class="fa-solid fa-clipboard-list"></i>Đơn hàng</a>
                    </li>
                    <li data-namePage='promotion'>
                        <a href="{{ route('promotion.index') }}"><i class="fa-solid fa-sack-dollar"></i>Khuyến mãi</a>
                    </li>
                    <li data-namePage='news'>
                        <a href="{{ route('news.index') }}"><i class="fa-solid fa-newspaper"></i>Tin tức</a>
                    </li>
                    <li data-namePage='contact'>
                        <a href="{{ route('contact.index') }}"><i class="fa-solid fa-address-book"></i>Liên hệ</a>
                    </li>
                    <li data-namePage='statistics'>
                        <a href="{{ route('statistics.index') }}"><i class="fa-solid fa-chart-simple"></i>Thống kê</a>
                    </li>
                </ul>
            </li>

            <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
