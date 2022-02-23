@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
@endsection
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-30">通訳チケット利用状況</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>

    <div class="my-8 item-center">
        <table class="table table-bordered text-center " style="width:30%">
            <thead>
                <tr >
                    <th>購入チケット種別</th>
                    <th>チケット残数</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$ticketprice[0]->during}}</td>
                    <td>{{$ticket[0]['amount']}}</td>
                </tr>
                <tr>
                    <td>{{$ticketprice[1]->during}}</td>
                    <td>{{$ticket[1]['amount']}}</td>
                </tr>
                <tr>
                    <td>{{$ticketprice[2]->during}}</td>
                    <td>{{$ticket[2]['amount']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="text-center my-16">
        <a class="ec_button mr-2" href="{{route('welcome')}}">トップページへ戻る</a>
        <a class="ec_button ml-2" href="{{route('mypage')}}">マイページへ戻る</a>
    </div>
</div>
@endsection
