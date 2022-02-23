@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-30">通訳(アポイント)一覧</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>

    <div class="my-8">
        <table class="table table-bordered text-center" >
            <thead>
                <tr >
                    <th>仕事ID</th>
                    <th>依頼者名</th>
                    <th>ステータス</th>
                    <th>通訳時間</th>
                    <th>希望日時</th>
                    <th>チャット画面</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->order->surname."  ".$data->order->lastname}}</td>
                        <td>{{$data->business_start_time}}</td>
                        <td>{{$data->sum_time}}</td>
                        <td>{{config('myconfig.appointment_type')[$data->type]}}</td>
                        <td><a class="btn default_button" href="{{route('interpretation.chat',$data->id)}}">チャット</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center my-8">
    ＊該当アポイント業務のチャット画面ボタンを押し、依頼者の方と連絡を取ってください（対応可能時間等）<br>
    <br>
    依頼者からの連絡があったときのみ＜連絡あり＞と表示されます
    </div>

    <div class="text-center my-16">
        <a class="ec_button ml-2" href="{{route('mypage')}}">マイページへ戻る</a>
    </div>
</div>
@endsection
