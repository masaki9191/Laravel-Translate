@extends('layouts.app')

@section('title', 'Sharing_Service')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
<div class="card container">
    <div class="margin-50 color-02B917">
        <h4 class="express_title font-size-50">Translate Sharing Service</h4>
    </div>
    <div class="font-size: 20px;display: block;">
        <span class="line" style="padding: 1px;width: 80px;"></span>
        <span style="padding-left:5px;">翻訳シェアリングサービス</span>
    </div>
    <div class="express_title text-center font-size-20 margin-50">
        20ページの専門的ビジネス文書を来週の会議に間に合わせなくてはいけない。<br>
        現代のビジネスにおいて急な要求はつきものです。<br>
        シェアリングサービスは一人の窓口の専任担当者を一人置き、<br>
        最大３名までで急ぎの要件に対応いたします。<br><br>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 font-size-20 ec_content_sce_title">
            ※料金ー通常の利用料金に1文字4円が追加されます。<br>
            ※ファイル添付ーエクセルのみ対応
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="margin-30 margin-bottom-30">
        <div class="ec_content_button margin-bottom-50">
            <button class="ec_button"><span>利用する </span></button>
        </div>
    </div>

    <div class="margin-40 margin-bottom-50">
        <table id="customers">
            <tr>
                <th></th>
                <th>ジャンル</th>
                <th>対象言語→日本語</th>
                <th>日本語→対象言語</th>
            </tr>
            <tr>
                <td>ECサイト</td>
                <td>商品情報</td>
                <td>１文字12円</td>
                <td>１文字12円</td>
            </tr>
            <tr>
                <td></td>
                <td>利用規約</td>
                <td>１文字12円</td>
                <td>１文字12円</td>
            </tr>
            <tr>
                <td>旅行</td>
                <td>WEBサイト・パンフレット</td>
                <td>１文字12円</td>
                <td>１文字12円</td>
            </tr>
            <tr>
                <td></td>
                <td>文書（易しめ）</td>
                <td>１文字12円</td>
                <td>１文字12円</td>
            </tr>
            <tr>
                <td>ビジネス</td>
                <td>文書（プレゼンテーション用）</td>
                <td>１文字12円</td>
                <td>１文字12円</td>
            </tr>
            <tr>
                <td></td>
                <td>文書（専門的文書用）</td>
                <td>１文字12円</td>
                <td>１文字12円</td>
            </tr>
            <tr>
                <td></td>
                <td>メール</td>
                <td>１文字12円</td>
                <td>１文字12円</td>
            </tr>
            <tr>
                <td>WEB、IT</td>
                <td>サイト各ジャンル</td>
                <td>１文字12円</td>
                <td>１文字12円</td>
            </tr>
            <tr>
                <td></td>
                <td>専門的文書</td>
                <td>１文字12円</td>
                <td>１文字12円</td>
            </tr>
            <tr>
                <td>その他</td>
                <td></td>
                <td>１文字12円</td>
                <td>１文字12円</td>
            </tr>
        </table>
    </div>

    <div class="margin-50 font-size-20 margin-bottom-100">
        <div>
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            翻訳窓（スペース）に依頼文章を張り付けていただきます。（コピー＆ペースト）<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;もしくはファイルを添付いただきます。（Excel)
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            翻訳文量、料金をその場で表示いたします。<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ファイル添付の場合は担当者からご連絡いたします。（文字数、料金）)<br>
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            翻訳対応希望時間を担当者にお伝えいただきます。（チャットスペース）
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            ご希望の対応時間内に専任翻訳担当者より翻訳完了のご連絡をいたします。（ご登録メールアドレス）
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            その都度、ご質問ご要望がございましたら担当者とチャットスペースにてお問い合わせください。
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            その都度、ご質問ご要望がございましたら担当者とコミュニケーションスペース<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;（メールチャット）にてお問い合わせください。
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            翻訳はクオリティーチェックを含みます。<br>
        </div>
        <div class="content">
            <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
            法律（実際の訴訟にかかわる）医療（コロナ情報以外）特許・知財関連はサービス対象外と<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;させていただきます。
        </div>
    </div>

    <div class="card-header">
        <h4 class="font-size-30 color-02B917">注意事項</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="ec_content_sce_title margin-30 font-size-20" style="padding-top:40px; padding-bottom:40px; margin-bottom:80px;">
        ・ご希望の対応時間に間に合わない場合は担当者よりご登録のメールアドレスまでご連絡いたします。<br>
        ・ファイル翻訳は体裁整えはサービス対象外です。翻訳該当箇所を担当者にお伝えください。
    </div>
</div>
@endsection
