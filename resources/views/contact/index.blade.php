@extends('layouts.app')

@section('title', 'EC_SITE')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<div class="card container" style="padding:40px 0px;">
    <h4 class="text-center" style="margin-top:40px">お問い合わせ</h4>
    <div class="d-flex justify-content-center align-items-center my-4">
        <div id="grad1"></div>
    </div>
    <form method="POST" action="{{ route('contact.store') }}">
        @csrf
        <div class="form-group row">
            <label class="label col-md-2 offset-md-2">{{ __('お名前') }}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="name"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="label col-md-2 offset-md-2">{{ __('メールアドレス') }}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="email"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="label col-md-2 offset-md-2">{{ __('お問い合わせ内容') }}</label>
            <div class="col-md-6">
                <textarea class="form-control" name="content" style="height:200px;"></textarea>
            </div>
        </div>
        <div class="text-center">
            <button class="ec_button"  type="submit"><span>送信 </span></button>
        </div>
    </form>
</div>
@endsection
