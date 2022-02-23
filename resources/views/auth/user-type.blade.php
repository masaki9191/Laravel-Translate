@extends('layouts.auth')

@section('title', 'Register')
@section('css')
    <style>
    .form-check {
        display:inline;
    }
    </style>
@endsection
@section('content')
<div class="container mt-5" style="height: 70vh;">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-8 offset-xl-2 mb-3">

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
                    <h4>ユーザー類型選択</h4>
                    <div class="d-flex justify-content-center align-items-center my-4">
                        <div id="grad1"></div>
                    </div>
                    <h6>仕事したい業種を選択してください。</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('usertype.update',[$user->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row justify-content-center align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="client" value="0" checked>
                                <label class="form-check-label" for="client">
                                お客様
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="translator" value="1">
                                <label class="form-check-label" for="translator">
                                翻訳者
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="expression" value="2">
                                <label class="form-check-label" for="expression">
                                表現者
                                </label>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center align-items-center">
                            <button type="submit" class="btn btn-md btn-bg text-light">
                                {{ __('登録') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
