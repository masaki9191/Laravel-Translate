@extends('layouts.app')
@section('title', 'payment')
@section('css')
@endsection
@section('content')
    <div class="item-center">
        <div class="col-md-10">
            <h4 class="text-center my-8 text-color-03B917">翻訳納品画面</h4>
            <div class="item-center my-2">
                <div id="grad1"></div>
            </div>
            <div class="background-EAF9EB font-size-20" style="padding:20px; margin-top:80px;">
                <div class="text-center">
                    <div class="font-size-15">仕事no {{$translate->id}}</div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        言語
                    </div>
                    <div class="col-md-3">
                        {{ config('myconfig.language')[$translate->language] }}
                    </div>
                    <div class="col-md-3">
                        翻訳者
                    </div>
                    <div class="col-md-3">
                        {{$translate->worker->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        ジャンル
                    </div>
                    <div class="col-md-3">
                        {{ config('myconfig.category')[$translate->category] }}
                    </div>
                    <div class="col-md-3">
                        総文字数
                    </div>
                    <div class="col-md-3">
                        {{$translate->count}}文字
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="item-center my-8">
        <div class="col-md-10 row">
            <div class="col-md-6">
                <div class="my-1 text-center">依頼原文</div>
                <textarea style="width:100%;height:400px;border: 1px solid grey;" id="modal_request_text" name="modal_request_text" disabled>
                    {{$translate->content}}
                </textarea>
            </div>
            <div class="col-md-6">
                <div class="my-1 text-center">納品翻訳文</div>
                <textarea style="width:100%;height:400px;border: 1px solid grey;" name="modal_delivery_text" id="modal_delivery_text" disabled>
                    {{$translate->delivery_text}}
                </textarea>
            </div>
        </div>
    </div>

    <div class="text-center my-8">
        <button class="btn default_button" onclick="goWorkspace()">やり直しを依頼する</button>
        <form method="POST" id="form" name="form" action="{{ route('translation.client.workspace') }}">
            @csrf
            <input type="hidden" id="job_id" name="job_id" value="{{ $translate->id }}">
            <input type="hidden" id="translator_id" name="translator_id" value="{{ $translate->worker->id }}">
        </form>
    </div>
@endsection
@section('js')
<script>
    function goWorkspace(){
        document.form.submit();
    }
</script>
@endsection

