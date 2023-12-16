
@extends('layout.web')

@section('title', 'Thanh toán đơn hàng thành công')


@section('breadcrumb')

@endsection

@section('content')
    <div id="checkout-success-page">
        <checkout-success-component />
    </div>
@endsection

@section('vite-web')
    @vite('resources/js/webs/pages/checkouts/checkout-success.js')
@stop
