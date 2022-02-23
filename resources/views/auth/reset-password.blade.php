@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<style>
.btn-primary {
    background-color:#70d77c;
    border-color:#70d77c;
}
.btn-primary:hover {
    color: #fff;
    background-color:#9ae6a2!important;
    border-color:#9ae6a2!important;
}
</style>
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
                    <h4>パスワードを再設定する</h4>
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <div id="grad1"></div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                value="{{ old('email', $request->email) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="password">パスワード</label>
                            <input id="password" type="password" class="form-control pwstrength"
                                data-indicator="pwindicator" name="password" tabindex="2" required>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">パスワード(確認用)</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" tabindex="2" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                パスワードを再設定する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
