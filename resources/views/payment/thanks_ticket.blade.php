@extends('layouts.app')
@section('title', 'payment')
@section('css')
<style>
    .btn-bg-03B917 {
        background-color:#03B917;
    }
    .text-color-03B917 {
        color:#03B917;
    }
</style>
@endsection
@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div>
            <h4 class="text-center mt-4 text-color-03B917">Completed</h4>
            <div class="d-flex justify-content-center align-items-center my-2">
                <div id="grad1"></div>
            </div>
            <div class="text-center" style="margin:40px 0px">
            決済が完了致しました。
            </div>
            <div class="text-center my-3">
                <a class="ec_button mr-2" href="{{route('welcome')}}">トップページへ戻る</a>
                <a class="ec_button ml-2" href="{{route('mypage')}}">マイページへ</a>
            </div>
        </div>
    </div>
@endsection
