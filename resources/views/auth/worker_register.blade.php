@extends('layouts.auth')

@section('title', 'Register')
@section('css')
<style>

</style>
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            @if (session('status'))
            <div class="alert alert-info alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session('status') }}
                </div>
            </div>
            @endif

            <div class="card card-primary">
                <div class="card-header">
                    <h2>翻訳者、会話者、通訳者登録フォーム</h2>
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <div id="grad1"></div>
                    </div>
                    <h6>
                        ご入力頂いたメールアドレスに登録フォームをお送り致します。<br>
                        <br>
                        翻訳者、会話者、通訳者それぞれに登録希望の方は<br>
                        それぞれの業種登録フォームにご記入ください。<br>
                    </h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4">{{ __('メールアドレス') }}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="password" value="pwd123">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4">{{ __('メールアドレス(確認)') }}</label>
                            <div class="col-md-8">
                                <input id="email_confirmation" type="email" class="form-control @error('email_confirmation') is-invalid @enderror"
                                    name="email_confirmation" value="{{ old('email_confirmation') }}">
                                @error('email_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4">登録業種</label>
                            <div class="col-md-8 ">
                                <div class="d-flex justify-content-between">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="type" id="translator" value="1" checked>
                                        <label class="custom-control-label" for="translator">
                                        翻訳者
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="type" id="conversation" value="2">
                                        <label class="custom-control-label" for="conversation">
                                        会話者
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="type" id="interpreter" value="3">
                                        <label class="custom-control-label" for="interpreter">
                                        通訳者
                                        </label>
                                    </div>
                                </div>
                                @error('type')
                                <span class="invalid-feedback d-block" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-center align-items-center m-0">
                            <button type="submit" class="ec_button" style="min-width:150px;">
                                {{ __('送信') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
