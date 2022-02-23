@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-30">発注済仕事一覧</h4>
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
                <th>翻訳者名</th>
                <th>受注額</th>
                <th>ステータス</th>
                <th>納期</th>
                <th>各ページ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{ config('myconfig.category')[$data->category] }}</td>
                    <td>
                    @if($data->worker != null)
                        {{$data->worker->name}}
                    @endif
                    </td>
                    <td>{{$data->price}}円</td>
                    <td>{{config('myconfig.job_status.client')[$data->status]}}</td>
                    <td>{{$data->delivery_date}}</td>
                    <td class="text-center">
                    @if($data->status == 2)
                        <button class="btn default_button" onclick="window.location.href='{{route('translation.delivery.view',$data->id)}}'">納品文</button>
                    @else
                        <button class="btn default_button" onclick="window.location.href='{{route('translation.show',$data->id)}}'">翻訳依頼文</button>
                    @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
