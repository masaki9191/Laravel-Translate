@extends('layouts.app')

@section('title', 'Interpretation')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="card container">
    <div class="margin-50 color-02B917">
        <h4 class="express_title font-size-50">Interpretation</h4>
    </div>
    <div class="font-size: 20px;display: block;">
        <span class="line" style="padding: 1px;width: 80px;"></span>
        <span style="padding-left:5px;">通訳サービス概要</span>
    </div>
    <div class="express_title3 font-size-20">
        通訳サービスをオンライン画面に参加する形でご提供いたします。
    </div>
    <div class="margin-50 font-size-20">
        <div>
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            お手元のオンラインチャットツール（ビデオ）をご利用いただきます。<br>
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            通訳者がチャット（会議）に参加する形式となります。<br>
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            ビジネスシーンはもちろん旅行先などでもお使いいただけます。
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            プロフィールを確認しお好きな担当者をお選びいただきます。
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            担当者は通訳経験豊富な各分野各言語の完全バイリンガルです。
        </div>
    </div>
    <div class="margin-50">
        <div class="ec_content_button margin-bottom-50">
            <button class="ec_button" type="button" onclick="window.location.href='{{ route('interpretation.create') }}'"><span>利用する </span></button>
        </div>
    </div>
    <div class="card-header">
        <h4 class="font-size-30 color-02B917">注意事項</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="ec_content_sce_title margin-30 font-size-20" style="padding-top:40px; padding-bottom:40px; margin-bottom:80px;">
    ・事前にEz transチャットシステムもしくはメールにて通訳担当者と対応時間についてご相談ください。<br>
    ・料金はチケットシステムにて事前に料金のお支払いをいただきます。<br>
    　時間超過の場合はその時点で新たなチケットをご購入いただきます。<br>
    ・ご購入前にご希望の担当者の有無をご確認ください。
    </div>
    <div class="card-header">
        <h4 class="font-size-30 color-02B917">料金</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="ec_content">
        <div class="ec_content_sce_title font-size-20" style="padding-top:40px; padding-bottom:40px; margin-bottom:80px;text-align: left;">
            1セッション&nbsp;&nbsp;&nbsp;　{{$ticketprices[1]->during}}分&nbsp;&nbsp;&nbsp;　　{{$ticketprices[1]->price}}円&nbsp;&nbsp;&nbsp;　（税別）<br>
            1セッション&nbsp;&nbsp;&nbsp;　{{$ticketprices[2]->during}}分&nbsp;&nbsp;&nbsp;　　{{$ticketprices[2]->price}}円&nbsp;&nbsp;&nbsp;　（税別）<br>
            1セッション&nbsp;&nbsp;&nbsp;　{{$ticketprices[3]->during}}分&nbsp;&nbsp;&nbsp;　  {{$ticketprices[3]->price}}円&nbsp;&nbsp;&nbsp;&nbsp;   （税別）<br><br>
            ※購入後、使用期間に制限はありません。　
        </div>
    </div>
</div>
@endsection
