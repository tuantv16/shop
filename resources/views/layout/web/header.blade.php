


    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div id="account-header">
                                <div class="header__top__hover">
                                    @if ($accountLogin)
                                        <span>Hi: {{ $accountLogin }} <i class="arrow_carrot-down"></i></span>
                                        <ul>
                                            <li><a href="{{ asset('/api-v1/webs/logout')}}">Đăng xuất</a></li>
                                        </ul>
                                    @else
                                        <span><a href="{{ asset('/login.html')}}">Đăng nhập</a><i class="arrow_carrot-down"></i></span>
                                        <ul>
                                            <li><a href="{{ asset('/register.html')}}">Đăng ký</a></li>
                                            <li><a href="{{ asset('/faq.html')}}">FAQs</a></li>
                                        </ul>
                                    @endif
                                </div>
                                <div class="header__top__hover">
                                    <span>Usd <i class="arrow_carrot-down"></i></span>
                                    <ul>
                                        <li>USD</li>
                                        <li>EUR</li>
                                        <li>USD</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="header__logo">
                        <a href="./index.html"><img src="/frontend/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{ asset('/') }}">Trang chủ</a></li>
                            <li><a href="{{ asset('/shop.html') }}">Cửa hàng</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{ asset('/about.html') }}">Giới thiệu</a></li>
                                    <li><a href="{{ asset('/shop-details.html') }}">Cửa hàng chi tiết</a></li>
                                    <li><a href="{{ asset('/shopping-cart.html') }}">Giỏ hàng</a></li>
                                    <li><a href="{{ asset('/checkout.html') }}">Thanh toán</a></li>
                                    <li><a href="{{ asset('/blog-details.html') }}">Tin tức chi tiết</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ asset('/blog.html') }}">Tin tức</a></li>
                            <li><a href="{{ asset('/shopping-cart.html') }}">Giỏ hàng</a></li>
                            <li><a href="{{ asset('/contact.html') }}">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="/frontend/img/icon/search.png" alt=""></a>
                        <a href="#"><img src="/frontend/img/icon/heart.png" alt=""></a>
                        <a href="#"><img src="/frontend/img/icon/cart.png" alt=""> <span>0</span></a>
                        <div class="price">$0.00</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>

{{-- @section('vite-web')
    @vite('resources/js/webs/common/headers/header.js')
@stop --}}
