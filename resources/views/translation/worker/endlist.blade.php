@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-30">業務終了タスク</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>

    <div class="" style="margin-top:80px;">
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>仕事ID</th>
                <th>概要/仕事名</th>
                <th>依頼者名</th>
                <th>発注額</th>
                <th>入金額</th>
                <th>請求日</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{ config('myconfig.category')[$data->category] }}翻訳</td>
                    <td>{{$data->order->surname."  ".$data->order->lastname}}</td>
                    <td>{{$data->price}}円</td>
                    <td>{{$data->price}}円</td>
                    <td>{{ explode(' ', $data->created_at)[0] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div class="text-center my-8">
        <button class="ec_button" onclick="window.location.href='{{ route('welcome') }}'">トップページへ戻る</button>
        <button class="ec_button" onclick="window.location.href='{{ route('mypage') }}'">マイページへログインする</button>
    </div>
</div>
@endsection
