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
                        翻訳依頼が完了致しました。<br>
            担当者からご連絡いたしますので少々お待ち下さい。<br>

            連絡がこない場合はお問い合わせフォームにお問い合わせ下さい。<br>
            </div>
            <div class="text-center my-3">
                <a class="ec_button mr-2" href="{{route('welcome')}}">トップページへ戻る</a>
                <a class="ec_button ml-2" href="{{route('mypage')}}">マイページへログインする</a>
            </div>
        </div>
    </div>
@endsection
