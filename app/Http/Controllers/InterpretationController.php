<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interpretation;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Ticketprice;
use App\Models\Appointment;
use App\Models\Receipt;
use Illuminate\Support\Facades\File;
use App\Mail\AppointmentEmail;
use Mail;
use Stripe\Stripe;

class InterpretationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function interpretationList()
    {

    }

    public function getInterpretor(Request $request)
    {
        $id = $request->id;
        $user = User::where('id', $id)->first();
        $user['language'] = config('myconfig.language')[$user['language']];
        $user['name'] = $user['name'];
        $user['category'] = config('myconfig.category')[$user['category']];

        return response()->json($user);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticketprice  = Ticketprice::where('type',2)->get();
        $interpretors = User::where('type', 3)->paginate(8);
        $ticket  = Ticket::where('buyer_id',auth()->user()->id)->where('ticketprice_id','>',1)->get();
        return view('interpretation.client.create', compact('interpretors','ticketprice','ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['service_type'] = "interpretation";
        $appointment = Appointment::create($data);
        //pay
        $this->selfPayment($appointment->sum_time  * 100);

        $interpretation = new Interpretation;
        $interpretation->user_id = $request->worker_id;
        $interpretation->sum_time = $request->sum_time;
        $interpretation ->save();
        if($data['count1'] != null){
            $ticket = Ticket::where('buyer_id',$data['order_id'])->where('ticketprice_id', 2)->first();
            $amount = $ticket['amount'] - $data['count1'];
            $ticket->update(["amount"=> $amount]);
        }
        if($data['count5'] != null){
            $ticket = Ticket::where('buyer_id',$data['order_id'])->where('ticketprice_id', 3)->first();
            $amount = $ticket['amount'] - $data['count5'];
            $ticket->update(["amount"=> $amount]);
        }
        if($data['count10'] != null){
            $ticket = Ticket::where('buyer_id',$data['order_id'])->where('ticketprice_id', 4)->first();
            $amount = $ticket['amount'] - $data['count10'];
            $ticket->update(["amount"=> $amount]);
        }
        //$this->sendMail($request->worker_id);
        if($request->type == 1)
            return redirect()->route('interpretation.chat', $appointment->id);
        else
            return view('interpretation.client.thanks');
    }
    public function chat($appointment_id){
        $appointment = Appointment::where('id', $appointment_id)->first();
        if(auth()->user()->type > 0)
            $search_user = $appointment->order;
        else
            $search_user = $appointment->worker;
        return view('interpretation.chat', compact('search_user','appointment_id'));
    }
    public function ticket(){
        $ticket  = Ticketprice::where('type',2)->get();
        return view('interpretation.client.ticket', compact('ticket'));
    }

    public function ticketsList(){
        $ticketprice  = Ticketprice::where('type',2)->get();
        $ticket  = Ticket::where('buyer_id',auth()->user()->id)->where('ticketprice_id','>',1)->get()->toArray();
        //dd($ticket[0]['amount']);
        return view('interpretation.client.ticketsList', compact('ticket','ticketprice'));
    }

    public function receiptList(){
        $receipts =  Receipt::where("user_id", auth()->user()->id)->get();
        return view('interpretation.client.receiptsList', compact('receipts'));
    }

    public function progressAppointments() {
        $user = auth()->user();
        if($user->type == 0){
            $datas = Appointment::where('order_id', $user->id)->where('service_type', 'interpretation')->get();
            return view('interpretation.client.progressAppointments', compact('datas'));
        }
        else{
            $datas = Appointment::where('worker_id', $user->id)->get();
            return view('interpretation.worker.progressAppointments', compact('datas'));
        }
    }

    public function payment(Request $request) {
        if(auth()->user()->type == 3)
        {
            $year = $request->year;
            $month = $request->month;
            if($year != null || $month != null)
            {
                $from = date($year.'-'.$month.'-01');
                $to = date($year.'-'.$month.'-31');
                //$newformat = date('Y-m-d',$time);::whereBetween('reservation_from', [$from, $to])
                $sum_time = Appointment::where('worker_id',auth()->user()->id)->whereBetween('created_at', [$from, $to])->sum('sum_time');
                session(['year' => $year]);
                session(['month' => $month]);
            }
            else{
                $sum_time = 0;
            }
            return view('interpretation.worker.payment',compact('sum_time'));
        }

    }
    public function sendMail($worker_id){
        $user = User::where('id',$worker_id)->first();
        $details = [
            'title' => '（通訳依頼）',
            'body' => '通訳依頼が来ていますので、早急に以下URLをクリックし仕事詳細を確認してください。',
            'url' => route('interpretation.progressAppointments')
        ];
        Mail::to($user->email)->send(new AppointmentEmail($details) );
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
