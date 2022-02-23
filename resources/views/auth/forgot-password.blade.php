@extends('layouts.auth')

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

            <div class="card card-primary">
                <div class="card-header">
                    <h4>パスワード再発行</h4>
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <div id="grad1"></div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        パスワードをお忘れですか？
                    </p>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">メールアドレス</label>
                            <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                value="{{ old('email') }}" required autofocus>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                送信
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
