@extends('layouts.app')
@section('title', 'payment')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div>
            <h4 class="text-center mt-4 text-color-03B917">退会手続き完了</h4>
            <div class="d-flex justify-content-center align-items-center my-2">
                <div id="grad1"></div>
            </div>
            <div class="text-center" style="margin:40px 0px">
            退会手続きが完了致しました。<br>
            ご利用ありがとうございました。
            </div>
            <div class="text-center my-3">
                <button class="ec_button" onclick="window.location.href='{{ route('welcome') }}'">トップへ戻る</button>
            </div>
        </div>
    </div>
@endsection
