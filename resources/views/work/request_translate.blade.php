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
            <h4 class="text-center" style="margin-top:40px">翻訳依頼ページ</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad1"></div>
            </div>
        </div>
        <div style="padding:15px;">翻訳依頼文章を貼り付け (コピー＆ペースト）もしくは直接ご入力下さい。</div>
        <form method="POST" id="form" name="form" action="{{ route('payment.translation') }}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                    <div class="col-md-7">
                        <input type="hidden" id="order_id" name="order_id" value="{{ $order_id }}">
                        <input type="hidden" id="language" name="language">
                        <input type="hidden" id="category" name="category">
                        <input type="hidden" id="price" name="price"/>
                        <input type="hidden" id="count" name="count"/>
                        <textarea  style="width:100%;height:100%;border: 1px solid grey;" id="content" name="content" placeholder="" onchange="areaout()"></textarea>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="label">{{ __('言語を選択して下さい。') }}</label>
                            <select class="form-control" id="language_info" name="language_info">
                                @foreach (config('myconfig.language') as $key => $value)
                                    <option value="{{$key}}*{{$value}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label">{{ __('ジャンルを選択して下さい。') }}</label>
                            <select class="form-control" id="category_info" name="category_info" onchange="areaout()">
                                @foreach(config('myconfig.category_price') as $key => $value)
                                    <option value="{{ $key }}*{{$value['price']}}*{{$value['name']}}">{{$value['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label">{{ __('希望納期') }}</label>
                            <input type="date" class="form-control" name="delivery_date" id="delivery_date"  language="jp"/>
                        </div>



                        <div class="form-group" style="border: 2px solid grey;">
                            <div class="row" style="padding:5px;justify-content: space-between;"><span >文字数</span><span id="char_count" ></span></div>
                            <div class="row" style="padding:5px;justify-content: space-between;"><span >料金</span><span id="all_price"></span></div>
                        </div>
                    </div>
            </div>
            <div style="padding:15px;">
                翻訳サービス利用時の翻訳内容に関わる、<br>
                また付随する質問は担当翻訳者にお尋ねください。
            </div>
            <div style="margin-top:20px;" class="text-center">
                <button class="ec_button" type="button" onclick="validate()">システム発注</button>
            </div>
        </form>

<!-- modal part -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <h4>翻訳依頼内容確認</h4>
                                <div class="d-flex justify-content-center align-items-center my-4">
                                    <div id="grad1"></div>
                                </div>
                                <p class="">
                                入力内容を確認して下さい。
                                </p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <textarea  style="width:100%;height:100%;border: 1px solid grey;" id="modal_content" name="modal_content" disabled></textarea>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                            <label class="label col-md-4">言語</label>
                                            <div class="col-md-8" id="modal_language"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="label col-md-4">ジャンル</label>
                                            <div class="col-md-8" id="modal_category"></div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="label col-md-4">希望納期</label>
                                            <div class="col-md-8" id="modal_delivery_date"></div>
                                        </div>
                                        <div class="form-group " style="border: 2px solid grey;">
                                            <div class="row" style="padding:5px;justify-content: space-between;"><span >文字数</span><span id="modal_count" ></span></div>
                                            <div class="row" style="padding:5px;justify-content: space-between;"><span >料金</span><span id="modal_price"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-center">
                                <button class="ec_button" type="button" data-dismiss="modal">
                                    修正する
                                </button>
                                <button class="ec_button" type="button" onclick="send()">
                                    発注する
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
<script>
    var count = 0;
    function areaout(){
        var language_key = document.getElementById('language_info').value;
        var language = language_key.split("*");
        var language_id = language[0];
        var language_content = language[1];

        var a = document.getElementById('content').value.trim();
        count = a.split(" ").join("").length;
        document.getElementById('char_count').innerText = count  + "文字";

        var key = document.getElementById('category_info').value;
        var data =  key.split("*");
        var key = data[0];
        var price = data[1];
        var original_name = data[2];

        document.getElementById('language').value = language_id;
        document.getElementById('category').value = key;

        var total_price = price * count;
        document.getElementById('all_price').innerText = total_price  + "円";
        document.getElementById('price').value = total_price*1.1;
        document.getElementById('count').value = count;
    }
    function validate() {
        var content= document.getElementById('content').value;
        var language= document.getElementById('language').value;
        var category= document.getElementById('category').value;
        var delivery_date= document.getElementById('delivery_date').value;

        if(content == ""){
            alert("テキストを書いてください。");
            return;
        }
        if(language == ""){
            alert("言語を選択してください。");
            return;
        }
        if(category == ""){
            alert("カテゴリを選択してください。");
            return;
        }
        if(delivery_date == ""){
            alert("日付を選択してください。");
            return;
        }
        var category = @json(config('myconfig.category'));
        var language = @json(config('myconfig.language'));
        $("#modal_content").html($("#content").val());
        $("#modal_language").html("日本語→"+language[$("#language").val()]);
        $("#modal_category").html(category[$("#category").val()]);
        $("#modal_delivery_date").html($("#delivery_date").val());
        $("#modal_count").html($("#count").val());
        $("#modal_price").html($("#price").val());
        $("#myModal").modal({backdrop: false});
        $("#myModal").modal('show');
    }
    function send() {
        document.getElementById('form').submit();
    }
</script>
@endsection
