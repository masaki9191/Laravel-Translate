@extends('layouts.app')
@section('css')

<style>
    .form-check {
        display:inline;
    }
    .btn-white {
        cursor: pointer;
        background-color: white;
        border: 1px solid darkgrey
    }
    *, :after, :before {
        box-sizing: border-box;
        border: 0 solid #70d77c;
    }
    .agree {
        padding:20px;
        border:1px solid black;
        margin: 60px;
    }
</style>
@endsection
@section('content')
    <div class="container">
        <div class="row mt-sm-4">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <form id="form" method="POST" action="{{ route('profile.translator.update_basic') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4>登録情報変更</h4>
                            <div class="d-flex justify-content-center align-items-center my-4">
                                <div id="grad1"></div>
                            </div>
                            <p class="">
                            以下の入力フォームを入力して下さい。
                            </p>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-md-4">氏名</label>
                                <div class="col-md-8 row">
                                    <label for="" class="col-md-2">姓</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control  @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') ?? auth()->user()->surname }}" />
                                        @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <label for="" class="col-md-2">名</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') ?? auth()->user()->lastname }}" style="display:inline"/>
                                        @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">ふりがな</label>
                                <div class="col-md-8 row">
                                    <label for="" class="col-md-2">せい</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control @error('seiname') is-invalid @enderror" name="seiname" value="{{ old('seiname') ?? auth()->user()->seiname }}" />
                                        @error('seiname')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>

                                    <label for="" class="col-md-2">めい</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control @error('meiname') is-invalid @enderror" name="meiname" value="{{ old('meiname') ?? auth()->user()->meiname }}" />
                                        @error('meiname')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4">ワークネーム</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') ?? auth()->user()->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4">パスワード<br>(半角英数8文字以上)</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" value="{{ old('password') }}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4">パスワード(確認)</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" value="{{ old('password_confirmation') }}">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">{{ __('プロフィール画像') }}</label>
                                <div class="col-md-8">
                                    <div>
                                        <input type="file"  accept="image/*" name="file" id="file"  onchange="loadFile(event)" style="display: none;">
                                        <label for="file" class="btn btn-white" >ファイルを選択する</label>
                                    </div>
                                    <div >
                                        <img id="output" name="output" style="width:150px;height:200px" src="{{ old('avatar', auth()->user()->avatar) == ''? asset('stisla/img/avatar/avatar-1.png') : old('avatar', auth()->user()->avatar)}}" class="p-1" style="border: 1px solid rgba(0,0,0,0.12);"/>
                                    </div>
                                    <script>
                                        var loadFile = function(event) {
                                            var image = document.getElementById('output');
                                            image.src = URL.createObjectURL(event.target.files[0]);
                                        };
                                    </script>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="del_flag" id="del_flag">
                                            <label class="form-check-label" for="del_flag">
                                            プロフィール画像を削除する
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-center">
                            <button class="ec_button" type="button" onclick="showModal()">
                                確認する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal part -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="card">

                            <div class="card-header">
                                <h4>登録情報変更</h4>
                                <div class="d-flex justify-content-center align-items-center my-4">
                                    <div id="grad1"></div>
                                </div>

                            </div>
                            <div class="card-body">
                            <!-- basic -->
                                <div class="form-group row">
                                    <label class="col-md-4">氏名</label>
                                    <div class="col-md-8 row">
                                        <label for="" class="col-md-2">姓</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="modal_surname" disabled/>
                                        </div>
                                        <label for="" class="col-md-2">名</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="modal_lastname" style="display:inline" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4">ふりがな</label>
                                    <div class="col-md-8 row">
                                        <label for="" class="col-md-2">せい</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="modal_seiname" disabled/>
                                        </div>
                                        <label for="" class="col-md-2">めい</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="modal_meiname" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="modal_name" class="col-md-4">ワークネーム</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="modal_name" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4">パスワード<br>(半角英数8文字以上)</label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control" name="modal_password" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4">{{ __('プロフィール画像') }}</label>
                                    <div class="col-md-8">
                                        <div >
                                            <img name="modal_output" style="width:150px;height:200px" src="" class="p-1" style="border: 1px solid rgba(0,0,0,0.12);"/>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer text-center">
                                <button class="ec_button" type="button" data-dismiss="modal">
                                    情報を修正する
                                </button>
                                <button class="ec_button" type="button" onclick="send()">
                                    登録する
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <div>
@endsection
@section('js')
<script>
    function showModal()
    {
        // basic
        $("input[name='modal_surname']").val($("input[name='surname']").val());
        $("input[name='modal_lastname']").val($("input[name='lastname']").val());
        $("input[name='modal_seiname']").val($("input[name='seiname']").val());
        $("input[name='modal_meiname']").val($("input[name='meiname']").val());
        $("input[name='modal_name']").val($("input[name='name']").val());
        $("input[name='modal_password']").val($("input[name='password']").val());
        $("img[name='modal_output']").attr('src', $("img[name='output']").attr('src'));


        $("#myModal").modal({backdrop: false});
        $("#myModal").modal('show');
    }
    function send()
    {
        document.getElementById('form').submit();
    }
    </script>
@endsection
