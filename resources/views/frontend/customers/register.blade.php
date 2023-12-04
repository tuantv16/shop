
@extends('layout.web')

@section('title', 'Đăng ký khách hàng')


@section('breadcrumb')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Đăng ký khách hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ asset('/')}}">Trang chủ</a>
                            <span>Đăng ký khách hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div id="register-customer">
        <register-customer-component
        />
    </div>
@endsection

@section('vite-web')
    @vite('resources/js/webs/pages/customers/customer.js')
@stop
