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
                    <form id="form" method="POST" action="{{ route('profile.interpreter.update_payment') }}" enctype="multipart/form-data">
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

                        <h5 class="mt-16 mb-8"  style="padding-right: 15px;padding-left: 15px;">振込先情報<span class="font-size-15">&nbsp;&nbsp;&nbsp;＊振り込みは日本の金融機関(普通口座)のみです。</span></h5>

                        <div class="form-group row">
                            <label class="col-md-4">{{ __('金融機関名') }}</label>
                            <div class="col-md-8">
                                <input type="hidden" name="bank_name" id="bank_name" value="{{auth()->user()->bank_name}}"/>
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
                                <input type="hidden" name="branch_name" id="branch_name" value="{{auth()->user()->branch_name}}" />
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
        //console.log();
        $('#financial_institution_name').selectpicker('val', '{{auth()->user()->financial_institution_name}}');
        valChange(1);

        $('#financial_branch_name').change(function(){
            $("#branch_name").val($(this).find('option:selected').text());
        });
        $('#financial_institution_name').change(function(){
            valChange();
        });
        function valChange(init) {
            var code = $('#financial_institution_name').val();
            $("#bank_name").val($('#financial_institution_name').find('option:selected').text());
            var _token = $("input[name='_token']").val();
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
                    if(init == 1){
                        $('#financial_branch_name').selectpicker('val', '{{auth()->user()->financial_branch_name}}');
                    }
                }
            });
        }
    });

    function showModal()
    {
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
