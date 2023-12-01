
@extends('main')

@section('title', 'shop page')


@section('breadcrumb')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div id="shop-page">
        <shop-component />
    </div>
@endsection

@section('vite-web')
    @vite('resources/js/webs/pages/shops/shop.js')
@stop
