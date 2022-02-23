@extends('layouts.app')

@section('title', 'Translate')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="card container">
    <div class="margin-50 color-02B917">
        <h4 class="express_title font-size-50">Translation</h4>
    </div>
    <div class="font-size: 20px;display: block;">
        <span class="line" style="padding: 1px;width: 80px;"></span>
        <span style="padding-left:5px;">翻訳サービス概要</span>
    </div>
    <div class="express_title3 font-size-20">
        翻訳サービスをオンライン上画面にて提供いたします。
    </div>
    <div class="margin-50 font-size-20">
    <div class="flex-row mb-4">
        <div class="">
            <img src="{{asset('assets/img/express_check.png')}}" >
        </div>
        <div class="ml-2">
            翻訳窓（スペース）に依頼文章を張り付けていただきます。（コピー＆ペースト）<br>
            もしくは、翻訳窓に翻訳希望の文章をご入力いただきます。（１００文字以上から）
        </div>
    </div>
    <div class="flex-row mb-4">
        <div class="">
            <img src="{{asset('assets/img/express_check.png')}}" >
        </div>
        <div class="ml-2">
            翻訳文量、料金をその場で表示いたします。
        </div>
    </div>
    <div class="flex-row mb-4">
        <div class="">
            <img src="{{asset('assets/img/express_check.png')}}" >
        </div>
        <div class="ml-2">
            その都度、ご質問ご要望がございましたら担当者とチャットスペースにてお問い合わせください。
        </div>
    </div>
    <div class="flex-row mb-4">
        <div class="">
            <img src="{{asset('assets/img/express_check.png')}}" >
        </div>
        <div class="ml-2">
            翻訳はクオリティーチェックを含みます。
        </div>
    </div>
    <div class="flex-row mb-4">
        <div class="">
            <img src="{{asset('assets/img/express_check.png')}}" >
        </div>
        <div class="ml-2">
            法律（実際の訴訟にかかわる）医療（コロナ情報以外）特許・知財関連はサービス対象外とさせていただきます
        </div>
    </div>
    <div class="flex-row mb-4">
        <div class="">
            <img src="{{asset('assets/img/express_check.png')}}" >
        </div>
        <div class="ml-2">
            システム利用発注の場合には対応までお時間がかかる場合がございます。
        </div>
    </div>
    <div class="flex-row mb-4">
        <div class="">
            <img src="{{asset('assets/img/express_check.png')}}" >
        </div>
        <div class="ml-2">
            ご希望の対応時間に間に合わない場合は担当者よりご登録のメールアドレスまでご連絡いたします。
        </div>
    </div>
    <div class="ec_content_button margin-50 margin-bottom-50">
        <button type="button" class="ec_button" onclick="window.location.href='{{ route('welcome') }}'"><span>TOPに戻る </span></button>
    </div>
</div>
@endsection
