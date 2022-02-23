@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-40">翻訳者選択ページ</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>

    <div class="" style="margin-top:80px;">
    @if ($delivery_count == 0)
        <div class="text-center font-size-60">
            Doesn't exist data.
        </div>
    @endif
    @if ($delivery_count != 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>仕事ID</th>
                <th>概要/仕事名</th>
                <th>依頼者名</th>
                <th>発注額</th>
                <th>入金額</th>
                <th>請求日</th>
            </tr>
        </thead>
        <tbody>
            @foreach($history_datas as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{ config('myconfig.category')[$data->id] }}</td>
                    <td>{{$data->order->surname."  ".$data->order->lastname}}</td>
                    <td>{{$data->price}}</td>
                    <td></td>
                    <td>{{$data->created_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    </div>
</div>
@endsection
