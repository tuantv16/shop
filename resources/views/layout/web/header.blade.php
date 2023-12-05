


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
                                <div class="header__top__links">
                                    <a id="account"> </a>
                                    <a href="{{ asset('/logout.html')}}">Đăng xuất</a>
                                
                                    <a href="{{ asset('/login.html')}}">Đăng nhập</a>
                                    <a href="{{ asset('/register.html')}}">Đăng ký</a>
                                
                                
                                    <a href="{{ asset('/faq.html') }}">FAQs</a>
                                </div>
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
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="/frontend/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{ asset('/') }}">Home</a></li>
                            <li><a href="{{ asset('/shop.html') }}">Shop22</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="{{ asset('/about.html') }}">Giới thiệu</a></li>
                                    <li><a href="{{ asset('/shop-details.html') }}">Cửa hàng chi tiết</a></li>
                                    <li><a href="{{ asset('/shopping-cart.html') }}">Giỏ hàng</a></li>
                                    <li><a href="{{ asset('/checkout.html') }}">Thanh toán</a></li>
                                    <li><a href="{{ asset('/blog-details.html') }}">Tin tức chi tiết</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ asset('/blog.html') }}">Blog</a></li>
                            <li><a href="{{ asset('/shopping-cart.html') }}">Cart</a></li>
                            <li><a href="{{ asset('/contact.html') }}">Contacts</a></li>
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