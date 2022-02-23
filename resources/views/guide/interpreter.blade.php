@extends('layouts.app')
@section('css')
@endsection
@section('content')
<div class="card container">
    <!-- translation -->
    <div>
        <h4 class="ec_title font-size-40">通訳者サイト利用ガイド</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="flex-row mb-4">
        <div class="">
        ＊
        </div>
        <div class="">
        通訳サービスは依頼者の方が登録者の方を選択し、仕事の依頼(受注)となります。<br>
        依頼者の方に表示される、登録情報(実績等)を充実させてください。<br>
        通訳者の方で海外在住もしくは海外滞在経験豊富(2年以上)の方は、会話サービスにもご登録いただけます。お支払い料金は登録者料金表にてご確認ください。
        </div>
    </div >
    <div class="flex-row mb-4">
        <div class="">
        ＊
        </div>
        <div class="">
        通訳サービスは依頼者の方がお使いのチャットツール(Skepe、Zoom等)に参加し、業務を行うスタイルとなります。<br>
        チャットでのコミュニケーションの際に必ずIDの交換及び業務時間の確認を行ってください。
        </div>
    </div>
    <div class="flex-row mb-4">
        <div class="">
        ＊
        </div>
        <div class="">
        業務時間はご自身で「通訳(アポイント)一覧」で確認の後、業務を行ってください。<br>
        ２～３分の超過はご自身の判断にお任せいたします。通訳中時間超過の場合はチケット購入を依頼者の方にお願いしてください。
        </div>
    </div>
    <div class="flex-row mb-4">
        <div class="">
        ＊
        </div>
        <div class="">
        通訳業務は服装をお気をつけください。特に商談の場合。依頼者の方の業務対応依頼時間は必ず守ってください。
        </div>
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
            マイページにログイン後は必ずステイタスを以下の対応可能にし、業務可能な状態にしてください。
            　業務可能時間以外は必ず要アポイントにし、待機状態にしてください。<br>
            お忘れになりますとステイタスの状態が間違った形で依頼者の方に表示されます。
            </div>
        </div>
        <div class="text-right">
            <img class="conversator_icon" src="{{ asset('assets/img/guide/conversator_icon1.png') }}" style="width:200px;height:101px;">
        </div>
        <img src="{{ asset('assets/img/guide/interpreter1.png') }}" alt="" style="width:50%;margin-top:20px;">
        <div class="g-l-20 ">アポイントの場合、アポイント依頼メールが届きますので確認後、アポイント一覧よりチャット画面
        で依頼者の方と連絡を取ってください。　　　　</div>
        <img src="{{ asset('assets/img/guide/interpreter2.png') }}" alt="" style="width:50%;margin-top:20px;">
        <div class="g-l-20 text-center">依頼者の方の方向け表示画面　</div>
        <img src="{{ asset('assets/img/guide/interpreter3.png') }}" alt="" style="width:50%;margin-top:20px;">
        <img src="{{ asset('assets/img/guide/interpreter4.png') }}" alt="" style="width:50%;margin-top:20px;">
    </div>
</div>
@endsection
