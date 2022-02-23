@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-40">発注済仕事一覧</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>

    <div class="" style="margin-top:80px;">
    @if ($process_job == 0)
        <div class="text-center font-size-60">
            Doesn't exist data.
        </div>
    @endif
    @if ($process_job != 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>仕事ID</th>
                <th>概要/仕事名</th>
                <th>翻訳者名</th>
                <th>発注額</th>
                <th>ステータス</th>
                <th>納期</th>
                <th>納期</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordered_history_datas as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{ config('myconfig.category')[$data->id] }}</td>
                    <td>{{$data->worker->name}}</td>
                    <td>{{$data->price}}</td>
                    <td></td>
                    <td>{{$data->created_at}}</td>
                    <td>
                        <a class="ec_button" style="border-radius:20px" href="{{route('sharing.index',$data->id)}}">翻訳ページ</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    </div>
</div>
@endsection
