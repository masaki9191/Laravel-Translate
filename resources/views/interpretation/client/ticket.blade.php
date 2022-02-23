@extends('layouts.app')

@section('title', 'Ticket_List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
    <div class="card container">
        <div class="card-header margin-50">
            <h4 class="font-size-40">オンライン通訳サービスチケット購入画面</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad1"></div>
            </div>
        </div>
        <div class="card-body">
            <div class="background-EAF9EB font-size-20" style="padding:20px;">
                <div class="row margin-30">
                    <div class="col-md-10 text-center">
                    {{ $ticket[0]->during }}分&nbsp;&nbsp;&nbsp;&nbsp;　　{{ $ticket[0]->price }}円&nbsp;&nbsp;&nbsp;&nbsp;　（税別）　
                    </div>
                    <div class="col-md-2">
                        <select name="ticket_set_1" id="ticket_set_1">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="row margin-40">
                    <div class="col-md-10 text-center">
                    {{ $ticket[1]->during }}分&nbsp;&nbsp;&nbsp;&nbsp;　　{{ $ticket[1]->price }}円&nbsp;&nbsp;&nbsp;&nbsp;　（税別）　
                    </div>
                    <div class="col-md-2">
                        <select name="ticket_set_5" id="ticket_set_5">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <div class="row margin-40">
                    <div class="col-md-10 text-center">
                    {{ $ticket[2]->during }}分&nbsp;&nbsp;&nbsp;　　{{ $ticket[2]->price }}円&nbsp;&nbsp;&nbsp;　（税別）　
                    </div>
                    <div class="col-md-2">
                        <select name="ticket_set_10" id="ticket_set_10">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
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
                    料金は税別です。<br>
                </div>
                <div class="margin-30">
                    <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                    未消化時間も１セッションとして料金が発生いたしますので、<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;業務対応時間を事前によくご確認ください。
                </div>
                <div class="margin-30">
                    <i><img src="{{asset('assets/img/express_check.png')}}" class="img-check" alt=""></i>
                    料金の払い戻しは出来かねますのでご了承ください。<br>
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

                            <input type="hidden" name="count1" id="count1" />
                            <input type="hidden" name="count5" id="count5" />
                            <input type="hidden" name="count10" id="count10" />
                        </form>
                        <div class="background-EAF9EB font-size-20" style="padding:20px;">

                            <div class="text-center font-size-20 margin-30">以下のご購入内容にお間違いがないかご確認下さい。</div>
                            <div class="margin-30">{{ $ticket[0]->count }}セッション&nbsp;&nbsp;&nbsp;　{{ $ticket[0]->during }}分&nbsp;&nbsp;&nbsp;　　{{ $ticket[0]->price }}円　× <span id="ticket_modal_1"></span></div>
                            <div class="margin-30">{{ $ticket[1]->count }}セッション&nbsp;&nbsp;&nbsp;　{{ $ticket[1]->during }}分&nbsp;&nbsp;&nbsp;　　{{ $ticket[1]->price }}円　× <span id="ticket_modal_5"></span> </div>
                            <div class="margin-30">{{ $ticket[2]->count }}セッション&nbsp;&nbsp;&nbsp;　{{ $ticket[2]->during }}分&nbsp;&nbsp;&nbsp;　　{{ $ticket[2]->price }}円　× <span id="ticket_modal_10"></span> </div>
                            <div class="margin-30">消費税：<span id="fee"></span>円</div>
                            <div class="margin-30 font-size-24" style="text-align:right;">合計 : <span id="ticket_sum_value"></span> 円</div>
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
    var type_5 = 0;
    var type_10 = 0;

    function validateData()
    {
        var type_1 = document.getElementById('ticket_set_1').value;
        var type_5 = document.getElementById('ticket_set_5').value;
        var type_10 = document.getElementById('ticket_set_10').value;

        if (type_1 == 0 && type_5 == 0 && type_10 == 0) {
            alert("「チケットセッションを選択してください");
        } else {
            showModal(type_1, type_5, type_10);
        }
    }

    function showModal(i, j, k)
    {
        var ticket_val_1 = {{ $ticket[0]->price }} * i;
        var ticket_val_5 = {{ $ticket[1]->price }} * j;
        var ticket_val_10 = {{ $ticket[2]->price }} * k;
        var sum_value = ticket_val_1 + ticket_val_5 + ticket_val_10;
        $("#fee").text(sum_value * 0.1);
        sum_value *=1.1;
        document.getElementById('ticket_modal_1').innerText = i;
        document.getElementById('ticket_modal_5').innerText = j;
        document.getElementById('ticket_modal_10').innerText = k;
        document.getElementById('ticket_sum_value').innerText = parseInt(sum_value);

        document.getElementById('count1').value = i;
        document.getElementById('count5').value = j;
        document.getElementById('count10').value = k;
        document.getElementById('price').value = parseInt(sum_value);

        $("#myModal").modal('show');
    }

    function paymentForm()
    {
        document.getElementById('payform').submit();
    }
</script>
@endsection
