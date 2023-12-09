
@extends('layout.web')

@section('title', 'shop page')


@section('breadcrumb')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Giỏ hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ asset('/') }}">Trang chủ</a>
                            <a href="{{ asset('/shop.html') }}">Cửa hàng</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
@endsection

@section('content')
    <div id="cart-page">
        <cart-component
            :carts = '@json($carts)'
            :account='@json($account)'
        />
    </div>
@endsection

@section('vite-web')
    @vite('resources/js/webs/pages/carts/cart.js')
@stop
