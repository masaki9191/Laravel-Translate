@extends('layouts.app')

@section('title', 'Conversation Show')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
</style>
@endsection

@section('content')
<div class="order-header">
    <img src="{{asset('assets/img/img-9.png')}}" alt="">
    <div class="position-absolute">
        <h4 class="font-size-40">会話依頼</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad2"></div>
        </div>
    </div>
</div>
<div class="container margin-50">
    <div class="row margin-bottom-50">
        <div class="col-md-6">
        <form method="post" id="conversationForm" name="conversationForm" action="{{ route('conversation.store') }}">
            @csrf
            <input type="hidden" name="order_id" value="{{ auth()->user()->id }}">
            <input type="hidden" name="worker_id" id="worker_id">
            <input type="hidden" name="type" id="type" >
            <div class="form-group">
                <label class="label">{{ __('言語を選択して下さい。') }}</label>
                <select class="form-control" id="language" name="language">
                    @foreach (config('myconfig.language') as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </form>

        </div>
        <div class="col-md-6">
            <label style="width:100%">チケットを購入して下さい。</label>
            <a class="ec_button_lg" href="{{route('conversation.ticket')}}">購入画面へ</a>
        </div>
    </div>
    <div class="translator_show margin-bottom-50">
        <div class="content-title font-size-40">
        該当言語登録者状況
        </div>
        <div class="content-below-title font-size-20">
        ご希望の登録者を選択してください
        </div>
        <div class="row">
            @foreach($conversations as $conversation)
                <div class="col-md-3">
                    <a onclick="selectWorker({{$conversation->id}})" style="cursor: pointer;">
                        <div class="img-style">
                            @if ($conversation->avatar == "")
                                <img class="img-circle" id="conversation_img" src="{{ asset('stisla/img/avatar/avatar-1.png')}}">
                            @else
                                <img class="img-circle" id="conversation_img" src="{{$conversation->avatar}}" alt="">
                            @endif
                            <div class="text-center status-show">{{config('myconfig.worker_status')[$conversation->state]}}</div>
                        </div>
                        <div class="text-center font-size-15" style="cursor: pointer; color: black; font-weight: bold;">{{$conversation->name}}</div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row" style="flex-direction: column;align-items: center;">
            {{ $conversations->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="text-center">会話依頼内容確認</h4>
                <div class="d-flex justify-content-center align-items-center my-4">
                    <div id="grad1"></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-6 margin-40" style="align-items:center;">
                        <div class="position-center">
                            <img id="avatar_img" src="" style="border-radius:50%; width:200px; height=200px;" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 margin-50 font-size-20" style="line-height:50px">
                        <div class="row">
                            <div class="col-md-6">ワークネーム</div>
                            <div class="col-md-6" id="conversation_name"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">対応言語</div>
                            <div class="col-md-6" >日本語、<span id="conversation_language"></span></div>
                        </div>
                    </div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">性別</div>
                    <div class="col-md-2" id="conversation_sex" ></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">都道府県(日本在住の方)</div>
                    <div class="col-md-2" id="conversation_prefecture" ></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">国名(海外在住の方)</div>
                    <div class="col-md-2" id="conversation_country" ></div>
                </div>
                <h5 class="mt-16 mb-8 offset-md-1">実績・スキルについて</h5>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">
                        海外経験<br>
                        (滞在年数・学歴・職歴)
                    </div>
                    <div class="col-md-2" id="conversation_overseas_experience" ></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">
                        バイリンガルとしての<br>
                        バックグラウンド
                    </div>
                    <div class="col-md-2" id="conversation_bilingual"></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">その他アピールポイント</div>
                    <div class="col-md-2" id="conversation_other_point" ></div>
                </div>
                <div class="mt-4 text-center">
                    <button class="ec_button_lg" type="button" onclick="formSubmit()"><span>会話を依頼する </span></button>
                </div>
                <div class="my-8 text-center">
                    <button class="ec_button_lg" type="button" onclick="formSubmit()"><span>アポイントを取る </span></button>
                    <div class="">＊希望担当者がログインしていない場合</div>
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

    function selectWorker(conversation_id)
    {
        if(conversation_id == "" || conversation_id == undefined)
        {
            alert("会話者を選択してください。");
            return;
        }
        var _token = $("input[name='_token']").val();
            $.ajax({
                type:'post',
                url:"{{ route('conversation.getConversator') }}",
                data:{id:conversation_id, _token:_token},
                success:function(msg) {
                    orderScreen(msg);
                }
            });
    }
    function orderScreen(data)
    {
        var sex = @json(config('myconfig.sex'));
        document.getElementById('worker_id').value = data['id'];
        document.getElementById('type').value = data['state'];
        document.getElementById('conversation_name').innerText = data['name'];
        document.getElementById('conversation_language').innerText = data['language'];
        document.getElementById('conversation_sex').innerText = sex[data['sex']];
        document.getElementById('conversation_prefecture').innerText = data['prefecture_name'];
        document.getElementById('conversation_country').innerText = data['country_name'];

        document.getElementById('conversation_overseas_experience').innerText = data['overseas_experience'];
        document.getElementById('conversation_bilingual').innerText = data['bilingual'];
        document.getElementById('conversation_other_point').innerText = data['other_point'];

        var pic_url = "";
        if(data['avatar'] != "")
            pic_url = data['avatar'];
        else
            pic_url = "{{ asset('stisla/img/avatar/avatar-1.png')}}";
        document.getElementById('avatar_img').setAttribute('src', pic_url);
        $("#myModal").modal('show');
    }
    function formSubmit()
    {
        document.conversationForm.submit();
    }
</script>
@endsection
