@extends('layouts.app')

@section('title', 'Travel')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="card">
    <div>
        <h4 class="ec_title font-size-50">旅行</h4>
    </div>
    <div class="ec_content font-size-20 text-center">
        空前の旅行ブームからコロナへ。本当の正確な情報が必要なはずです。<br>
        Google翻訳・機械翻訳の不正確さ、スピーディーに<br>
        皆様の必要とする情報を提供いたします。
    </div>
    <div class="ec_content_button">
        <a class="ec_button" href="{{ route('translation.create',1) }}"><span>利用する </span></a>
    </div>
    <div class="ec_content">
        <div class="ec_content_sce">
            <div class="ec_content_sce_title font-size-30">
                <h6>WEBサイト・パンフレット</h6>
            </div>
            <div class="font-size-20 my-8">
                <div class="ec_content_sce_sm1">
                    日本語 ⇔ 対象言語<br>
                    １文字：{{$categorys[2]->price}}円
                </div>
            </div>
        </div>
    </div>
    <div class="row margin-40">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="ec_content_sce_title margin-30 font-size-20" style="padding-top:40px; padding-bottom:40px; margin-bottom:80px;">
                ＊料金は英語・中国語（繁体字・簡体字）・韓国語・フランス語<br>
                ドイツ語・スペイン語・イタリア語共通<br><br>

                ＊A4用紙１枚：４００字   180 単語程度（英語）
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection
