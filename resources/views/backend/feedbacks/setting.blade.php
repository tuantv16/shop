
@extends('layout.manage')

@section('title', 'Thiết lập các câu trả lời khảo sát')

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
                                    <h2>Thiết lập các câu trả lời khảo sát</h2>
                                    <p>Mô tả Thiết lập các câu trả lời khảo sát</p>
                                </div>
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
<div id="feedback-setting">
    <setting-feedback-component
        :survey-id="{{$surveyId}}"
        :feedbacks='@json($feedbacks)'
    />

</div>

@stop
@section('vite-manage')
    @vite('resources/js/feedbacks/setting.js')
@stop

