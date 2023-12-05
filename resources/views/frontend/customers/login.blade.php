
@extends('layout.web')

@section('title', 'Đăng nhập tài khoản')


@section('breadcrumb')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Đăng nhập tài khoản</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ asset('/')}}">Trang chủ</a>
                            <span>Đăng nhập tài khoản</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div id="login-customer">
        <input type="hidden" id="token_login" value="{{ csrf_token() }}" />
        <login-customer-component />
    </div>
@endsection

@section('vite-web')
    @vite('resources/js/webs/pages/customers/customer_login.js')
@stop
