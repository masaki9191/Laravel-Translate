@extends('layouts.app')

@section('title', 'Translator Show')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
    @media (max-width: 576px){
        .font-size-40 {
            font-size: 25px;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-40">翻訳者選択ページ</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="translator_show">
        <div class="content-title font-size-40">
            該当言語登録翻訳者状況
        </div>
        <div class="content-below-title font-size-20">
            ご希望の翻訳登録者を選択して下さい。
        </div>
        <div class="row">
            @foreach($translators as $translator)
                <div class="col-md-3">
                    <a onclick="selectTranslator({{$translator->id}})" style="cursor: pointer;">
                        <div class="img-style">
                            @if ($translator->avatar == "")
                                <img class="img-circle" src="{{ asset('stisla/img/avatar/avatar-1.png')}}">
                            @else
                                <img class="img-circle" src="{{$translator->avatar}}" alt="">
                            @endif
                            <div class="text-center status-show">AVAILABLE</div>
                        </div>
                        <div class="text-center font-size-15" style="cursor: pointer; color: black; font-weight: bold;">{{$translator->name}}</div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row" style="flex-direction: column;align-items: center;">
            {{ $translators->links() }}
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-size-40"></h4>
            </div>
            <div class="modal-body">
                <div class="row item-center">
                    <div class="ec_content_button margin-bottom-30 item-center">
                        <button class="ec_button_lg" type="button" onclick="orderScreen();"><span>修正する </span></button>
                        <button class="ec_button_lg" type="button" onclick="chatScreen();"><span>発注する </span></button>
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
    var translator_id = 0;
    function selectTranslator(id)
    {
        var id = id;
        translator_id = id;
        $("#myModal").modal("show");
    }
    function orderScreen()
    {
        window.location.href = "/translation/create/" + translator_id;
    }
    function chatScreen()
    {
        window.location.href = "/chat/translation/" + translator_id;
    }
</script>
@endsection
