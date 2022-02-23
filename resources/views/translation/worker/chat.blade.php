

@extends('layouts.test')

@section('title', '')
@section('css')
@endsection
@section('content')
<style>
.modal-xl {
    max-width: 1140px;
}
</style>
    <div class="card container">
        <div class="card-body">
            <div class="item-center">
                <div class="col-md-10">
                    <h4 class="text-center my-8 text-color-03B917">業務コミュニケーションスペース</h4>
                    <div class="item-center my-2">
                        <div id="grad1"></div>
                    </div>
                    <div class="background-EAF9EB font-size-20" style="padding:20px; margin-top:80px;">
                        <div class="row">
                            <div class="col-md-2">
                                仕事no
                            </div>
                            <div class="col-md-4">
                                {{$translate->id}}
                            </div>
                            <div class="col-md-3">
                                受注料金
                            </div>
                            <div class="col-md-3">
                                {{$translate->price}}円
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                依頼者名
                            </div>
                            <div class="col-md-4">
                            {{$translate->order->surname."  ".$translate->order->lastname}}
                            </div>
                            <div class="col-md-3">
                                受注日
                            </div>
                            <div class="col-md-3">
                                {{ explode(' ', $translate->created_at)[0]  }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                言語
                            </div>
                            <div class="col-md-4">
                                {{ config('myconfig.language')[$translate->language] }}
                            </div>
                            <div class="col-md-3">
                                納品時期
                            </div>
                            <div class="col-md-3">
                                {{$translate->delivery_date}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                ジャンル
                            </div>
                            <div class="col-md-4">
                                {{ config('myconfig.category')[$translate->category] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                文字数
                            </div>
                            <div class="col-md-3">
                                {{$translate->count}}文字
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="item-center my-8">
                <form class="col-md-10 row" method="POST" id="form" name="form" action="{{ route('translation.worker.delivery') }}">
                    @csrf
                    <input type="hidden" id="job_id" name="job_id" value="{{ $translate->id }}">

                    <div class="col-md-6">
                        <div class="my-1 text-center">依頼文</div>
                        <textarea style="width:100%;height:400px;border: 1px solid grey;" id="request_text">
                            {{$translate->content}}
                        </textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="my-1 text-center">作業スペース</div>
                        <textarea style="width:100%;height:400px;border: 1px solid grey;" name="delivery_text" id="delivery_text"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container" id="app" style="display:none">
        <div class="card">
            <div class="card-body">
                <div class="row" style="justify-content:center">
                    <input v-model="search" type="search" class="d-none" placeholder="Cari user">
                    <input id="to_id" type="text" class="d-none" value="{{ $search_user->id}}">
                    <input id="from_id" type="text" class="d-none" value="{{ auth()->user()->id}}">
                    <div class="col-md-8">
                        <div class="card" style="">
                            <div class="card-body card-message" id="card-message-scroll"  style="height:60vh;border: 2px solid grey;">
                                <ul v-if="isActive != null" class="list-group list-group-flush">
                                    <div v-for="(message, index) in messages" v-bind:key="index">
                                        <li v-if="message.from_id != {{ auth()->user()->id }}" class="list-group-item">
                                            <div class="list-message-item">
                                                <div class="media">
                                                    <img class="mr-3 rounded-sm rounded-circle" src="{{asset('stisla/img/avatar/avatar-1.png')}}" style="width:40px;height:40px;" alt="profile">
                                                    <div class="media-body">
                                                        <div class="alert alert-primary mb-0">
                                                            @{{ message.content }}
                                                            <span  v-if="message.filename !== null && message.filename !== '' " class="">
                                                                <a :href="'/message/'+ message.filepath +'/download'">@{{ message.filename }}</a>
                                                            </span>
                                                        </div>
                                                        <small><i>@{{ new Date(message.created_at).toLocaleDateString()}}</i></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li v-else class="list-group-item">
                                            <div class="list-message-item right">
                                                <div class="alert alert-secondary mb-0">
                                                    @{{ message.content }}
                                                    <span  v-if="message.filename !== null && message.filename !== '' " class="">
                                                        <a :href="'/message/'+ message.filepath +'/download'">@{{ message.filename }}</a>
                                                    </span>
                                                </div>
                                                <small class="float-right"><i>@{{ new Date(message.created_at).toLocaleDateString()}}</i></small>
                                            </div>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div v-if="isActive != null" class="form-group mt-3">
                            <form @submit.prevent="sendMessage" enctype="multipart/form-data">
                                <div>
                                    <span class="input-group-btn">
                                        <span class="btn btn-success upload_file" title="upload file" type="button" v-on:click="chooseFile()"><i class="fa fa-file"></i></span>
                                    </span>
                                    <span id="file_name"></span>
                                </div>
                                <input type="hidden" id="job_id" name="job_id" value="{{$translate->id}}"/>
                                <input type="hidden" id="job_type" name="job_type" value="translation"/>
                                <input type="file" v-on:change="onFlieChange()" id="file" name="file" class="d-none">
                                <input v-model="form.content" type="text" class="form-control" placeholder="" required>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-right mx-16 my-16">
        <button class="ec_button" onclick="show_modal()">確認する</button>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-body">


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
                                    <textarea style="width:100%;height:400px;border: 1px solid grey;" name="modal_delivery_text" id="modal_delivery_text" disabled></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="text-right">
                            <button class="ec_button" type="button" data-dismiss="modal">
                                戻る
                            </button>
                            <button class="ec_button" type="button" onclick="delivery()">
                                納品する
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('js')
<script>
    setTimeout(function(){
        document.getElementById('app').style.display = "block";
    }, 1000);
    $(function() {
        $("#card-message-scroll").niceScroll();
    });
    function show_modal(){
        $("#myModal").modal({backdrop: false});
        document.getElementById("modal_request_text").value = document.getElementById("request_text").value ;
        document.getElementById("modal_delivery_text").value = document.getElementById("delivery_text").value ;
        $("#myModal").modal('show');
    }
    function delivery(){
        if(document.getElementById("delivery_text").value == "")
        {
            alert("納期ステートメントを入力してください。");
            return
        }
        document.form.submit();
    }
</script>
@endsection
