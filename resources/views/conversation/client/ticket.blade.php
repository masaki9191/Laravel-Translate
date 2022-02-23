@extends('layouts.app')

@section('title', 'Ticket_List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
    <div class="card container">
        <div class="card-header margin-50">
            <h4 class="font-size-40">会話サービスチケット購入画面</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad1"></div>
            </div>
        </div>
        <div class="card-body">
            <div class="background-EAF9EB font-size-20" style="padding:20px;">
                <div class="row margin-30">
                    <div class="col-md-10 text-center">
                    {{ $ticket[0]->count }}コミュニケーション &nbsp;&nbsp;{{ $ticket[0]->price }}円&nbsp;&nbsp;（税別）　
                    </div>
                    <div class="col-md-2">
                        <select name="ticket_set_1" id="ticket_set_1">
                            @for ($i = 0; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="margin-30 item-center">
                    <button class="ec_button font-size-20" type="button" onclick="validateData();">購入する</button>
                </div>
            </div>
            <div class="margin-bottom-50 margin-50 font-size-20">
                <div>
                    <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                    注意事項：１コミュニケーションは１０分までです（ビデオ、テキストチャット共）<br>
                </div>
                <div class="margin-30">
                    <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                    １０分に満たない場合も1コミュニケーションとみなされます。<br>
                </div>
                <div class="margin-30">
                    <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                    料金の払い戻しは出来かねますのでご了承ください。<br>
                </div>
                <div class="margin-30">
                    <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                    利用期間は無制限です。<br>
                </div>
            </div>
        </div>
    </div>
        @csrf
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-size-40">購入内容確認</h4>
                    </div>
                    <div class="modal-body">
                        <form id="payform" name="payform" method="POST" action="{{ route('payment.ticket') }}" style="display:none">
                            @csrf
                            <input type="hidden" name="buyer_id" id="buyer_id" value="{{ auth()->user()->id }}" />
                            <input type="hidden" name="price" id="price" />
                            <input type="hidden" name="ticketprice_id" id="ticketprice_id" />
                            <input type="hidden" name="amount" id="amount" />
                            <button type="submit" class="default_button" style="visibility:hidden"></button>
                        </form>
                        <div class="background-EAF9EB font-size-20" style="padding:20px;">

                            <div class="text-center font-size-20 margin-30">以下のご購入内容にお間違いがないかご確認下さい。</div>
                            <div class="margin-30">{{ $ticket[0]->count }}コミュニケーション &nbsp;&nbsp;{{ $ticket[0]->price }}円　×  <span id="modal_count"></span></div>
                            <div class="margin-30">消費税：<span id="fee"></span>円</div>
                            <div class="margin-30 font-size-24" style="text-align:right;">合計 : <span id="modal_price"></span> 円</div>
                        </div>
                        <div class="row item-center">
                            <div class="ec_content_button margin-bottom-30 item-center">
                                <button class="ec_button" type="button" onclick="paymentForm();"><span>発注する </span></button>
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
    //global defined
    var type_1 = 0;

    function validateData()
    {
        var type_1 = document.getElementById('ticket_set_1').value;

        if (type_1 == 0) {
            alert("「チケットセッションを選択してください");
        } else {
            showModal(type_1);
        }
    }

    function showModal(i)
    {
        var ticket_price = {{ $ticket[0]->price }};
        var ticket_fee = {{ $ticket[0]->fee }};
        var price = ticket_price * i;
        $("#fee").text(price * 0.1);
        price *=1.1;
        document.getElementById('modal_count').innerText = i;
        document.getElementById('modal_price').innerText = parseInt(price);
        document.getElementById('ticketprice_id').value = {{ $ticket[0]->id }};
        document.getElementById('amount').value = i;
        document.getElementById('price').value = parseInt(price);

        $("#myModal").modal('show');
    }

    function paymentForm()
    {
        document.getElementById('payform').submit();
    }
</script>
@endsection
