@extends('layouts.app')

@section('title', 'Screen Displayed')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
.modal-xl {
    max-width: 1140px;
}
</style>
@endsection
@section('content')
    <div class="order-header">
        <img src="{{asset('assets/img/img-8.png')}}" alt="">
        <div class="position-absolute">
            <h4 class="font-size-40">翻訳依頼</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad2"></div>
            </div>
        </div>
    </div>
    <div class="container margin-50" style="padding:40px 0px;">
        <div class="below-img">
            <h4 class="text-center" >翻訳依頼ページ</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad1"></div>
            </div>
        </div>
        <div style="padding:15px;">翻訳依頼文章を貼り付け (コピー＆ペースト）もしくは直接ご入力下さい。その後、言語、ジャンルをご選択ください。</div>

        <div class="row">
            <div class="col-md-7">
                <textarea  style="width:100%;height:100%;border: 1px solid grey;" id="content" name="content">{{$data->content}}</textarea>
            </div>
            <div class="col-md-5">
                <div class="form-group row">
                    <label class="label col-md-4">言語を選択して下さい。</label>
                    <div class="col-md-8" id="language">{{config('myconfig.language')[$data->language]}}</div>
                </div>
                <div class="form-group row">
                    <label class="label col-md-4">ジャンルを選択して下さい。</label>
                    <div class="col-md-8" id="category">{{config('myconfig.category')[$data->category]}}</div>
                </div>
                <div class="form-group row">
                    <label class="label col-md-4">希望納期</label>
                    <div class="col-md-8" id="delivery_date">{{$data->delivery_date}}</div>
                </div>
                <div class="form-group " style="border: 2px solid grey;">
                    <div class="row" style="padding:5px;justify-content: space-between;"><span >文字数</span><span id="count" >{{$data->count}}文字</span></div>
                    <div class="row" style="padding:5px;justify-content: space-between;"><span >料金</span><span id="price">{{$data->price}}円</span></div>
                </div>
            </div>
        </div>
        <div style="padding:15px;">
            ＊翻訳文へのご質問は以下テーブル、連絡するボタンより翻訳者へお問い合わせください。
        </div>
        @if(isset($translator))
        <table class="table table-bordered text-center my-8">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>対応言語</th>
                    <th>対応ジャンル</th>
                    <th>コンタクト</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{$translator->name}}</td>
                        <td>{{config('myconfig.category')[$translator->category]}}</td>
                        <td>{{config('myconfig.language')[$translator->language]}}</td>
                        <td>
                            <button class="btn default_button" onclick="translator_information()">詳細ビュー</button>
                            <button class="btn default_button" onclick="goWorkspace()">連絡する</button>
                            <form method="POST" id="form" name="form" action="{{ route('translation.client.workspace') }}">
                                @csrf
                                <input type="hidden" id="job_id" name="job_id" value="{{ $data->id }}">
                                <input type="hidden" id="translator_id" name="translator_id" value="{{ $translator->id }}">
                            </form>
                        </td>
                    </tr>
            </tbody>
        </table>
            @if($data->clientcontacted() > 0)
            <div tyle="margin-top:20px;" class="text-right">＜翻訳者より連絡あり＞</div>
            @endif
        @else
        <div class="text-center my-8">
        <form action="{{route('translation.destroy',$data->id)}}" method="POST" >
            @csrf
            @method('DELETE')
            <button class="ec_button" type="submit">発注取り消し</button>
        </form>
        </div>
        @endif
        <div class="text-center"><システム発注後、翻訳者がご依頼を受注いたしますと発注取り消しは出来ません。ご注意ください></div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        @if(isset($translator))
                            <div class="row margin-40 margin-bottom-50">
                                <div class="col-md-4">
                                    <div class="margin-10">
                                        @if($translator->avatar == null)
                                        <img class=" image-cropper profile-pic" src="{{asset('assets/img/img_avatar.png')}}" alt="">
                                        @endif
                                        @if($translator->avatar != null)
                                        <img class=" image-cropper profile-pic" src="{{$translator->avatar}}" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8 margin-100" style="padding-left:30px" >
                                    <div class="font-size-40">
                                        {{config('myconfig.user_type')[$translator->type]}} &nbsp;&nbsp;&nbsp;
                                        {{$translator->name}}
                                    </div>
                                    <div class="font-size-20 margin-30">対応可能言語:&nbsp;&nbsp;&nbsp;<span class="text-138DE6">
                                            {{ config('myconfig.language')[$translator->language] }}
                                    </span></div>
                                    <div class="font-size-20 margin-30">対応可能ジャンル:&nbsp;&nbsp;&nbsp;<span class="text-138DE6">
                                            {{ config('myconfig.category')[$translator->category] }}
                                    </span></div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="ec_button" type="button" data-dismiss="modal">
                                    閉じる
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    function translator_information(){
        $("#myModal").modal({backdrop: false});
        $("#myModal").modal('show');
    }
    function goWorkspace(){
        document.form.submit();
    }
</script>
@endsection
