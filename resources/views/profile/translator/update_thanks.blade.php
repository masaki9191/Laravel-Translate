@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="item-center" style="height: 80vh;">
        <div>
            <h4 class="text-center mt-4 color-02B917">Completed</h4>
            <div class="item-center my-2">
                <div id="grad1"></div>
            </div>
            <div class="text-center" style="margin:40px 0px">
                情報の登録が完了致しました。
            </div>
            <div class="text-center my-3">
                <a class="ec_button" href="{{ route('welcome') }}">トップページへ戻る</a>
                <a class="ec_button" href="{{ route('mypage') }}">マイページへ</a>
            </div>
        </div>
    </div>
@endsection
