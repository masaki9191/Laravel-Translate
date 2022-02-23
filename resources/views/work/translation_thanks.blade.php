@extends('layouts.app')
@section('title', 'payment')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
            ○時間以内に担当者からご連絡いたしますので少々お待ち下さい。<br><br>

            連絡がこない場合はお問い合わせフォームにお問い合わせ下さい。
            </div>
            <div class="text-center my-3">
                <button class="ec_button" onclick="window.location.href='{{ route('welcome') }}'">トップページへ戻る</button>
                <button class="ec_button" onclick="window.location.href='{{ route('welcome') }}'">マイページへログインする</button>
            </div>
        </div>
    </div>
@endsection
