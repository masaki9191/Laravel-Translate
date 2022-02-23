@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

            <div class="card card-primary">
                <div class="card-header">
                    <h4>本サービスから退会する</h4>
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <div id="grad1"></div>
                    </div>
                    <p class="">
                        退会後、ご登録情報は削除されます。<br>
                        <br>
                        本サービスから退会をご希望される方は<br>
                        もう一度以下にメールアドレスとパスワードをご入力下さい。
                    </p>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-warning alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                            </button>
                            @if (session('status')=='error')
                                入力したデータが正確ではありません。
                            @endif
                        </div>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('logout.out') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4">メールアドレス</label>
                            <div class="col-md-8">
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autofocus />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4">パスワード</label>
                            <div class="col-md-8">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    autocomplete="current-password" tabindex="2" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group  d-flex justify-content-center align-items-center">
                            <button type="submit" class="ec_button">
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
