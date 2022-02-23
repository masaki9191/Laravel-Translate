@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-40">ファイル翻訳業務一覧</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>

    <div class="" style="margin-top:80px;">
    @if ($delivery_job == 0)
        <div class="text-center font-size-60">
            Doesn't exist data.
        </div>
    @endif
    @if ($delivery_job != 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>仕事ID</th>
                <th>概要/仕事名</th>
                <th>翻訳者名</th>
                <th>見積額</th>
                <th>ステータス</th>
                <th>納期</th>
                <th>見積日</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordered_end_history_datas as $data)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    </div>
</div>
@endsection