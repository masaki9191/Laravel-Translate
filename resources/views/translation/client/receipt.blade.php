@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-30">領収書</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="font-size-20 m-8">
        以下の通り、領収致しました。
    </div>
    <div class="item-center">
        <div class="col-md-7">

            <div class="font-size-30 my-8 text-center p-1" style="border-bottom:1px solid black;font-weight:bold">
                <span>領収金額</span><span class="ml-4"> {{$data->price}}円</span>
            </div>
            <div class="font-size-15 my-8 text-left p-1">
                <span>但し、翻訳サービス代金として。</span>
            </div>

        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-top:30px;">
    <table class="table table-bordered" style="width:75%">
        <thead>
            <tr class="text-center">
                <th>仕事ID</th>
                <th>概要</th>
                <th>単価</th>
                <th>文字数</th>
                <th>金額</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$data->id}}</td>
                <td>{{ config('myconfig.category')[$data->id] }}翻訳</td>
                <td>{{ config('myconfig.category_price')[$data->id]['price'] }}</td>
                <td>{{$data->count}}</td>
                <td>{{$data->price}}円</td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="text-center my-8">
        <button class="ec_button" onclick="window.location.href='{{ route('welcome') }}'">トップページへ戻る</button>
        <button class="ec_button" onclick="window.location.href='{{ route('mypage') }}'">マイページへログインする</button>
    </div>
</div>
@endsection
