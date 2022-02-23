@extends('layouts.app')
@section('css')

@endsection
@section('content')
    <div class="container">
        <div class="row mt-sm-4">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <form id="form" method="POST" action="{{ route('profile.client.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <h4>依頼者情報登録</h4>
                            <div class="d-flex justify-content-center align-items-center my-4">
                                <div id="grad1"></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-4"  style="padding-right: 15px;padding-left: 15px;">依頼者情報</h5>
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
                                <label for="password" class="col-md-4">パスワード(半角英数8文字以上)</label>
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
                                <h4>依頼者情報登録</h4>
                                <div class="d-flex justify-content-center align-items-center my-4">
                                    <div id="grad1"></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="mb-4"  style="padding-right: 15px;padding-left: 15px;">依頼者情報</h5>
                                <div class="form-group row">
                                    <label class="col-md-4">氏名</label>
                                    <div class="col-md-8 row">
                                        <label for="" class="col-md-2">姓</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="modal_surname" value="" disabled/>
                                        </div>
                                        <label for="" class="col-md-2">名</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="modal_lastname" value="" style="display:inline" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4">ふりがな</label>
                                    <div class="col-md-8 row">
                                        <label for="" class="col-md-2">せい</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="modal_seiname" value="" disabled/>
                                        </div>
                                        <label for="" class="col-md-2">めい</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="modal_meiname" value="" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4">ワークネーム</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="modal_name" value="" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4">パスワード(半角英数8文字以上)</label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control" name="modal_password" value="" disabled>
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
    $("input[name='modal_surname']").val($("input[name='surname']").val());
    $("input[name='modal_lastname']").val($("input[name='lastname']").val());
    $("input[name='modal_seiname']").val($("input[name='seiname']").val());
    $("input[name='modal_meiname']").val($("input[name='meiname']").val());
    $("input[name='modal_name']").val($("input[name='name']").val());
    $("input[name='modal_password']").val($("input[name='password']").val());
    $("#myModal").modal({backdrop: false});
    $("#myModal").modal('show');
}
function send()
{
    document.getElementById('form').submit();
}
</script>
@endsection
