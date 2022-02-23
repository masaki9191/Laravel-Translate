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
</style>
@endsection
@section('content')

<div class="item-center">
    <div class="col-md-8 row" style="padding-top: 8%;">
        <div class="col-12 col-sm-12 col-md-5">
            <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link " id="card-tab" href="{{route('payment.cardpay')}}" role="tab" aria-controls="card" aria-selected="true">
                        <div class="text-center"><img src="{{ asset('assets/img/payment/card.png') }}" style="width: 170px;height: 40px;"/></div>
                        <div class="text-center">クレジット決済</div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="google-pay-tab" href="{{route('payment.applepay')}}" role="tab" aria-controls="google-pay" aria-selected="false">

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
                <div class="tab-pane fade" id="card" role="tabpanel" aria-labelledby="card-tab4">

                </div>
                <div class="tab-pane fade show active text-center" id="google-pay" role="tabpanel" aria-labelledby="google-pay-tab4">
                    <div id="payment-request-button">
                    <!-- A Stripe Element will be inserted here. -->
                    </div>
                </div>
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
var paymentRequest = stripe.paymentRequest({
  country: 'JP',
  currency: 'jpy',
  total: {
    label: 'Demo total',
    amount: {{ session('data')['price'] }},
  },
  requestPayerName: true,
  requestPayerEmail: true,
});
var prButton = elements.create('paymentRequestButton', {
  paymentRequest: paymentRequest,
});

// Check the availability of the Payment Request API first.
paymentRequest.canMakePayment().then(function(result) {
  if (result) {
    prButton.mount('#payment-request-button');
  } else {
    document.getElementById('payment-request-button').style.display = 'none';
  }
});
paymentRequest.on('paymentmethod', function(ev) {
  // Confirm the PaymentIntent without handling potential next actions (yet).
  stripe.confirmCardPayment(
    "{{ session('data')['clientSecret'] }}",
    {payment_method: ev.paymentMethod.id},
    {handleActions: false}
  ).then(function(confirmResult) {
    if (confirmResult.error) {
      // Report to the browser that the payment failed, prompting it to
      // re-show the payment interface, or show an error message and close
      // the payment interface.
      ev.complete('fail');
    } else {
        // Report to the browser that the confirmation was successful, prompting
        // it to close the browser payment method collection interface.
        ev.complete('success');

        var paymentIntent = confirmResult.paymentIntent;
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var url = "/payment/{{ session('data')['type'] }}store";
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
  });
});
</script>
@endsection
