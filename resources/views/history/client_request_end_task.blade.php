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
    @if ($request_end_job == 0)
        <div class="text-center font-size-60">
            Doesn't exist data.
        </div>
    @endif
    @if ($request_end_job != 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>仕事ID</th>
                <th>概要/仕事名</th>
                <th>ワー力一名</th>
                <th>発注頷</th>
                <th>納界日</th>
                <th>請求日</th>
                <th>謹求書/領収書</th>
            </tr>
        </thead>
        <tbody>
            @foreach($request_end_task_datas as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{ config('myconfig.category')[$data->id] }}</td>
                    <td>{{$data->worker->name}}</td>
                    <td>{{$data->price}}</td>
                    <td>{{$data->delivery_date}}</td>
                    <td></td>
                    <td>
                        <div><button class="ec_button" style="border-radius:20px">請求書</button></div>
                        <div><button class="ec_button" style="border-radius:20px">領収書</button></div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    </div>
</div>
@endsection
