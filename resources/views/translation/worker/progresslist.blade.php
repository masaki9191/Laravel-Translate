@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-30">進行中業務一覧</h4>
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
                    <td>{{$data->order->surname."  ".$data->order->lastname}}</td>
                    <td>{{$data->price}}円</td>
                    <td>{{config('myconfig.job_status.worker')[$data->translatorcontacted()]}}</td>
                    <td>{{$data->delivery_date}}</td>
                    <td class="text-center">
                        <a class="btn default_button" href="{{ route('translation.worker.workspace',$data->id) }}">ワークスペース</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
