
@extends('layout.web')

@section('title', 'Chi tiết sản phẩm')

@section('breadcrumb')
@endsection

@section('content')
    <div id="product-detail-page">
        <product-detail-component
            :info-products ='@json($infoProducts)'
            :sizes ='@json($sizes)'
            :colors ='@json($colors)'
        />

    </div>
@endsection

@section('vite-web')
    @vite('resources/js/webs/pages/products/product_detail.js')
@stop
