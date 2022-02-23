@extends('layouts.app')

@section('title', 'Conversation')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="card container">
    <div class="margin-50 color-02B917">
        <h4 class="express_title font-size-50">Conversation</h4>
    </div>
    <div class="font-size: 20px;display: block;">
        <span class="line" style="padding: 1px;width: 80px;"></span>
        <span style="padding-left:5px;">会話サービス概要</span>
    </div>
    <div class="express_title3 font-size-20">
        各言語会話サービスをオンライン上画面にて提供いたします。
    </div>
    <div class="margin-50 font-size-20">
        <div>
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            Eｚ transオンラインチャットシステムをご利用いただきます。<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;（１回１０分の通話を１コミュニケーションといたします）<br>
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            画面を通じて会話をいただきます。
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            日頃感じている疑問点や各言語表現および通常の会話をお楽しみいただけます。
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            その都度、ご質問ご要望がございましたら担当者にお問い合わせください。
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            プロフィールを確認しお好きな担当者をお選びいただきます。<br>
        </div>
    </div>
    <div class="ec_content_button margin-50 margin-bottom-50">
        <button class="ec_button" style="button" onclick="window.location.href='{{ route('conversation.create') }}'"><span>利用する </span></button>
    </div>
    <div class="card-header">
        <h4 class="font-size-30 color-02B917">注意事項</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="ec_content_sce_title margin-30 font-size-20" style="padding-top:40px; padding-bottom:40px; margin-bottom:80px;">
    ・オンラインサービスは通常のコミュニケーションを対象とします。<br>
    ・過激なスラング表現および非日常的な表現はご遠慮ください。<br>
    ・会話スクールではありませんのでテキストの用意はございません。<br>
    ・チケットご購入前にご希望の担当者の有無をご確認ください<br>
    </div>
    <div class="card-header">
        <h4 class="font-size-30 color-02B917">料金</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="ec_content">
        <div class="ec_content_sce_title font-size-20" style="padding-top:40px; padding-bottom:40px; margin-bottom:80px;text-align: left;">
        {{$ticketprices[0]->count}}コミュニケーション　{{$ticketprices[0]->price}}円(税別)<br>
            ※購入後、使用期間に制限はありません。　
        </div>
    </div>
</div>
@endsection
