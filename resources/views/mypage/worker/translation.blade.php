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
</style>
@endsection
@section('content')
    <div class="card container">
        <div class="card-body">
            <div class="row margin-40 margin-bottom-50">
                <div class="col-md-5">
                    <div class="margin-10">
                        @if(auth()->user()->avatar == null)
                        <img class=" image-cropper profile-pic" src="{{asset('assets/img/img_avatar.png')}}" alt="">
                        @endif
                        @if(auth()->user()->avatar != null)
                        <img class=" image-cropper profile-pic" src="{{auth()->user()->avatar}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-md-7 margin-100" style="display:flex; align-items:center">
                    <div class="" style="">
                        <div class="font-size-40">{{auth()->user()->name}}&nbsp;&nbsp;&nbsp;さんのマイページ</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 py-8" >
                    <div class="content-bg-EAFDEC">
                        <div class="infor-box-t font-size-20"><div>依頼受注中業務一覧</div></div>
                        <button class="white-color-button font-size-20" onclick="window.location.href='{{route('translation.requestlist')}}'">受注中業務確認(F)</button>
                    </div>
                </div>
                <div class="col-md-6 py-8" >
                    <div class="content-bg-EAFDEC">
                        <div class="infor-box-t font-size-20"><div>受注している仕事について</div></div>
                        <button class="white-color-button font-size-20" onclick="window.location.href='{{route('translation.progresslist')}}'">タスク一覧を見る(D)</button>
                    </div>
                </div>
                <div class="col-md-6 py-8" >
                    <div class="content-bg-EAFDEC">
                        <div class="infor-box-t font-size-20"><div>過去の業務について</div></div>
                        <button class="white-color-button font-size-20" onclick="window.location.href='{{route('translation.endlist')}}'">業務完了タスクを見る(E)</button>
                    </div>
                </div>
                <div class="col-md-6 py-8" >
                    <div class="content-bg-EAFDEC">
                        <div class="infor-box-t font-size-20"><div>登録情報の確認</div></div>
                        <button class="white-color-button font-size-20" onclick="changeInfo();">登録情報を変更する</button>
                    </div>
                </div>
            </div>
            <div class="m-4"><a href="{{route('guide.translator')}}" class="">＜翻訳者サイト利用ガイド </a>  </div>
            <div class="m-4"><a href="{{route('auth.precautions')}}" class=""><業務時注意事項</a> </div>
            <div class="m-4"><a href="{{route('guide.price')}}" class=""><料金表</a>  </div>
            <div class="text-right">
                <a href="javascript:; document.form.submit();">｛支払い明細を見る｝</a>
                <form id="form" name="form" action="{{route('translation.payment.details')}}" method="post" class="" style="display:none">
                    @csrf
                </form>
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
                        <a class="ec_button_lg" href="{{route('profile.worker.basic.update')}}" ><span>自身の情報を変更する </span></a>
                    </div>
                    <div class="ec_content_button margin-bottom-30 item-center" style="width:100%">
                        <a class="ec_button_lg" href="{{route('profile.worker.career.update')}}"><span>実績・スキルを変更する </span></a>
                    </div>
                    <div class="ec_content_button margin-bottom-30 item-center" style="width:100%">
                        <a class="ec_button_lg" href="{{route('profile.worker.payment.update')}}"><span>振込先情報を変更する </span></a>
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
</script>
@endsection
