<?php
ufa()->extCss([
        'developer/centrally-purchase/detail'
]);
ufa()->extJs([
        'developer/centrally-purchase/detail'
]);
?>

@extends('layouts.master')
@section('master.content')
    @include('partials.developer.developer-header')
    <div class="index-header">
        <div class="header-box">
            <p>{{$name or ''}}</p>
            <a><img src="/www/images/developer/uncollect.png" alt="">加入收藏</a>
        </div>
    </div>
    <div class="main-content">
        <div class="box-left">
            <p>项目信息</p>
            <div class="project-detail">
                <p>项目地址：<span>{{$address or ''}}</span></p>
                <p>是否精装：<span>{{$has_decorate_name or ''}}</span></p>
                <p>开盘时间：<span>{{$opening_time_str or ''}}</span></p>
                <p>项目简介：<span>{{$summary or ''}}</span>
                </p>
            </div>
            <p>联系人信息</p>
            <div class="project-detail">
                <p>联系人：<span>{{$contacts or ''}}</span></p>
                <p>联系方式：<span>{{$contacts_phone or ''}}</span></p>
                <p>联系地址：<span>{{$contacts_address  or ''}}</span></p>
            </div>
        </div>
        <div class="box-right">
            <img src="{{$logo_url or ''}}" alt="">
            <p>{{$developer_name or ''}}</p>
        </div>
    </div>
@endsection