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
                            <td>{{$count * 300 }}円</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <form id="searchForm" name="searchForm" action="{{ route('conversation.payment.details') }}" method="post" class="my-8 d-flex" style="align-item:center;justify-content:center">
            @csrf
            <label class="col-md-1 text-right">年度 </label>
            <input type="text" class="form-control col-md-3 " id="year" name="year" />
            <label class="col-md-1 text-right">月　 </label>
            <input type="text" class="form-control col-md-3 " id="month" name="month" />
            <button class="ec_button my-0 mx-4 p-1" type="button" id="searchBtn">明細を見る</button>
        </form>
        <h4 class="text-center my-8">会話</h4>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>仕事ID</th>
                    <th>コミュニケーション数</th>
                    <th>１回あたりの単価</th>
                    <th>合計</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ $count }}</td>
                        <td>300</td>
                        <td>{{$count * 300 }}円</td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="text-center my-8">
    <button class="ec_button" onclick="window.location.href='{{ route('welcome') }}'">トップページへ戻る</button>
    <button class="ec_button" onclick="window.location.href='{{ route('mypage') }}'">マイページへ戻る</button>
</div>
@endsection
@section('js')
<script>
$(document).ready(function() {
    $("#searchBtn").click(function(){
        var year =$("#year").val();
        var month =$("#month").val();
        if(year =="" || month == "")
        {
            alert("年月を入力してください。");
            return;
        }
        else
            document.searchForm.submit();
    });
});
</script>
@endsection
