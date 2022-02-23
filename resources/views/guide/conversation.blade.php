@extends('layouts.app')

@section('title', 'EC_SITE')
@section('css')
@endsection
@section('content')
<div class="card container">

    <!-- conversation -->
    <div>
        <h4 class="ec_title font-size-40">会話サービスガイド</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div  class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">1</span>
        </div>
        <div class="font-size-20">会話サービスページを開きます</div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">2</span>
        </div>
        <div class="font-size-20">言語を選択し、希望の担当者をが選択画面から選びます。
        </div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">3</span>
        </div>
        <div class="font-size-20">ご希望言語の担当者をご確認の後、チケット購入画面よりチケットをご購入ください。</div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">4</span>
        </div>
        <div class="font-size-20">
        担当者のステイタスを確認し、ログイン中の場合は担当者を選択し、<br>
        チャット画面を開きます。ログインしていない場合はアポイントを取り、<br>
        担当者からの連絡（メール送信）を待ちます。
        </div>
    </div>
    <div class="text-center">
        <img src="{{ asset('assets/img/guide/conversation1.png') }}" alt="" style="width:50%;margin-top:20px;margin-left:50px;">
    </div>
    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">5</span>
        </div>
        <div class="font-size-20">
            業務依頼後のステイタスはマイページにてご確認いただけます
        </div>
    </div>
    <div class="text-center">
        <img src="{{ asset('assets/img/guide/conversation2.png') }}" alt="" style="width:50%;margin-top:20px;margin-left:50px;">
        <img src="{{ asset('assets/img/guide/conversation3.png') }}" alt="" style="width:50%;margin-top:20px;margin-left:50px;">
        <img src="{{ asset('assets/img/guide/conversation4.png') }}" alt="" style="width:50%;margin-top:20px;margin-left:50px;">
    </div>
    <div class="g-b">
        ＊ご要望がございましたらチャットスペースにてお申し付けください。
    </div>

</div>
@endsection
