
@extends('layouts.test')

@section('title', '')
@section('content')
    @if($search_user->type != 0)
    <div class="card container">
        <div class="card-body">
            <div class="item-center margin-40 margin-bottom-50">
                <div class="col-md-8 row">
                    <div class="col-md-4">
                        @if($search_user->avatar == null)
                        <img class="profile-pic" src="{{asset('assets/img/img_avatar.png')}}" alt="">
                        @endif
                        @if($search_user->avatar != null)
                        <img class="profile-pic" src="{{$search_user->avatar}}" alt="">
                        @endif
                    </div>
                    <div class="col-md-8 item-center">
                        <div>
                            <div class="font-size-20">
                                {{config('myconfig.user_type')[$search_user->type]}} &nbsp;&nbsp;&nbsp;{{$search_user->name }}
                            </div>
                            @if($search_user->type >0 )
                            <div class="font-size-20 margin-20">対応可能言語:&nbsp;&nbsp;&nbsp;<span class="text-138DE6">
                                {{config('myconfig.language')[$search_user->language]}}・日本語
                            </span></div>
                            <div class="font-size-20 margin-20">得意ジャンル:&nbsp;&nbsp;&nbsp;<span class="text-138DE6">
                                {{config('myconfig.category')[$search_user->category]}}
                            </span></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="container" id="app" style="display:none">
        <div class="card">
            <div class="card-body">
                <div class="row" style="justify-content:center">
                    <input v-model="search" type="search" class="d-none" placeholder="Cari user">
                    <input id="to_id" type="text" class="d-none" value="{{ $search_user->id}}">
                     <input id="from_id" type="text" class="d-none" value="{{ auth()->user()->id}}">
                    <div class="col-md-8">
                        <div class="card" style="">
                            <div class="text-center my-2 font-size-20"><strong><チャットスペース></strong> </div>
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
                                <input type="hidden" id="job_id" name="job_id" value="{{$appointment_id}}"/>
                                <input type="hidden" id="job_type" name="job_type" value="interpretation"/>
                                <input type="file" v-on:change="onFlieChange()" id="file" name="file" class="d-none">
                                <input v-model="form.content" type="text" class="form-control" placeholder="" required>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
    　＊ご依頼（アポイント）内容をチャットにてお申し付けください
    </div>
    <div class="text-center my-16">
        <a class="ec_button mr-2" href="{{route('welcome')}}">トップページへ戻る</a>
        <a class="ec_button ml-2" href="{{route('mypage')}}">マイページへ戻る</a>
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
</script>
@endsection
