@extends('layout.manage')

@section('title', 'Cập nhật sản phẩm')

@section('sidebar')
    @parent
@stop

@section('breadcome')
<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="icon nalika-home"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Cập nhật sản phẩm</h2>
                                    <p>Mô tả cập nhật sản phẩm</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="breadcomb-report">
                                <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="icon nalika-download"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
<div id="product-update">

    <update-product-component
        {{-- :sizes='@json($sizes)'
        :colors='@json($colors)' --}}
        :brands='@json($brands)'
        :categories='@json($categories)'
        :products='@json($products)'
    />
</div>

@stop

@section('vite-manage')
    @vite('resources/js/products/product-update.js')
@stop

