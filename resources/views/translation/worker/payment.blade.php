@extends('layouts.app')
@section('title', 'payment')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="item-center">
    <div class="col-md-10">
        <h4 class="text-center my-8 text-color-03B917">お支払明細</h4>
        <div class="item-center my-2">
            <div id="grad1"></div>
        </div>
        <div class="d-flex my-8" style="justify-content:space-between">
            <div class="">
                <div class="">ワークネーム <span class="background-EAF9EB">{{ auth()->user()->name }}</span> </div>
            </div>
            <div class="">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>合計支払金額</td>
                        </tr>
                        <tr>
                            <td>{{$all_price * 0.75 }}円</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <form action="{{ route('translation.payment.details') }}" method="get" class="my-8 d-flex" style="align-item:center;justify-content:center">
            <label class="col-md-1 text-right">年度 </label>
            <input type="text" class="form-control col-md-3 " id="year" name="year" value="{{ old('year') }}" />
            <label class="col-md-1 text-right">月　 </label>
            <input type="text" class="form-control col-md-3 " id="month" name="month" value="{{ old('month') }}"/>
            <button class="ec_button my-0 mx-4 p-1" type="submit" >明細を見る</button>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>仕事ID</th>
                    <th>翻訳文字数</th>
                    <th>文字単価</th>
                    <th>支払い率</th>
                    <th>合計</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->count}}文字</td>
                        <td>{{ $categorys[$data->category]->price }}</td>
                        <td>75%</td>
                        <td>{{$data->price * 0.75 }}円</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="text-center my-8">
    <button class="ec_button" onclick="window.location.href='{{ route('welcome') }}'">トップページへ戻る</button>
    <button class="ec_button" onclick="window.location.href='{{ route('welcome') }}'">マイページへログインする</button>
</div>
@endsection
