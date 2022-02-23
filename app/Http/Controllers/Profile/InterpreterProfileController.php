<?php

namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Traits\MediaUploadingTrait;

class InterpreterProfileController extends Controller
{
    use MediaUploadingTrait;
    public function create()
    {
        $path = storage_path() . "/json/bank/banks.json";
        $banks = json_decode(file_get_contents($path), true);
        return view('profile.interpreter.create',compact('banks'));
    }
    public function store(Request $request)
    {
        $rule = [
            'surname' => 'required',
            'lastname' => 'required',
            'seiname' => 'required',
            'meiname' => 'required',
            'name' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'confirmed'
            ],
            'skype_id' => 'required',

            //career
            'language' => 'required',
            'category' => 'required',
            'performance' => 'required',
            'other_point' => 'required',
            'experience_year' => 'required',

            //payment
            'financial_institution_name' => 'required',
            'financial_branch_name' => 'required',
            'account_number' => 'required',
            'account_holder' => 'required'
        ];
        $data = $request->except('_token','password_confirmation','file','del_flag');
        if(isset($data['abroad']) ) {
            $data['abroad'] = 1;
        }
        else {
            $data['abroad'] = null;
        }
        if(isset($data['agree']) ) {
            $data['agree'] = 1;
        }
        else {
            $data['agree'] = null;
        }

        $validatedData = $request->validate($rule);

        $data['password'] = bcrypt($data['password']);

        $id = auth()->id();
        $stripe_id = $this->stripe_create($data);
        $data['stripe_id'] = $stripe_id;
        User::where('id', $id)->update($data);
        $user = auth()->user();
        // file upload
        $file = $request->file('file');
        $avatar = (object)[];
        if($request->has('del_flag')) {
            $media = $user->getMedia('avatar');
            $media[0]->delete();
        }
        else {
            if($file != null){
                if ($user->avatar != "")
                {
                    $media = $user->getMedia('avatar');
                    $media[0]->delete();
                }
                $avatar = $this->storeMedia($request)->getData();
                $path = storage_path('tmp/uploads/');

                $user->addMedia($path . $avatar->name)->toMediaCollection('avatar');
            }
        }

        return view('profile.interpreter.thanks');
    }
    public function update_basic_get()
    {
        return view('profile.interpreter.basic');
    }
    public function update_basic(Request $request)
    {
        $rule = [
            'surname' => 'required',
            'lastname' => 'required',
            'seiname' => 'required',
            'meiname' => 'required',
            'name' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'confirmed'
            ],
            'skype_id' => 'required'
        ];
        $data = $request->except('_token','password_confirmation','file','del_flag');
        if(isset($data['abroad']) ) {
            $data['abroad'] = 1;
        }
        else {
            $data['abroad'] = null;
        }

        $validatedData = $request->validate($rule);

        $data['password'] = bcrypt($data['password']);

        $id = auth()->id();

        User::where('id', $id)->update($data);
        $user = auth()->user();
        // file upload
        $file = $request->file('file');
        $avatar = (object)[];
        if($request->has('del_flag')) {
            $media = $user->getMedia('avatar');
            $media[0]->delete();
        }
        else {
            if($file != null){
                if ($user->avatar != "")
                {
                    $media = $user->getMedia('avatar');
                    $media[0]->delete();
                }
                $avatar = $this->storeMedia($request)->getData();
                $path = storage_path('tmp/uploads/');

                $user->addMedia($path . $avatar->name)->toMediaCollection('avatar');
            }
        }
        return view('profile.interpreter.update_thanks');
    }
    public function update_career_get()
    {
        return view('profile.interpreter.career');
    }
    public function update_career(Request $request)
    {
        $rule = [
        //career
        'language' => 'required',
        'category' => 'required',
        'performance' => 'required',
        'other_point' => 'required',
        'experience_year' => 'required'
        ];
        $data = $request->except('_token');

        $validatedData = $request->validate($rule);
        $id = auth()->id();
        User::where('id', $id)->update($data);

        return view('profile.interpreter.update_thanks');
    }
    public function update_payment_get()
    {
        $path = storage_path() . "/json/bank/banks.json";
        $banks = json_decode(file_get_contents($path), true);
        return view('profile.interpreter.payment',compact('banks'));
    }
    public function update_payment(Request $request)
    {
        $rule = [
            //payment
            'financial_institution_name' => 'required',
            'financial_branch_name' => 'required',
            'account_number' => 'required',
            'account_holder' => 'required'
        ];
        $validatedData = $request->validate($rule);
        $data = $request->except('_token');
        $id = auth()->id();

        $stripe_id = $this->stripe_update($data);
        $data['stripe_id'] = $stripe_id;

        User::where('id', $id)->update($data);

        return view('profile.interpreter.update_thanks');
    }
    public function stripe_create($data){
        $stripe = new \Stripe\StripeClient(
            'sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n'
        );
        $account = $stripe->accounts->create([
            'business_type' => 'individual',
            'type' => 'custom',
            'country' => 'JP',
            'email' => auth()->user()->email,
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
            'individual' => [
                'address_kana' => [
                    'city'=>'イシカリシ',
                    'country'=>'JP',
                    'line1'=>'2-14-19',
                    'line2'=>'101',
                    'postal_code'=>'061-3251',
                    'state'=>'ホッカイドウ',
                    'town'=>'タルカワ'
                ],
                'address_kanji' => [
                    'city'=>'石狩市',
                    'country'=>'JP',
                    'line1'=>'2-14-19',
                    'line2'=>'101',
                    'postal_code'=>'061-3251',
                    'state'=>'北海道',
                    'town'=>'樽川'
                ],
                'dob'=>[
                    'day'=>1,
                    'month'=>1,
                    'year'=>1990
                ],
                'email'=>'lion@lion.com',
                'first_name_kana'=>'ミヤコ',
                'first_name_kanji'=>'美夜子',
                'gender'=>'male',
                'last_name_kana'=>'コサカ',
                'last_name_kanji'=>'高坂',
                'phone'=>'+818032017556'
            ],
            'external_account' => [
                'object'=>'bank_account',
                'country'=>'JP',
                'currency'=>'jpy',
                'account_holder_name'=>$data['account_holder'],
                'account_holder_type'=>'individual',
                'routing_number'=>$data['financial_institution_name'].$data['financial_branch_name'],
                'account_number'=>'0001234'
            ],
            'settings' => [
                'payouts' => [
                    'schedule' => [
                      "delay_days" => 4,
                      "interval" => "monthly",
                      "monthly_anchor" => "5"
                    ]
                ]
            ],
            'tos_acceptance' => [
                'date' => time(),
                'ip' => $_SERVER['REMOTE_ADDR'], // Assumes you're not using a proxy
            ]
        ]);
        return $account['id'];
    }
    public function stripe_update($data){
        \Stripe\Stripe::setApiKey('sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n');

        $account = \Stripe\Account::update(
          auth()->user()->stripe_id,
          [
            'external_account' => [
                'object'=>'bank_account',
                'country'=>'JP',
                'currency'=>'jpy',
                'account_holder_name'=>$data['account_holder'],
                'account_holder_type'=>'individual',
                'routing_number'=>$data['financial_institution_name'].$data['financial_branch_name'],
                //'account_number'=>$data['account_number']
                'account_number'=>'0001234'
            ],
          ]
        );
        return $account['id'];
    }

}
