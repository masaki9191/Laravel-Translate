@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="card container">
    <!-- translation -->
    <div>
        <h4 class="ec_title font-size-40">会話者サイト利用ガイド</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div>
    ＊会話サービスは依頼者の方が登録者の方を選択し、仕事の依頼(受注)となります。<br>
　  依頼者の方に表示される、登録情報を充実させてください。
    </div>
    <div  class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">1</span>
        </div>
        <div class="font-size-20">業務依頼はマイページにログイン後、業務ステイタスを対応可能、要アポイントスイッチから切り替えて
ください。対応可能ステイタスは依頼者の方から直接依頼が入ります。</div>
    </div>
    <div class="text-center">
        <div class="flex-row mt-4 g-l-20 text-left">
            <div class="">
            ＊
            </div>
            <div class="">
                マイページにログイン後は必ずステイタスを以下の対応可能にし、業務可能な状態にしてください。<br>
                業務可能時間以外は必ず要アポイントにし、待機状態にしてください。<br>
                お忘れになりますとステイタスの状態が間違った形で依頼者の方に表示されます。
            </div>
        </div>
        <div class="text-right">
            <img class="conversator_icon" src="{{ asset('assets/img/guide/conversator_icon1.png') }}" style="width:200px;height:101px;">
        </div>
        <img src="{{ asset('assets/img/guide/conversator1.png') }}" alt="" style="width:50%;margin-top:20px;">
    </div>
    <div  class="v-h-center">
        <div class="g-r">
            <span class="d-block">step</span>
            <span class="t">2</span>
        </div>
        <div class="font-size-20">アポイントの場合、アポイント依頼メールが届きますので確認後、アポイント一覧よりチャット画面
            で依頼者の方と連絡を取ってください。その後会話(ビデオ)画面を開き、会話をスタートしてください。　　　</div>
    </div>
    <div class="text-center">
        <img src="{{ asset('assets/img/guide/conversator2.png') }}" alt="" style="width:50%;margin-top:20px;">
    </div>
</div>
@endsection
