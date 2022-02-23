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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endsection
@section('content')
    <div class="container">
        <div class="row mt-sm-4">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <form id="form" method="POST" action="{{ route('profile.translator.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>翻訳者登録</h4>
                            <div class="d-flex justify-content-center align-items-center my-4">
                                <div id="grad1"></div>
                            </div>
                            <p class="">
                            以下の入力フォームを入力して下さい。
                            </p>
                        </div>
                        <div class="card-body">
                            <!-- basic -->
                            <h5 class="mb-8"  style="padding-right: 15px;padding-left: 15px;">翻訳者情報</h5>
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
                            <!-- career -->
                            <h5 class="mt-16 mb-8"  style="padding-right: 15px;padding-left: 15px;">実績・スキルについて</h5>

                            <div class="form-group row">
                                <label class="col-md-4">{{ __('対応言語') }}</label>
                                <div class="col-md-8">
                                    <select class="form-control @error('language') is-invalid @enderror" name="language" id="language" >
                                        <option value="">-- 選んでください --</option>
                                        @foreach (config('myconfig.language') as $key => $value)
                                            <option value="{{$key}}" {{ $key === auth()->user()->language  ? 'selected' : '' }} >{{$value}}</option>
                                         @endforeach
                                    </select>
                                    @error('language')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">{{ __('専門分野') }}</label>
                                <div class="col-md-8">
                                    <select class="form-control @error('category') is-invalid @enderror" name="category" id="category" >
                                        <option value="">-- 選んでください --</option>
                                        @foreach (config('myconfig.category') as $key => $value)
                                            <option value="{{$key}}" {{ $key === auth()->user()->category  ? 'selected' : '' }} >{{$value}}</option>
                                         @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- payment -->
                            <h5 class="mt-16 mb-8"  style="padding-right: 15px;padding-left: 15px;">振込先情報<span class="font-size-15">&nbsp;&nbsp;&nbsp;＊振り込みは日本の金融機関(普通口座)のみです。</span></h5>

                            <div class="form-group row">
                                <label class="col-md-4">{{ __('金融機関名') }}</label>
                                <div class="col-md-8">
                                    <input type="hidden" name="bank_name" id="bank_name"/>
                                    <select class="form-control @error('financial_institution_name') is-invalid @enderror" name="financial_institution_name" id="financial_institution_name" data-live-search="true" >
                                        <option value="">-- 選んでください --</option>
                                        @foreach($banks as $bank)
                                            <option value="{{ $bank['code'] }}"  >{{ $bank['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('financial_institution_name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">{{ __('支店名') }}</label>
                                <div class="col-md-8">
                                    <input type="hidden" name="branch_name" id="branch_name"/>
                                    <select class="form-control @error('financial_branch_name') is-invalid @enderror" name="financial_branch_name" id="financial_branch_name" data-live-search="true">
                                        <option value="">-- 選んでください --</option>
                                    </select>
                                    @error('financial_branch_name')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">{{ __('口座番号') }}</label>
                                <div class="col-md-8 row">
                                    <input type="text" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ old('account_number') ?? auth()->user()->account_number }}" />
                                    @error('account_number')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4">{{ __('口座名義人(カタカナ)') }}</label>
                                <div class="col-md-8 row">
                                    <input type="text" class="form-control @error('account_holder') is-invalid @enderror" name="account_holder" value="{{ old('account_holder') ?? auth()->user()->account_holder }}" />
                                    @error('account_holder')
                                        <span class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="agree" id="agree" checked>
                                    <label class="form-check-label" for="agree">
                                        振込口座の注意点を確認致しました。
                                    </label>
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
                                <h4>翻訳者登録</h4>
                                <div class="d-flex justify-content-center align-items-center my-4">
                                    <div id="grad1"></div>
                                </div>

                            </div>
                            <div class="card-body">
                            <!-- basic -->
                                <h5 class="mb-4"  style="padding-right: 15px;padding-left: 15px;">翻訳者情報</h5>
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
                                <!-- career -->
                                <h5 class="mt-16 mb-8"  style="padding-right: 15px;padding-left: 15px;">実績・スキルについて</h5>

                                <div class="form-group row">
                                    <label class="col-md-4">{{ __('対応言語') }}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="modal_language" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4">{{ __('専門分野') }}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="modal_category" disabled>
                                    </div>
                                </div>

                                <!-- payment -->
                                <h5 class="mt-16 mb-8"  style="padding-right: 15px;padding-left: 15px;">振込先情報</h5>

                                <div class="form-group row">
                                    <label class="col-md-4">{{ __('金融機関名') }}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="modal_financial_institution_name" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4">{{ __('支店名') }}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="modal_financial_branch_name" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4">{{ __('口座番号') }}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="modal_account_number" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4">{{ __('口座名義人(カタカナ)') }}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" name="modal_account_holder" disabled>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('#financial_institution_name').selectpicker();
        $('#financial_branch_name').selectpicker();
        $('#financial_branch_name').change(function(){
            $("#branch_name").val($(this).find('option:selected').text());
        });
        $('#financial_institution_name').change(function(){
            var code = $(this).val();
            $("#bank_name").val($(this).find('option:selected').text());
            var _token = $("input[name='_token']").val();
            // $('#financial_branch_name').find('option:not(:first)').remove();
            // $('#financial_branch_name').selectpicker();
            $.ajax({
                url: "{{ route('profile.bank.branch') }}",
                type:'POST',
                dataType:"json",
                data: {_token:_token, code:code},
                success: function(success) {
                    var entries = Object.entries(success);
                    var str = '';
                    entries.forEach(function(number) {
                        str += '<option value="'+number[1]['code']+'">'+number[1]['name']+'</option>';
                    });
                    $('#financial_branch_name').find('option:not(:first)').remove();
                    $('#financial_branch_name').append(str) ;
                    $('#financial_branch_name').selectpicker('refresh');
                }
            });
        });
    });
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


        //career
        $("input[name='modal_language']").val($("#language option:selected").text());
        $("input[name='modal_category']").val($("#category option:selected").text());


        //payment
        $("input[name='modal_financial_institution_name']").val( $( "#financial_institution_name option:selected" ).text() );
        $("input[name='modal_financial_branch_name']").val( $( "#financial_branch_name option:selected" ).text() );
        $("input[name='modal_account_number']").val($("input[name='account_number']").val());
        $("input[name='modal_account_holder']").val($("input[name='account_holder']").val());

        $("#myModal").modal({backdrop: false});
        $("#myModal").modal('show');
    }
    function send()
    {
        document.getElementById('form').submit();
    }
    </script>
@endsection
