@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-30">会話(アポイント)一覧</h4>
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
                    <th>チャット画面</th>
                    <th>会話（ビデオ）画面</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->order->surname."  ".$data->order->lastname}}</td>
                        <td>{{config('myconfig.appointment_type')[$data->type]}}</td>
                        <td><a class="btn default_button" href="{{route('conversation.chat',$data->id)}}">チャット</a></td>
                        <td><a class="btn default_button" href="{{route('conversation.videochat',$data->id)}}" >｛会話（ビデオ）｝</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center my-8">
        ＊ログイン中依頼者からの連絡があったとき＜連絡あり＞と表示されますチャット<br>
            画面から"会話OK"のメッセージをお願いします。<br>
            <br>
        ＊アポイントの場合＜アポイント連絡＞と表示されます。該当業務のチャット画<br>
         面ボタンを押し、 依頼者の方と連絡を取ってください（対応可能時間等)<br>
    </div>

    <div class="text-center my-16">
        <a class="ec_button ml-2" href="{{route('mypage')}}">マイページへ戻る</a>
    </div>
</div>
@endsection
