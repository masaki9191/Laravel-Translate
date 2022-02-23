@extends('layouts.app')

@section('title', 'EC_SITE')
@section('css')
@endsection
@section('content')
<div class="card container">

    <!-- interpretion -->
    <div>
        <h4 class="ec_title font-size-40">通訳サービスガイド</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div  class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">1</span>
        </div>
        <div class="font-size-20">通訳依頼サービスページを開きます。</div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">2</span>
        </div>
        <div class="font-size-20">
            言語を選択し、ご希望に沿う（ジャンル）通訳者を選択します。
        </div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">3</span>
        </div>
        <div class="font-size-20">
        通訳者のステイタスを確認し、ログイン中の場合は希望者を選択、<br>
        業務開始希望時間、業務時間をご入力ください。<br>
        希望者がログインしていない場合はアポイントをお取りいただきます。<br>
        後ほどご希望の通訳者より連絡（メール送信）を致します。
        </div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">4</span>
        </div>
        <div class="font-size-20">
        ご希望に沿う（言語・ジャンル）通訳者をご確認の後、<br>
        チケット購入画面よりチケットをご購入ください。
        </div>
    </div>

    <div class="text-center">
        <img src="{{ asset('assets/img/guide/interpretion1.png') }}" alt="" style="width:50%;margin-top:20px;">
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">5</span>
        </div>
        <div class="font-size-20">
        ご利用のチャットツールに通訳者が参加する形式となります。(Skype, Zoom等)。
        </div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">6</span>
        </div>
        <div class="font-size-20">
        業務依頼後のステイタスはマイページにてご確認いただけます。
        </div>
    </div>

    <div class="text-center">
        <img src="{{ asset('assets/img/guide/interpretion2.png') }}" alt="" style="width:50%;margin-top:20px;">
        <img src="{{ asset('assets/img/guide/interpretion3.png') }}" alt="" style="width:50%;margin-top:20px;">
        <img src="{{ asset('assets/img/guide/interpretion4.png') }}" alt="" style="width:50%;margin-top:20px;">
    </div>

    <div class="g-b">
        ＊ご要望がございましたらチャットスペースにてお申し付けください。
    </div>
</div>
@endsection
