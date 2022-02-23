@extends('layouts.auth')

@section('title', 'Precautions Registration')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
    <div class="card container"  style="padding-top:50px;padding-bottom:50px;">
        <div class="card-header margin-100">
            <h4 class="font-size-50">業務時注意事項</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad1"></div>
            </div>
        </div>
        <div class="express_title3 font-size-20">
            業務時には以下のことを遵守いただきます。
        </div>
        <div class="margin-50 font-size-20">
            <div>
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                依頼者とのコミュニケーションが業務の基本となります。丁寧な対応を心がけてください。
            </div>
            <div class="content">
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                依頼者とのコミュニケーションは業務に関わる事項のみといたします。
            </div>
            <div class="content">
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                業務可能の際はログイン状態をキープしてください。
            </div>
            <div class="content">
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                依頼者からの業務対応時間は必ず守ってください。
            </div>
            <div class="content">
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                業務上知り得た情報（個人、団体を問わず）は外部に漏らさないでください。
            </div>
            <div class="content">
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                依頼者よりのクレームの内容、回数により退会をいただく場合があります。<br>
            </div>
            <div class="content">
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                業務上の不明点は運営側にお問い合わせください。
            </div>
            <div class="content">
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                登録時のプロフィールは依頼者に表示されます
            </div>
        </div>
        <div class="margin-50 font-size-20 text-center">
            上記事項をお守りいただかない場合、退会いただく場合がございます。
        </div>
    </div>
@endsection
