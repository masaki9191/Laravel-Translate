@extends('layouts.app')

@section('title', 'Translation Order List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
    .infor-box-t {
        position: absolute;
        top: 0px;
        transform: translateY(-50%);
    }
    .content-bg-EAFDEC {
        position:relative;
        display: flex;
        justify-content: center;
    }
    @media (max-width: 576px){
        .font-size-20 {
            font-size:15px;
        }
        .font-size-40 {
            font-size: 25px;
        }
    }
    .px-15 {
        padding-left:15px;
        padding-right:15px;
    }
</style>
@endsection
@section('content')
    <div class="card container">
        <div class="card-body">
            <div class="d-flex px-15 py-8">
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="type" id="translator" value="{{route('mypage.client.change',1)}}" checked>
                    <label class="custom-control-label" for="translator">
                    翻訳
                    </label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="type" id="conversation" value="{{route('mypage.client.change',2)}}">
                    <label class="custom-control-label" for="conversation">
                    会話
                    </label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" name="type" id="interpreter" value="{{route('mypage.client.change',3)}}">
                    <label class="custom-control-label" for="interpreter">
                    通訳
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 py-8 offset-md-3" >
                    <div class="content-bg-EAFDEC">
                        <div class="infor-box-t font-size-20"><div>現在発注している仕事について</div></div>
                        <button class="white-color-button font-size-20" onclick="window.location.href='{{route('translation.progresslist')}}'">発注一覧を見る(B)</button>
                    </div>
                </div>
                <div class="col-md-6 py-8" >

                    <div class="content-bg-EAFDEC">
                        <div class="infor-box-t font-size-20">発注について</div>
                        <button class="white-color-button font-size-20" onclick="window.location.href='{{route('translation.progresslist')}}'">納品翻訳文を見る</button>
                    </div>
                </div>
                <div class="col-md-6 py-8" >
                    <div class="content-bg-EAFDEC">
                        <div class="infor-box-t font-size-20"><div>完了分の仕事について</div></div>
                        <button class="white-color-button font-size-20" onclick="window.location.href='{{route('translation.endlist')}}'">完了リストへ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-size-40">登録情報変更</h4>
            </div>
            <div class="modal-body">
                <div class="row item-center">
                    <div class="ec_content_button margin-bottom-30 item-center" style="width:100%">
                        <a class="ec_button_lg" href="{{route('profile.client.update_basic_get')}}" ><span>自身の情報を変更する
                         </span></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="default_button" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    function changeInfo() {
        $("#myModal").modal('show');
    }
    $("input[name='type']").change(function(){
        location.href=$(this).val();
    });
</script>
@endsection
