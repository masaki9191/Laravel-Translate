@extends('layouts.app')
@section('title', 'payment')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="item-center">
    <div class="col-md-10">
        <h4 class="text-center my-8 text-color-03B917">納品が完了致しました</h4>
        <div class="item-center my-2">
            <div id="grad1"></div>
        </div>
        <div class="text-center m-16">お疲れ様です。<br>以下の納品が完了致しました。</div>
        <div class="background-EAF9EB font-size-20" style="padding:20px; margin-top:30px;">
            <div class="text-center">
                <div class="font-size-15">仕事no {{$translate->id}}</div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    言語
                </div>
                <div class="col-md-3">
                    {{ config('myconfig.language')[$translate->language] }}
                </div>
                <div class="col-md-3">
                    翻訳者
                </div>
                <div class="col-md-3">
                    {{$translate->worker->name}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    ジャンル
                </div>
                <div class="col-md-3">
                    {{ config('myconfig.category')[$translate->category] }}
                </div>
                <div class="col-md-3">
                    総文字数
                </div>
                <div class="col-md-3">
                    {{$translate->count}}文字
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center my-3">
    <button class="ec_button" onclick="window.location.href='{{ route('welcome') }}'">トップページへ戻る</button>
    <button class="ec_button" onclick="window.location.href='{{ route('mypage') }}'">マイページへ戻る</button>
</div>
@endsection
