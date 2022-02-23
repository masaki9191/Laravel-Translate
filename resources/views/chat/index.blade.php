@extends('layouts.test')

@section('title', '')
@section('content')
    <div class="card container">
        <div class="card-body">
            <div class="row margin-40 margin-bottom-50">
                <div class="col-md-4">
                    <div class="margin-10">
                        @if($search_user->avatar == null)
                        <img class=" image-cropper profile-pic" src="{{asset('assets/img/img_avatar.png')}}" alt="">
                        @endif
                        @if($search_user->avatar != null)
                        <img class=" image-cropper profile-pic" src="{{$search_user->avatar}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-md-8 margin-100" style="display:flex; align-items:center">
                    <div class="" style="">
                        <div class="font-size-40">
                            {{config('myconfig.user_type')[$search_user->type]}} &nbsp;&nbsp;&nbsp;
                            {{$search_user->name}}&nbsp;<span class="text-138DE6">FREE</span>
                        </div>
                        @if($search_user->user_type != 0)
                            <div class="font-size-20 margin-30">対応可能言語:&nbsp;&nbsp;&nbsp;<span class="text-138DE6">
                                @foreach (json_decode($search_user->language) as $lang)
                                    {{ config('myconfig.language')[$lang] }}&nbsp;&nbsp;
                                @endforeach
                            </span></div>
                            <div class="font-size-20 margin-30">対応可能ジャンル:&nbsp;&nbsp;&nbsp;<span class="text-138DE6">
                                @foreach (json_decode($search_user->category) as $cat)
                                    {{ config('myconfig.category')[$cat] }}&nbsp;&nbsp;
                                @endforeach
                            </span></div>
                            <div class="font-size-20 margin-30">資格:&nbsp;&nbsp;&nbsp;<span class="text-138DE6">
                                {{$search_user->score}}
                            </span></div>
                            <div class="font-size-20 margin-30">学歴:&nbsp;&nbsp;&nbsp;<span class="text-138DE6">
                                {{$search_user->overseas_experience}}
                            </span></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a class="ec_button" href="/{{$type}}/create/{{$search_user->id}}"><span>翻訳を依頼する</span></a>
            </div>
        </div>
    </div>
    <div class="container" id="app" style="display:none">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-top:50px;justify-content:center">
                    <input v-model="search" type="search" class="d-none" placeholder="Cari user">
                    <input id="to_id" type="text" class="d-none" value="{{ $search_user->id}}">
                    <input id="from_id" type="text" class="d-none" value="{{ auth()->user()->id}}">
                    <input id="to_name" type="text" class="d-none" value="{{ $search_user->name}}">
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
                                <input type="file" v-on:change="onFlieChange()" id="file" name="file" class="d-none">
                                <input v-model="form.content" type="text" class="form-control" placeholder="Tulis..." required>
                            </form>
                        </div>
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
</script>
@endsection
