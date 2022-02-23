@extends('layouts.app')
@section('title', 'payment')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
    <div class="item-center">
        <div class="col-md-10">
            <h4 class="text-center my-8 text-color-03B917">以下の仕事を受注しました。</h4>
            <div class="item-center my-2">
                <div id="grad1"></div>
            </div>
            <div class="background-EAF9EB font-size-20" style="padding:20px; margin-top:80px;">
                <div class="row">
                    <div class="col-md-2">
                        仕事no
                    </div>
                    <div class="col-md-4">
                        {{$translate->id}}
                    </div>
                    <div class="col-md-3">
                        受注料金
                    </div>
                    <div class="col-md-3">
                        {{$translate->price}}円
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        依頼者名
                    </div>
                    <div class="col-md-4">
                        {{$translate->order->surname."  ".$translate->order->lastname}}
                    </div>
                    <div class="col-md-3">
                        受注日
                    </div>
                    <div class="col-md-3">
                        {{ explode(' ', $translate->created_at)[0]  }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        言語
                    </div>
                    <div class="col-md-4">
                        {{ config('myconfig.language')[$translate->language] }}
                    </div>
                    <div class="col-md-3">
                        納品時期
                    </div>
                    <div class="col-md-3">
                        {{$translate->delivery_date}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        ジャンル
                    </div>
                    <div class="col-md-4">
                        {{ config('myconfig.category')[$translate->category] }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        文字数
                    </div>
                    <div class="col-md-3">
                        {{$translate->count}}文字
                    </div>
                </div>
            </div>
            <div class="text-center my-16">
                <a class="ec_button" href="{{ route('translation.worker.workspace',$translate->id) }}">ワークスペース</a>
            </div>
        </div>
    </div>
@endsection
