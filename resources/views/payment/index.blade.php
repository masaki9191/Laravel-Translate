@extends('layouts.app')
@section('title', '')
@section('css')
<style>
.nav-pills .nav-link.active{
    color: #fff !important;
    background-color: #70d77c;
}
.nav-pills .nav-link {
    color:black !important;
}



form {
  width: 480px;
  margin: 20px 0;
}

.group {
  background: white;
  box-shadow: 0 7px 14px 0 rgba(49, 49, 93, 0.10), 0 3px 6px 0 rgba(0, 0, 0, 0.08);
  border-radius: 4px;
  margin-bottom: 20px;
}

label {
  position: relative;
  color: #8898AA;
  font-weight: 300;
  height: 40px;
  line-height: 40px;
  margin-left: 20px;
  display: flex;
  flex-direction: row;
}

.group label:not(:last-child) {
  border-bottom: 1px solid #F0F5FA;
}

label > span {
  width: 120px;
  text-align: right;
  margin-right: 30px;
}

.field {
  background: transparent;
  font-weight: 300;
  border: 0;
  color: #31325F;
  outline: none;
  flex: 1;
  padding-right: 10px;
  padding-left: 10px;
  cursor: text;
}

.field::-webkit-input-placeholder {
  color: #CFD7E0;
}

.field::-moz-placeholder {
  color: #CFD7E0;
}

#paymentBtn {
  float: left;
  display: block;
  background: #70d77c;
  color: white;
  box-shadow: 0 7px 14px 0 rgba(49, 49, 93, 0.10), 0 3px 6px 0 rgba(0, 0, 0, 0.08);
  border-radius: 4px;
  border: 0;
  margin-top: 20px;
  font-size: 15px;
  font-weight: 400;
  width: 100%;
  height: 40px;
  line-height: 38px;
  outline: none;
}

#paymentBtn:focus {
  background: #555ABF;
}

#paymentBtn:active {
  background: #43458B;
}

.outcome {
  float: left;
  width: 100%;
  padding-top: 8px;
  min-height: 24px;
  text-align: center;
}

.success,
.error {
  display: none;
  font-size: 13px;
}

.success.visible,
.error.visible {
  display: inline;
}

.error {
  color: #E4584C;
}

.success {
  color: #666EE8;
}

.success .token {
  font-weight: 500;
  font-size: 13px;
}

</style>
@endsection
@section('content')

<div class="item-center">
    <div class="col-md-8 row" style="padding-top: 8%;">
        <div class="col-12 col-sm-12 col-md-5">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="card-tab" href="{{route('payment.cardpay')}}"  role="tab" aria-controls="card" aria-selected="true">
                        <div class="text-center"><img src="{{ asset('assets/img/payment/card.png') }}" style="width: 170px;height: 40px;"/></div>
                        <div class="text-center">クレジット決済</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="google-pay-tab" href="{{route('payment.applepay')}}" role="tab" aria-controls="google-pay" aria-selected="false">

                        Google pay
                        <img src="{{ asset('assets/img/payment/google-pay.png') }}" style="width: 40px;height: 40px;"/>
                        Apple pay
                        <img src="{{ asset('assets/img/payment/apple-pay.png') }}" style="width: 40px;height: 40px;"/>

                    </a>
                </li>
            </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-7">
            <div class="tab-content no-padding" id="TabContent">
                <div class="tab-pane fade show active text-center" id="card" role="tabpanel" aria-labelledby="card-tab4">

                    <form name="form" id="form" action="/payment/{{ session('data')['type'] }}store" method="POST">
                        <input type="hidden" name="token" />
                        <div class="group">
                        <label>
                            <span>カード番号</span>
                            <div id="card-number-element" class="field"></div>
                        </label>
                        <label>
                            <span>有効期限</span>
                            <div id="card-expiry-element" class="field"></div>
                        </label>
                        <label>
                            <span>CVC</span>
                            <div id="card-cvc-element" class="field"></div>
                        </label>
                        </div>
                        <!-- <button id="paymentBtn" type="submit">確認する</button> -->
                        <button id="paymentBtn" type="button" onclick="confirm_payment()" >確認する</button>
                        <div class="outcome">
                            <div class="error"></div>
                        </div>
                    </form>

                </div>
                <div class="tab-pane fade" id="google-pay" role="tabpanel" aria-labelledby="google-pay-tab4">

                </div>
                <div class="tab-pane fade" id="apple-pay" role="tabpanel" aria-labelledby="apple-pay-tab4">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
        <h4 class="text-center mt-4">お支払いの確認</h4>
        <div class="d-flex justify-content-center align-items-center my-2">
            <div id="grad1"></div>
        </div>
        <div class="text-center my-4">
            お支払内容が下記でお間違いないかご確認下さい。<br>
            お間違いなければ、確定ボタンを押して下さい。
        </div>
        <div class="text-center my-4">
           <span>お支払金額</span>
           <span style="margin-left:60px">{{ session('data')['price'] }}円</span>
        </div>
        <div class="modal-body" style="margin: 20px;background-color: #EAF9EB;">
            <div class="row mb-3">
                <div class="col-md-6">決済方法:</div>
                <div class="col-md-6">クレジットカード払い</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">クレジットカード番号:</div>
                <div class="col-md-6" >****-****-****-<span id="modal_card_number"></span> </div>
            </div>
            <div class="row my-3">
                <div class="col-md-6">クレジットカード有効期限:</div>
                <div class="col-md-6"><span id="modal_exp_year"></span>/<span id="modal_exp_month"></span></div>
            </div>
        </div>

        <div class="text-center my-3">
            <button type="button" class="ec_button" data-dismiss="modal">内容を修正する</button>
            <button type="button" class="ec_button ml-2" id="sendBtn" onclick="sendCard()">確定する</button>
        </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="https://js.stripe.com/v3/"></script>
<script>
var stripe = Stripe('pk_test_51I0O4sBqKvRbTwio1UEkiqOhHzNU6vglTZwGU73Q4R3rTi2rPDEbQsCdNCileIbEog0Ert7CzlA6tU0DkPy12kfG00lwEJoTh9');
var elements = stripe.elements();

var style = {
  base: {
    iconColor: '#666EE8',
    color: '#31325F',
    lineHeight: '40px',
    fontWeight: 300,
    fontFamily: 'Helvetica Neue',
    fontSize: '15px',

    '::placeholder': {
      color: '#CFD7E0',
    },
  },
};

var cardNumberElement = elements.create('cardNumber', {
  style: style,
  placeholder: 'クレジットカード番号を入力してください。',
});
cardNumberElement.mount('#card-number-element');

var cardExpiryElement = elements.create('cardExpiry', {
  style: style,
  placeholder: '有効期限を入力してください。',
});
cardExpiryElement.mount('#card-expiry-element');

var cardCvcElement = elements.create('cardCvc', {
  style: style,
  placeholder: 'CVCを入力してください。',
});
cardCvcElement.mount('#card-cvc-element');


function setOutcome(result) {
    var successElement = document.querySelector('.success');
    var errorElement = document.querySelector('.error');
    errorElement.classList.remove('visible');
    if (result.token) {
        $("#modal_card_number").html(result.token.card.last4);
        $("#modal_exp_year").html(result.token.card.exp_year);
        $("#modal_exp_month").html(result.token.card.exp_month);
        $("#myModal").modal({backdrop: false});
        $("#myModal").modal('show');
    }
}

cardNumberElement.on('change', function(event) {
  setOutcome(event);
});


function confirm_payment(){
    stripe.createToken(cardNumberElement).then(setOutcome);
}

function sendCard() {
        $("#sendBtn").attr('disabled',true);
        stripe.confirmCardPayment("{{ session('data')['clientSecret'] }}", {
            payment_method: {
                card: cardNumberElement,
            }
        }).then(function(result) {
            if (result.error) {
                alert("失敗しました。");
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    var paymentIntent = result.paymentIntent;
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var form = document.getElementById('form');
                    var url = form.action;
                    var redirect = '/payment/'+"{{ session('data')['type'] }}"+'/thanks';

                    fetch(
                        url,
                        {
                            headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": token
                            },
                            method: 'post',
                            body: JSON.stringify({
                                //je dois envoyer ça vers store action dans mon controller de checkout afin de stockers les info sur DB
                                paymentIntent: paymentIntent,

                            })
                        }

                    )
                    .then(response => response.json())
                    .then(data => {
                        if(data.success)
                            window.location.href = redirect;
                        else
                            alert(data.message);
                    })
                    .catch((error) => {
                        console.log(error)
                    })
                }
            }
        });
    }

</script>
@endsection
