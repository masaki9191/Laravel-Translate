@extends('layouts.app')
@section('title', 'payment')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div>
            <h4 class="text-center mt-4 text-color-03B917">お問い合わせ完了</h4>
            <div class="d-flex justify-content-center align-items-center my-2">
                <div id="grad1"></div>
            </div>
            <div class="text-center" style="margin:40px 0px">
                お問い合わせが完了致しました。<br>
                返信まで2-3営業日かかる場合がございます。<br>
                ご了承ください。<br>
            </div>

            <div class="text-center">
                <a class="ec_button"  type="button"   onclick="window.location.href='{{ route('welcome') }}'"><span>トップへ戻る </span></a>
            </div>
        </div>
    </div>
@endsection
