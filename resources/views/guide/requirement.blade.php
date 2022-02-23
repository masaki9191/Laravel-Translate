@extends('layouts.app')

@section('title', 'EC_SITE')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
.v-h-center {
    display: flex;align-items: center;margin-top:20px;
}
.g-r {
    margin-right:30px;color:#70D77C;text-align: center;
}
.g-r .t{
    font-size: 50px;font-weight:bold;
}
.g-b {
    margin-top:50px;
    margin-bottom:50px;
    text-align:center;
}
.g-l-20 {
    font-size:20px;
    margin-left:50px;
    margin-top:50px;
    margin-bottom:20px;
    text-align:left;
}
.conversator_icon {
    width:40px;
    height:40px;
    margin-top:20px;
}
.yellow-board {
    background-color:#EAF9EB;
    padding:40px;
    margin-top:40px;
}
</style>
@endsection
@section('content')
<div class="card container">
    <div>
        <h4 class="ec_title font-size-50">募集要項</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="yellow-board">
                翻訳希望の方<br>
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check"></i>
                翻訳会社勤務、専任翻訳者としての活動６か月以上<br><br>
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check"></i>
                日本語⇆対象言語<br>
                &nbsp;&nbsp;&nbsp;&nbsp;双方対応できる方のみ
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;料金<br>
                &nbsp;&nbsp;&nbsp;&nbsp;1文字2.5円～10円×75%
            </div>
        </div>
        <div class="col-md-6">
            <div class="yellow-board">
                会話表現希望の方<br>
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check"></i>
                海外滞在経験2年以上<br>
                &nbsp;&nbsp;&nbsp;&nbsp;料金 時給換算 1,800円
            </div>
            <div class="yellow-board">
                通訳希望の方<br>
                <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check"></i>
                通訳経験 ６か月以上<br>
                &nbsp;&nbsp;&nbsp;&nbsp;料金 時給換算 6,000円
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-3 mt-16">
            <div class="mb-8">＊上記の条件を満たした方のみご応募ください。</div>
            <div class="mb-8">
                  ＊＜翻訳者＞副業（フリーランス）経験のみの方は基本NＧですが<br>
                　実績豊富な方は必要事項に詳しい実績、および翻訳ファイルを<br>
                　以下のメールアドレスまでお送りください。
            </div>
        </div>
    </div>
    <div>
        <h4 class="ec_title font-size-50">必要事項</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div class="yellow-board" style="width:25%">
            <h4 class="ec_title font-size-30">翻訳者</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad1"></div>
            </div>
            <div class="">
                ＊対応言語<br>
                ＊経験年数<br>
                ＊実績(詳しく)<br>
                ＊就業形態
            </div>
        </div>
        <div class="yellow-board" style="width:25%">
            <h4 class="ec_title font-size-30">会話者</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad1"></div>
            </div>
            <div class="">
                ＊対応言語<br>
                ＊バイリンガルとしてのバックグラウンド
            </div>
        </div>
        <div class="yellow-board" style="width:25%">
            <h4 class="ec_title font-size-30">通訳者</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad1"></div>
            </div>
            <div class="">
                ＊対応言語<br>
                ＊経験年数<br>
                ＊実績
            </div>
        </div>
    </div>
    <div class="g-b">
        ＊エントリーご希望の方は募集要項、必要事項を詳しく記入の上、info@eztrans49.com までご連絡ください。<br>
        選考通過者の方のみご連絡いたします。
    </div>
</div>
@endsection
