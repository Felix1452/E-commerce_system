<?php
    if(isset($menus)){
        $menu_html = \app\Helpers\Helper::menus($menus);
    }
?>
<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="#" class="logo">
                    <img src="/template/images/icons/logo-01.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">

                        <li>
                            <a href="/">Trang Chủ</a>
                        </li>

                        {!! $menu_html !!}

                        <li>
                            <a href="/about.html">Thông Tin</a>
                        </li>

                        <li>
                            <a href="/contact.html">Liên Hệ</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11">
                        <span>
                            <a href="/timkiem.html">
                                 <i class="zmdi zmdi-search"></i>
                            </a>
                        </span>
                    </div>


                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    @if(session()->has('email'))
                        <a class="m-sm-4 text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ session()->get('name') }}
                        </a>


                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <p class="dropdown-item">{{session()->get('email') }}</p>
                            <a class="dropdown-item" href="<?php echo route('history')?>">Đơn mua</a>
                            <a class="dropdown-item" href="<?php echo route('dangxuat')?>">Đăng xuất</a>
                        </div>

                    @else
                        <a class="m-sm-4 text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
{{--                            <i class="fa-user-friends"></i>--}}
                            <i style="font-size: 27px" class="zmdi zmdi-account"></i>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="<?php echo route('login')?>">Đăng nhập</a>
                            <a class="dropdown-item" href="<?php echo route('register')?>">Đăng kí</a>
                        </div>
                   @endif
                    @if(session()->has('email'))
                        @if( session()->get('perr') == 1 || session()->get('perr') == 2)
                            <button class="btn btn-outline-primary" onclick="window.location.href='<?php echo route('admin') ?>'">QUẢN TRỊ</button>
                        @endif
                    @endif

            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="/template/images/icons/logo-01.png" alt="LOGO"></a>
        </div>
        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11">
                <a><i class="zmdi zmdi-search"></i></a>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="{{ !is_null(\Session::get('carts')) ? count(\Session::get('carts')) : 0 }}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            @if(session()->has('email'))
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                    <a href="<?php echo route('history')?>"><i class="zmdi zmdi-card-giftcard"></i></a>
                </div>
            @endif
            @if(session()->has('email'))
                <a class="m-sm-4 text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i style="color: white; margin-left: 20px" class="fa fa-user-friends"><a href="#" style="margin-left: 10px">{{session()->get('name') }}</a></i>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <i class="dropdown-item">{{session()->get('email') }}</i>
                    <a class="dropdown-item" href="<?php echo route('dangxuat')?>">Đăng xuất</a>

                </div>
            @else
                <a class="m-sm-4 text-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tài khoản
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="<?php echo route('login')?>">Đăng nhập</a>
                    <a class="dropdown-item" href="<?php echo route('register')?>">Đăng kí</a>
                </div>
            @endif
            @if(session()->has('email'))
                @if( session()->get('perr') == 1 || session()->get('perr') == 2)
                    <a class="text-dark" href="<?php echo route('admin') ?>"> QUẢN TRỊ</a>
                @endif
            @endif
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            <li>
                <a href="/index.php">Trang Chủ</a>
            </li>

            <li>
                {!! $menu_html !!}

                <span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
            </li>

            <li>
                <a href="/about.html">Thông Tin</a>
            </li>

            <li>
                <a href="/contact.html">Liên Hệ</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
