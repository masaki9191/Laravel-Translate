@extends('layouts.app')

@section('title', 'Translate')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
    th{
        text-align:center;
    }
    #translation td:first-child{
        text-align:left;
    }
    #translation td:nth-child(2),#translation td:nth-child(3){
        text-align:center;
    }
    #conversation {
        width:70%;
        text-align:center;
        align-self: center;
    }
    #interpretion {
        text-align:center;
    }
    table {
        margin-top:50px;
    }
    .price_detail_title {
        font-size:30px;
        text-align:center;
        margin-top:50px;
        margin-bottom:30px;
    }
    .price_detail_content {
        margin-bottom:80px;
        align-self:center;
        font-size:20px;
        background-color:#EAF9EB;
    }
    </style>
@endsection
@section('content')
<div class="card container">
    <!-- file translation -->
    <div>
        <h4 class="ec_title font-size-50">登録者料金表</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <table class="table table-bordered" id="translation">
        <tr class=""><th colspan="3" style="background-color:#EAF9EB">翻訳</th></tr>
        <tr>
            <th>ジャンル</th>
            <th>単価1文字</th>
            <th>支払い料金率</th>
        </tr>
        @foreach($categorys as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td>{{$category->price}}</td>
            <td>75%</td>
        </tr>
        @endforeach
    </table>

    <table class="table table-bordered" id="conversation">
        <tr class=""><th colspan="2" style="background-color:#EAF9EB">会話</th></tr>
        <tr>
            <th>１コミュニケーション</th>
            <th>単価</th>
        </tr>
        <tr>
            <td>10分</td>
            <td>３００円</td>
        </tr>
    </table>

    <table class="table table-bordered" id="interpretion">
        <tr class=""><th colspan="3" style="background-color:#EAF9EB">翻訳</th></tr>
        <tr>
            <th>１チケット</th>
            <th>支払い単位(10分)</th>
            <th>支払い額(10分につき)</th>
        </tr>
        <tr>
            <td>10分</td>
            <td>1</td>
            <td>1,000</td>
        </tr>
        <tr>
            <td>50分</td>
            <td>1</td>
            <td>5,000</td>
        </tr>
        <tr>
            <td>100分</td>
            <td>1</td>
            <td>10,000</td>
        </tr>

    </table>
    <div class="price_detail_title">
        振込方法
    </div>
    <div class="price_detail_content" style="width:40%;padding:40px 70px;">
    ＊銀行振込手数料は自己負担です
    </div>
    <div class="price_detail_title">
        支払額計算
    </div>
    <div class="price_detail_content" style="width:80%;padding:40px 50px;">
    ＊翻訳者<br>
    { (単価一文字)  × (文字数) } × 75%<br><br>
    ＊翻訳者<br>
    300円 × (回数)*10分単位　時給換算：1,800円<br><br>
    ＊通訳者<br>
    1,000円 × (回数)*10分単位　時給換算：6,000円<br><br>
    </div>

</div>
@endsection
