<div class="navbar-custom">

    {{-- <li class="dropdown notification-list d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..."
                        aria-label="Recipient's username">
                </form>
            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#"
                role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="https://scontent.fdad3-6.fna.fbcdn.net/v/t39.30808-6/313424796_495397145982627_8718190324062364472_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=f6BZiSFeb1sAX--VJOR&_nc_ht=scontent.fdad3-6.fna&oh=00_AfD5B3kHYO31hcuh8GsNS5QP5WQgjK3IAuVwovJKGB4UgQ&oe=63978CA6" alt="">
                </span>

            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle mr-1"></i>
                    <span>My Account</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-edit mr-1"></i>
                    <span>Settings</span>
                </a>

                </a>

            </div>
        </li> --}}
    <div class="page-title-box float-left">
        <h4 class="page-title">{{ $title }}</h4>
    </div>


    {{-- <button class="button-menu-mobile open-left disable-btn">
        <i class="mdi mdi-menu"></i>
    </button> --}}
    <div class="app-search dropdown d-none float-right d-lg-block">
        <form>
            <div class="input-group">
                <i class="fa-solid search-icon fa-magnifying-glass"></i>
                <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>

        </form>
    </div>
</div>
