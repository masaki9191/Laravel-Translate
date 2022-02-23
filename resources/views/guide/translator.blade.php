@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="card container">
    <!-- translation -->
    <div>
        <h4 class="ec_title font-size-40">翻訳者サイト利用ガイド</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div>
        ＊Ez trans翻訳は１字1句正確な翻訳会社レベルです。翻訳文章、ダブルチェックは確実に行ってください。　　
    </div>
    <div  class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">1</span>
        </div>
        <div class="font-size-20">Topページよりマイページにアクセスいただきます。</div>
    </div>

    <div class="text-center">
        <img src="{{ asset('assets/img/guide/translator1.png') }}" alt="" style="width:50%;margin-top:20px;">
        <div class="g-l-20" >受注中業務確認(F)より依頼中業務を確認し受注してください。　　　　</div>
        <img src="{{ asset('assets/img/guide/translator2.png') }}" alt="" style="width:50%;margin-top:20px;">
        <div class="g-l-20" >ワークスペースにて対象言語の依頼文を確認し (例:日⇔英)、依頼文を翻訳してください　　　　</div>
        <img src="{{ asset('assets/img/guide/translator3.png') }}" alt="" style="width:50%;margin-top:20px;">
        <div class="g-l-20" >ダブルチェックはご自身で完全に行ってください。(１字１句正確)    　</div>
        <img src="{{ asset('assets/img/guide/translator4.png') }}" alt="" style="width:50%;margin-top:20px;">　
    </div>

    <div  class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">2</span>
        </div>
        <div class="font-size-20">業務中業務後のステイタスはマイページにてご確認ください。</div>
    </div>
    <div class="text-center">
        <div class="g-l-20" >＊依頼者の方には翻訳スタート、翻訳完了報告をワークスペースのチャット画面より行ってください。
    　その他、質問要望等のコミュニケーションを含む。</div>
        <img src="{{ asset('assets/img/guide/translator5.png') }}" alt="" style="width:50%;margin-top:20px;">
        <div class="g-l-20" >＊依頼者の方からの連絡は、マイページ（タスク一覧を見る) から確認してください。</div>
        <img src="{{ asset('assets/img/guide/translator6.png') }}" alt="" style="width:50%;margin-top:20px;">
    </div>
    <div class="g-b">
        ＊翻訳終了後、翻訳やり直し依頼が来る可能性があります、確実に対応してください。
    　翻訳納品後、２～３日はステイタスを確認してください。　
    </div>
</div>
@endsection
