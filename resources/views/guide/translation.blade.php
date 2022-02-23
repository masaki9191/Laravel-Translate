@extends('layouts.app')

@section('css')
@endsection
@section('content')
<div class="card container">
    <!-- translation -->
    <div>
        <h4 class="ec_title font-size-40">翻訳サービスガイド</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div  class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">1</span>
        </div>
        <div class="font-size-20">各ジャンル翻訳依頼ページを開きます</div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">2</span>
        </div>
        <div class="font-size-20">言語、ジャンルを選択しご希望の対応時間をご入力いただきます。<br>
            翻訳依頼分を「翻訳依頼文」スペースに貼り付け（コピー＆ペースト）頂きます。<br>
            もしくは翻訳文章（テキスト）を入力いただきます。（１００文字以上から）
        </div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">3</span>
        </div>
        <div class="font-size-20">翻訳文字数、料金が即時に自動表示されます。</div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">4</span>
        </div>
        <div class="font-size-20">
            内容がよろしければ、発注ボタンを押していただきます。
        </div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">5</span>
        </div>
        <div class="font-size-20">
            決済画面より表示料金をお支払いください。
        </div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">6</span>
        </div>
        <div class="font-size-20">
            翻訳完了後、ご登録のメールアドレスまで担当者よりご連絡いたします。
        </div>
    </div>


    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">7</span>
        </div>
        <div class="font-size-20">
            翻訳完成文はマイページからご確認いただけます。（ステイタス、その他）　　　
        </div>
    </div>

    <div class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">8</span>
        </div>
        <div class="font-size-20">翻訳完了後、ご登録のメールアドレスまで担当者よりご連絡いたします。</div>
    </div>
    <div class="text-center">
        <img src="{{ asset('assets/img/guide/translation1.png') }}" alt="" style="width:50%;margin-top:20px;">
        <img src="{{ asset('assets/img/guide/translation2.png') }}" alt="" style="width:50%;margin-top:20px;">
        <img src="{{ asset('assets/img/guide/translation3.png') }}" alt="" style="width:50%;margin-top:20px;">
    </div>
    <div class="g-b">
        ＊ご要望がございましたらチャットスペースにてお申し付けください。
    </div>
</div>
@endsection
