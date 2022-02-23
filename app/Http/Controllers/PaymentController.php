<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\Receipt;
use App\Models\Ticketprice;
use App\Models\Translate;
use App\Models\AdminTicket;

class PaymentController extends Controller
{

    public function index()
    {
        Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');
        $account = \Stripe\Account::create([
            'country' => 'US',
            'type' => 'custom',
            'capabilities' => [
              'card_payments' => [
                'requested' => true,
              ],
              'transfers' => [
                'requested' => true,
              ],
            ],
        ]);

        \Stripe\PaymentIntent::create([
            'amount' => 1000,
            'currency' => 'usd',
            'payment_method_types' => ['card_present'],
            'capture_method' => 'manual',
            'application_fee_amount' => 200,
            'on_behalf_of' => $account["id"],
            'transfer_data' => [
              'destination' => $account["id"],
            ],
          ]);


        // \Stripe\Customer::create(
        //     ["email" => "person@example.edu"],
        //     ["stripe_account" => $account["id"]]
        // );

        // // Fetching an account just needs the ID as a parameter
        // \Stripe\Account::retrieve($account["id"]);
    }

    public function create()
    {
        Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => 10000,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        $clientSecret = Arr::get($intent,'client_secret');

        return view('payment.index',['clientSecret' => $clientSecret, 'amount' => 10000]);
    }


    public function store(Request $request)
    {
        $data = $request->json()->all();

        if($data['paymentIntent']['status'] == 'succeeded'){
            $payment = new Payment();
            $payment->payment_intent_id = $data['paymentIntent']['id'];
            $payment->amount = $data['paymentIntent']['amount'];
            $payment->user_id = \Auth::id();
            $payment->save();
            return \response()->json(['success' => true, 'msg' => '支払い意図が成功しました']);
        }else{
            return \response()->json(['success' => false, 'msg' => '支払い意図が成功しなかった']);
        }
    }


    public function applepay()
    {
        Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => session('data')['price'],
            'currency' => 'jpy',
        ]);
        $clientSecret = Arr::get($intent,'client_secret');
        session(['data.clientSecret' => $clientSecret]);
        return view("payment.applepay");
    }

    public function cardpay()
    {
        Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => session('data')['price'],
            'currency' => 'jpy',
            'payment_method_types' => ['card'],
        ]);
        $clientSecret = Arr::get($intent,'client_secret');
        session(['data.clientSecret' => $clientSecret]);
        return view("payment.index");
    }

    public function ticket(Request $request)
    {
        $data =  $request->all();

        Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $request->price,
            'currency' => 'jpy',
            'payment_method_types' => ['card'],
        ]);

        $clientSecret = Arr::get($intent,'client_secret');
        $type = "ticket";
        $data['type'] = $type ;
        $data['clientSecret'] = $clientSecret ;
        session(['data' => $data]);
        return view('payment.index');
    }

    public function ticketstore(Request $request)
    {
        $data = $request->json()->all();

        if($data['paymentIntent']['status'] == 'succeeded'){
            $payment = new Payment();
            $payment->payment_intent_id = $data['paymentIntent']['id'];
            $payment->amount = $data['paymentIntent']['amount'];
            $payment->user_id = \Auth::id();
            $payment->purpose = "ticket";
            $payment->save();
            $new_ticket = session('data');
            $conversation_flag = array_key_exists(
                "ticketprice_id", $new_ticket
            );
            if($conversation_flag)
            {
                $ticketprice = Ticketprice::where('type', 1)->first();
                AdminTicket::create(['ticketprice_id'=>1,'amount'=>$new_ticket['amount']]);
                $new_ticket['amount'] = $new_ticket['amount'] * $ticketprice['count'];
                $ticket = Ticket::where('buyer_id',$new_ticket['buyer_id'])->where('ticketprice_id', $new_ticket['ticketprice_id'])->first();
                if(empty($ticket)){
                    Ticket::create($new_ticket);
                }
                else{
                    $new_ticket['amount'] +=$ticket['amount'];
                    $ticket->update($new_ticket);
                    session()->forget('data');
                }
            }
            else{
                $ticket = Ticket::where('buyer_id',$new_ticket['buyer_id'])->where('ticketprice_id', 2)->first();
                AdminTicket::create(['ticketprice_id'=>2,'amount'=>$new_ticket['count1']]);
                if(empty($ticket)){
                    Ticket::create(['buyer_id'=>$new_ticket['buyer_id'],'ticketprice_id'=>2,'amount'=>$new_ticket['count1']]);
                }
                else{
                    $new_ticket['count1'] +=$ticket['amount'];
                    $ticket->update(['amount'=>$new_ticket['count1'] ]);
                }
                $ticket = [];
                $ticket = Ticket::where('buyer_id',$new_ticket['buyer_id'])->where('ticketprice_id', 3)->first();
                AdminTicket::create(['ticketprice_id'=>3,'amount'=>$new_ticket['count5']]);
                if(empty($ticket)){
                    Ticket::create(['buyer_id'=>$new_ticket['buyer_id'],'ticketprice_id'=>3,'amount'=>$new_ticket['count5']]);
                }
                else{
                    $new_ticket['count5'] +=$ticket['amount'];
                    $ticket->update(['amount'=>$new_ticket['count1'] ]);
                }
                $ticket = [];
                $ticket = Ticket::where('buyer_id',$new_ticket['buyer_id'])->where('ticketprice_id', 4)->first();
                AdminTicket::create(['ticketprice_id'=>4,'amount'=>$new_ticket['count10']]);
                if(empty($ticket)){
                    Ticket::create(['buyer_id'=>$new_ticket['buyer_id'],'ticketprice_id'=>4,'amount'=>$new_ticket['count10']]);
                }
                else{
                    $new_ticket['count10'] +=$ticket['amount'];
                    $ticket->update(['amount'=>$new_ticket['count1'] ]);
                }
            }
            Receipt::create(["user_id" => auth()->user()->id, "money" => $payment->amount]);
            return \response()->json(['success' => true, 'msg' => '支払い意図が成功しました']);
        }else{
            return \response()->json(['success' => false, 'msg' => '支払い意図が成功しなかった']);
        }
    }

    public function thanks(){
        return view('payment.thanks');
    }

    public function translation(Request $request)
    {
        $data =  $request->all();

        Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $request->price,
            'currency' => 'jpy',
            'payment_method_types' => ['card'],
        ]);

        $clientSecret = Arr::get($intent,'client_secret');
        $type = "translation";
        $data['type'] = $type ;
        $data['clientSecret'] = $clientSecret ;
        session(['data' => $data]);
        return view('payment.index');
    }

    public function translationstore(Request $request)
    {
        $data = $request->json()->all();

        if($data['paymentIntent']['status'] == 'succeeded'){
            $payment = new Payment();
            $payment->payment_intent_id = $data['paymentIntent']['id'];
            $payment->amount = $data['paymentIntent']['amount'];
            $payment->user_id = \Auth::id();
            $payment->purpose = "translation";
            $payment->save();
            $new_translation = session('data');
            Translate::create($new_translation);

            session()->forget('data');
            return \response()->json(['success' => true, 'msg' => '支払い意図が成功しました']);
        }else{
            return \response()->json(['success' => false, 'msg' => '支払い意図が成功しなかった']);
        }
    }
    public function thanks_translation(){
        return view('payment.thanks_translation');
    }
    public function thanks_ticket(){
        return view('payment.thanks_ticket');
    }

}
