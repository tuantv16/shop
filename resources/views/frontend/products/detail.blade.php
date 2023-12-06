
@extends('layout.web')

@section('title', 'Chi tiết sản phẩm')

@section('breadcrumb')
@endsection

@section('content')
    <div id="product-detail-page">
        <product-detail-component
            :product-details ='@json($productDetails)'
            :colors ='@json($colors)'
            :brands ='@json($brands)'
            :categories ='@json($categories)'
        />

    </div>
@endsection

@section('vite-web')
    @vite('resources/js/webs/pages/products/product_detail.js')
@stop
