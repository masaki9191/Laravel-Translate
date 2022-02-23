@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-30">通訳アポイント一覧</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>

    <div class="my-8">
        <table class="table table-bordered text-center" >
            <thead>
                <tr >
                    <th>仕事ID</th>
                    <th>通訳者名</th>
                    <th>ステータス</th>
                    <th>（依頼）画面</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->worker->name}}</td>
                        <td>{{config('myconfig.job_status.worker')[$data->clientcontacted()]}}</td>
                        <td><a class="btn default_button" href="{{route('interpretation.chat',$data->id)}}">チャットスペース</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center my-16">
        <a class="ec_button mr-2" href="{{route('welcome')}}">トップページへ戻る</a>
        <a class="ec_button ml-2" href="{{route('mypage')}}">マイページへ戻る</a>
    </div>
    <div class="text-center my-8">通訳者からの連絡があったときのみ＜連絡あり＞と表示されます</div>
</div>
@endsection
