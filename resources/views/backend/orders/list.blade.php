@extends('layout.manage')

@section('title', 'Danh sách đơn hàng')

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
                                    <h2>Danh sách đơn hàng</h2>
                                    <p>Mô tả danh sách đơn hàng</p>
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
    <div id="order-list">
        <list-order-component :orders='@json($orders)'/>
    </div>
@stop

@section('vite-manage')
    @vite('resources/js/orders/order-list.js')
@stop

