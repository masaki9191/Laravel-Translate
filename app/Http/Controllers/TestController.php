<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
class TestController extends Controller
{
    public function index() {
        // \Stripe\Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');

        // \Stripe\Account::update(
        //   'acct_1I86GbPWaSF4GvNt',
        //   [
        //     'individual' => [
        //         'address_kana' => [
        //             'city'=>'イシカリシ',
        //             'country'=>'JP',
        //             'line1'=>'2-14-19',
        //             'line2'=>'101',
        //             'postal_code'=>'061-3251',
        //             'state'=>'ホッカイドウ',
        //             'town'=>'タルカワ'
        //         ],
        //         'address_kanji' => [
        //             'city'=>'石狩市',
        //             'country'=>'JP',
        //             'line1'=>'2-14-19',
        //             'line2'=>'101',
        //             'postal_code'=>'061-3251',
        //             'state'=>'北海道',
        //             'town'=>'樽川'
        //         ],
        //         'dob'=>[
        //             'day'=>1,
        //             'month'=>1,
        //             'year'=>1990
        //         ],
        //         'email'=>'lion@lion.com',
        //         'first_name_kana'=>'ミヤコ',
        //         'first_name_kanji'=>'美夜子',
        //         'gender'=>'male',
        //         'last_name_kana'=>'コサカ',
        //         'last_name_kanji'=>'高坂',
        //     ],
        //   ]
        // );
        // \Stripe\Stripe::setApiKey("sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n");

        // \Stripe\Charge::create(array(
        //     'currency' => 'jpy',
        //     'amount'   => 1234,
        //     'card'     => 4242424242424242
        // ));
        // \Stripe\Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');

        // $balance = \Stripe\Balance::retrieve(
        //     ['stripe_account' => '{{CONNECTED_STRIPE_ACCOUNT_ID}}']
        // );
        // dd($abc);


        // $stripe = new \Stripe\StripeClient(
        //     'sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n'
        //   );
        //   $stripe->payouts->create([
        //     'amount' => 100,
        //     'currency' => 'jpy',
        //   ]);
        //     $stripe = new \Stripe\StripeClient(
        //     'sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n'
        //   );
        //   $stripe->accounts->create([
        //     'business_type' => 'individual',
        //     'type' => 'custom',
        //     'country' => 'JP',
        //     'email' => 'lion@lion.com',
        //     'capabilities' => [
        //       'card_payments' => ['requested' => true],
        //       'transfers' => ['requested' => true],
        //     ],
        //     'individual' => [
        //         'address_kana' => [
        //             'city'=>'イシカリシ',
        //             'country'=>'JP',
        //             'line1'=>'2-14-19',
        //             'line2'=>'101',
        //             'postal_code'=>'061-3251',
        //             'state'=>'ホッカイドウ',
        //             'town'=>'タルカワ'
        //         ],
        //         'address_kanji' => [
        //             'city'=>'石狩市',
        //             'country'=>'JP',
        //             'line1'=>'2-14-19',
        //             'line2'=>'101',
        //             'postal_code'=>'061-3251',
        //             'state'=>'北海道',
        //             'town'=>'樽川'
        //         ],
        //         'dob'=>[
        //             'day'=>1,
        //             'month'=>1,
        //             'year'=>1990
        //         ],
        //         'email'=>'lion@lion.com',
        //         'first_name_kana'=>'ミヤコ',
        //         'first_name_kanji'=>'美夜子',
        //         'gender'=>'male',
        //         'last_name_kana'=>'コサカ',
        //         'last_name_kanji'=>'高坂',
        //         'phone'=>'+818032017556'
        //     ],
        //     'external_account' => [
        //         'object'=>'bank_account',
        //         'country'=>'JP',
        //         'currency'=>'jpy',
        //         'account_holder_name'=>'スズキジ',
        //         'account_holder_type'=>'individual',
        //         'routing_number'=>'1100000',
        //         'account_number'=>'0001234'
        //     ],
        //     'tos_acceptance' => [
        //         'date' => time(),
        //         'ip' => $_SERVER['REMOTE_ADDR'], // Assumes you're not using a proxy
        //     ]
        //   ]);
        \Stripe\Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');

        \Stripe\Account::update(
          'acct_1I8MABPmeS3XtY1W',
          [
              'settings' => [
                  'payouts' => [
                      'schedule' => [
                        "delay_days" => 4,
                        "interval" => "monthly",
                        "monthly_anchor" => "5"
                      ]
                  ]
              ]
          ]);
        // $stripe = new \Stripe\StripeClient(
        //     'sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n'
        // );
        // $stripe->accounts->delete(
        // 'acct_1I86GbPWaSF4GvNt',
        // []
        // );

    }
    public function transfer(Request $request)
    {
        $data = json_decode($request->getBody(), true);

        $transfer = \Stripe\Transfer::create([
          "amount" => $data['amount'],
          "currency" => "usd",
          "destination" => $data['account']
        ]);

        return $response->withJson(array(
          'transfer' => $transfer,
        ));
    }
    public function platformbalance()
    {
        return  response()->json($this->getBalanceUsd());
    }

    public function addplatformbalance(Request $request)
    {
        $data = json_decode($request->getBody(), true);
        Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');
        try {
          \Stripe\Topup::create([
            'amount' => $data['amount'],
            'currency' => 'usd',
            'description' => 'Stripe sample top-up',
            'statement_descriptor' => 'Stripe sample',
          ]);
        } catch (\Stripe\Error $e) {
          return $response->withJson(array(
            'error' => $e,
          ));
        }
        return  response()->json($this->getBalanceUsd());
    }
    public function recentaccounts()
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n'
        );
        $stripe->accounts->create([
            'business_type' => 'individual',
            'country' => 'JP',
            'email' => 'jenny.rosen@example.com',
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
            'type' => 'custom',
        ]);





        // "external_accounts": {
        //     "object": "list",
        //     "data": [
        //       {
        //         "id": "ba_1I0OfPBqKvRbTwiob5EkT59M",
        //         "object": "bank_account",
        //         "account": "acct_1I0O4sBqKvRbTwio",
        //         "account_holder_name": "スズキジュンジ",
        //         "account_holder_type": null,
        //         "available_payout_methods": [
        //           "standard"
        //         ],
        //         "bank_name": "横浜銀行",
        //         "country": "JP",
        //         "currency": "jpy",
        //         "default_for_currency": true,
        //         "fingerprint": "bneCryhmoDUROufu",
        //         "last4": "5125",
        //         "metadata": {},
        //         "routing_number": "0138613",
        //         "status": "new"
        //       }
        //     ]


        // \Stripe\PaymentIntent::create([
        //     'amount' => 1000,
        //     'currency' => 'usd',
        //     'payment_method_types' => ['card_present'],
        //     'capture_method' => 'manual',
        //     'application_fee_amount' => 200,
        //     'on_behalf_of' => $account["id"],
        //     'transfer_data' => [
        //       'destination' => $account["id"],
        //     ],
        //   ]);
        // $stripe = new \Stripe\StripeClient(
        //     'sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n'
        //   );
        // $stripe->accounts->delete(
        // 'acct_1I3nNNPlSavO7xav',
        // []
        // );

        $accounts = \Stripe\Account::all(['limit' => 10]);
        return  response()->json(array('accounts' => $accounts));
    }
    public function expressdashboardlink(Request $request)
    {
        $account_id = $request->account_id;
        $link = \Stripe\Account::createLoginLink(
          $account_id,
          ['redirect_url' => '/test/test']
        );
        return  response()->json(array('url' => $link->url));
    }


    public function isUsd($b) {
        return $b['currency'] == 'usd';
    }
    public function getBalanceUsd() {
        Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');
        $balance = \Stripe\Balance::retrieve();
        //$usdBalance = array_filter($balance['available'], $this->isUsd())[0]['amount'];
        $usdBalance = $balance['available'][0]['currency'];
        return array(
          'balance' => $usdBalance ? $usdBalance : 0
        );
    }


    public function personal(){
        return view('personal.index');
    }
    public function createpersonal(){
        $stripe = new \Stripe\StripeClient(
            'sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n'
        );
        $account = $stripe->accounts->create([
            'business_type' => 'individual',
            'country' => 'US',
            'email' => 'lion@example.com',
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
            'type' => 'custom',
        ]);

        \Stripe\Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');

        $token = $_POST['token-person'];
        $person = \Stripe\Account::createPerson(
            $account["id"], // id of the account created earlier
        [
            'person_token' => $token,
        ]
        );
    }
    public function del(){
        $stripe = new \Stripe\StripeClient(
            'sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n'
        );
        $stripe->accounts->delete(
        ['acct_1I4KzVPlFN5spDyP','acct_1I4KyCPfnqV9bmV0','acct_1I4KtaPkSEuGoon5','acct_1I4KtHPjaByMDY0W'],
        []
        );
    }


}
