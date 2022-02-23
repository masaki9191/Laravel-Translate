<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Translate;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Mail\TEmail;
use Illuminate\Support\Facades\DB;
use Mail;
use Stripe\Stripe;

class TranslationController extends Controller
{

    public function create($big_category)
    {
        $categorys =  DB::table('categorys')->get();
        $order_id = auth()->user()->id;
        return view('translation.client.create', compact('order_id','big_category','categorys'));
    }
    public function requestlist()
    {
        $id = auth()->user()->id;
        $order_contents = Translate::where('status', 0)->get();
        return view('translation.worker.requestlist', compact('order_contents'));
    }

    public function orderAccept($id = 0)
    {
        $translate = Translate::where('id', $id)->first();

        if($translate->status == 0) {
            $data = Translate::where('id', $id)->update(['status' => 1,'translator_id' => auth()->user()->id]);
            //pay
            $this->selfPayment($translate->price * 0.75);
            return view('translation.worker.accept_thanks',compact('translate'));
        } else {
            return view('translation.worker.accept_error');
        }
    }

    public function translatorList($language)
    {
        $translators = User::where(['type' => 1, 'language' => $language])->paginate(8);
        return view('translation.client.translatorlist', compact('translators'));
    }

    public function progresslist() {
        $user = auth()->user();
        if($user->type == 0){
            $datas = Translate::where('order_id', $user->id)->get();
            return view('translation.client.progresslist', compact('datas'));
        }
        else{
            $datas = Translate::where('translator_id', $user->id)->where('status','>', 0)->get();
            return view('translation.worker.progresslist', compact('datas'));
        }
    }

    public function show($id) {
        $data = Translate::where('id', $id)->where('order_id',auth()->user()->id)->first();
        $translator = $data->worker;
        return view('translation.client.show', compact('data','translator'));
    }
    public function client_workspace(Request $request){
        $id = $request->translator_id;
        $job_id = $request->job_id;
        $search_user = User::where('id',$id)->first();
        return view('translation.client.chat', compact('search_user','job_id'));
    }
    public function worker_workspace($job_id){
        $translate = Translate::where('id',$job_id)->first();
        $order_id = $translate->order_id;
        $search_user = User::where('id',$order_id)->first();
        return view('translation.worker.chat', compact('search_user','translate'));
    }
    public function delivery(Request $request){
        Translate::where('id',$request->job_id)->update(['delivery_text' => $request->delivery_text, 'status' => 2]);
        $translate = Translate::where('id',$request->job_id)->first();
        //$this->sendMail($translate->order_id,$request->job_id);
        return view('translation.worker.delivery_thanks', compact('translate'));
    }
    public function delivery_view($job_id){
        $translate = Translate::where('id',$job_id)->first();
        return view('translation.client.delivery_view', compact('translate'));
    }
    public function delivery_cancel($job_id){
        Translate::where('id',$job_id)->update(['status'=> 1]);
        return redirect()->route('translation.progresslist');
    }
    public function sendMail($order_id, $job_id){
        $user = User::where('id',$order_id)->first();
        $details = [
            'title' => '（翻訳完了時）',
            'name' => $user->name,
            'body' => 'ご依頼いただいておりました翻訳完了いたしましたので、
                以下URLをクリックいただき内容をご確認ください。お仕事詳細はマイページよりご確認ください',
            'url' => route('translation.delivery.view',$job_id)
        ];
        Mail::to($user->email)->send(new TEmail($details) );
    }
    public function endlist(){
        $user = auth()->user();
        if($user->type == 0){
            $datas = Translate::where('order_id', $user->id)->where('status', 2)->get();
            return view('translation.client.endlist', compact('datas'));
        }
        else{
            $datas = Translate::where('translator_id', $user->id)->where('status', 2)->get();
            return view('translation.worker.endlist', compact('datas'));
        }
    }
    public function receipt($job_id) {
        $data = Translate::where('id',$job_id)->first();
        return view('translation.client.receipt', compact('data'));
    }
    public function payment(Request $request) {

        $categorys =  DB::table('categorys')->get();
        if(auth()->user()->type == 1)
        {
            $year = $request->year;
            $month = $request->month;
            if($year != null || $month != null)
            {
                $from = date($year.'-'.$month.'-01');
                $to = date($year.'-'.$month.'-31');
                //$newformat = date('Y-m-d',$time);::whereBetween('reservation_from', [$from, $to])
                $all_price = Translate::where('translator_id',auth()->user()->id)->where('status',2)->whereBetween('updated_at', [$from, $to])->sum('price');
                $datas = Translate::where('translator_id',auth()->user()->id)->where('status',2)->whereBetween('updated_at', [$from, $to])->get();
            }
            else{
                $all_price = Translate::where('translator_id',auth()->user()->id)->where('status',2)->sum('price');
                $datas = Translate::where('translator_id',auth()->user()->id)->where('status',2)->get();
            }
            return view('translation.worker.payment',compact('datas','all_price','categorys'));
        }

    }

    public function destroy(Translate $translate)
    {

        if($translate->state > 0)
            return redirect()->back();
        else
        {
            $translate->delete();
            return view("translation.client.cancel_thanks");
        }
    }

    public function selfPayment($amount){
        $stripe = new \Stripe\StripeClient(
        'sk_test_51I0O4sBqKvRbTwioLm5rYwo86BmYpGrqiEg5FESy84tgiuFmSR8vPdKQ4Hzmijxjy38PBFZDbcVKZltK6QhRZsFV00WsQLX77n'
        );
        $stripe->transfers->create([
            'amount' => intval($amount),
            'currency' => 'jpy',
            'destination' => auth()->user()->stripe_id
        ]);
    }
}
