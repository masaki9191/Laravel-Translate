@extends('layouts.auth')

@section('title', 'Confirm Password')

@section('content')
<div class="container mt-5">

    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-8 offset-xl-2">
            @if (session('status') == 'verification-link-sent')
            <div class="alert alert-info alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ __('登録時に指定したメールアドレスに新しい確認リンクが送信されました。') }}
                </div>
            </div>
            @endif

            <div class="card card-primary">
                <div class="card-header">
                    <h4>パスワードを認証する</h4>
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <div id="grad1"></div>
                    </div>
                </div>

                <div class="card-body">
                    <p class="text-muted">
                        {{ __('サインアップしていただきありがとうございます！ 始める前に、メールで送信したリンクをクリックして、メールアドレスを確認していただけますか？ メールが届かない場合は、別のメールをお送りします。') }}
                    </p>
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                {{ __('確認メールを再送') }}
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-lg btn-block" tabindex="4">
                                {{ __('ログアウト') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
