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
        <div style="padding:15px;">
            翻訳依頼文章を貼り付け (コピー＆ペースト）もしくは直接ご入力下さい。（言語、ジャンルをご選択ください）<br>
            ＊言語選択は日本語⇔対象言語となります。(例) 日本語→英語、英語→日本語。共に言語選択は「英語」となります。
        </div>
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
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label">{{ __('ジャンルを選択して下さい。') }}</label>
                        <select class="form-control" id="category_info" name="category_info" onchange="areaout()">
                        @if($big_category == 0)
                            @for ($i = 0; $i < 2; $i++)
                                <option value="{{ $i }}*{{$categorys[$i]->price}}*{{$categorys[$i]->name}}">{{$categorys[$i]->name}}</option>
                            @endfor
                        @elseif($big_category == 1)
                            @for ($i = 2; $i < 3; $i++)
                                <option value="{{ $i }}*{{$categorys[$i]->price}}*{{$categorys[$i]->name}}">{{$categorys[$i]->name}}</option>
                            @endfor
                        @elseif($big_category == 2)
                            @for ($i = 3; $i < 7; $i++)
                                <option value="{{ $i }}*{{$categorys[$i]->price}}*{{$categorys[$i]->name}}">{{$categorys[$i]->name}}</option>
                            @endfor
                        @elseif($big_category == 3)
                            @for ($i = 7; $i < 8; $i++)
                                <option value="{{ $i }}*{{$categorys[$i]->price}}*{{$categorys[$i]->name}}">{{$categorys[$i]->name}}</option>
                            @endfor
                        @elseif($big_category == 4)
                            @for ($i = 8; $i < 10; $i++)
                                <option value="{{ $i }}*{{$categorys[$i]->price}}*{{$categorys[$i]->name}}">{{$categorys[$i]->name}}</option>
                            @endfor
                        @endif

                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label">{{ __('希望納期') }}</label>
                        <input type="date" class="form-control" name="delivery_date" id="delivery_date"  language="jp"/>
                    </div>



                    <div class="form-group" style="border: 2px solid grey;">
                        <div class="row" style="padding:5px;justify-content: space-between;"><span >文字数</span><span id="char_count" ></span>文字</div>
                        <div class="row" style="padding:5px;justify-content: space-between;"><span >料金</span><span id="all_price"></span>円</div>
                    </div>
                        <div class="text-right text-danger" id="lowPrice">
                        <翻訳文字数は100文字以上からとなります>
                        </div>

                </div>
            </div>
            <div style="padding:15px;">
                <料金は前払いとなります。事前に該当言語の担当者の有無を必ずご確認ください>
            </div>
            <div style="margin-top:20px;" class="text-center">
                <button class="ec_button" type="button" onclick="validate()">システム発注</button>
            </div>
        </form>

        <div class="my-16 text-center">＊システム発注はお時間をいただく場合がございます。発注後4~5日経過後翻訳者より連絡のない場合は<br>
Topページ問い合わせ画面よりご連絡ください。</div>

        <div class="item-center" id="translatorTable">

        </div>
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
                                        <div class="text-right">
                                        ＜税込み＞
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
        var language_id = document.getElementById('language_info').value;

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
        document.getElementById('price').value = Math.floor(total_price);
        document.getElementById('count').value = count;
        if(total_price > 100)
        {
            $("#lowPrice").addClass("d-none");
        }
        else{
            $("#lowPrice").removeClass("d-none");
        }
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
        if($("#price").val() < 100)
        {
            return;
        }
        var category = @json(config('myconfig.category'));
        var language = @json(config('myconfig.language'));
        $("#modal_content").html($("#content").val());
        $("#modal_language").html(language[$("#language").val()]);
        $("#modal_category").html(category[$("#category").val()]);
        $("#modal_delivery_date").html($("#delivery_date").val());
        $("#modal_count").html($("#count").val()+"文字");
        $("#modal_price").html($("#price").val()+"円");
        $("#myModal").modal({backdrop: false});
        $("#myModal").modal('show');
    }
    function send() {
        document.getElementById('form').submit();
    }
    $(document).ready(function() {
        $("#language_info").change(function(){
            var id = $(this).val();
            $.ajax({
                url: "/translation/translatorList/"+id,
                type:'get',
                success: function(success) {
                    $("#translatorTable").html(success);
                }
            });
        });
    });
</script>
@endsection
