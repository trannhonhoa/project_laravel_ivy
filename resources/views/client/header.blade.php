@php
if (is_null(Session::get('carts'))) {
    $productQuantity = 0;
} else {
    $productQuantity = count(Session::get('carts'));
}
@endphp
<header class="header-v2">
    <!-- Header desktop -->
    @php $menusHtml = \App\Helpers\Helper::menus($menus) @endphp
    <div class="container-menu-desktop trans-03">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop p-l-45">

                <!-- Logo desktop -->
                <a href="/" class="logo">
                    <img src="/template/client/images/logo.png" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        {!! $menusHtml !!}
                        {{-- <li class="label1" data-label1="hot">
                            <a href="shoping-cart.html">Sale</a>
                        </li> --}}

                        <li>
                            <a href="/bai-viet.html">Bài viêt</a>
                        </li>

                        <li>
                            <a href="about.html">Về chúng tôi</a>
                        </li>


                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m p-r-22">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <a href="/carts" class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti"
                        data-notify="{{ $productQuantity }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </a>
                    <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                    </a>
                </div>

            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="/"><img src="/template/client/images/logo.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m p-r-22">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <a href="/carts" class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti"
                data-notify="{{ $productQuantity }}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </a>
            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                <i class="fa fa-user-o" aria-hidden="true"></i>
            </a>
            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
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
            {{-- <li>
                <a href="index.html">Home</a>
                <ul class="sub-menu-m">
                    <li><a href="index.html">Homepage 1</a></li>
                    <li><a href="home-02.html">Homepage 2</a></li>
                    <li><a href="home-03.html">Homepage 3</a></li>
                </ul>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li> --}}
            {!! $menusHtml !!}


            {{-- <li>
                <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Hot</a>
            </li> --}}

            <li>
                <a href="/bai-viet.html">Bài viết</a>
            </li>

            <li>
                <a href="about.html">Về chúng tôi</a>
            </li>


        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/template/client/images/icons/icon-close2.png" alt="CLOSE">
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
