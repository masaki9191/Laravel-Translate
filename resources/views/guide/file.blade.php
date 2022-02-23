@extends('layouts.app')

@section('title', 'Translate')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="card container">
    <!-- file translation -->
    <div>
        <h4 class="ec_title font-size-50">ファイル翻訳について</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="font-size-20 text-center">
    Ez transでは翻訳文ペーストの翻訳を基本サービスとしていますが、<br>
ファイル翻訳をご希望の方はinfo@eztrans49.comまでご連絡ください。
    </div>
    <div class="margin-50 font-size-20" style="margin-left:20%">
        <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check"></i>
        通常の翻訳会社で進行管理費が17～18％のところ10％で受けたまわります。<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;１文字単価は掲載翻訳料金と同額です。業務ご依頼は1200文字程度からとなります。<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;詳しくは上記メールアドレスまでお問い合わせください。<br><br>
        <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check"></i>
            ファイル形式 Word, PPT, Excel<br><br>
        <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check"></i>
            体裁整えはサービス対象外です。<br><br>
    </div>
</div>
@endsection
