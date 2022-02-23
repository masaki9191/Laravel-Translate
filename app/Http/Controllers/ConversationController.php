<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Appointment;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\AppointmentEmail;
use Mail;
use Stripe\Stripe;

class ConversationController extends Controller
{
    public function conversationList()
    {

    }

    public function getConversator(Request $request)
    {
        $id = $request->id;
        $user = User::where('id', $id)->first();
        $user['language'] = config('myconfig.language')[$user['language']];
        $user['name'] = config('myconfig.user_type')[2]."  ".$user['name'];

        return response()->json($user);
    }

    public function create($conversator_id = "")
    {
        $conversations = User::where('type', 2)->paginate(8);
        return view('conversation.client.create', compact('conversations','conversator_id'));
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
        $data['service_type'] = "conversation";
        $appointment = Appointment::create($data);

        //$this->sendMail($request->worker_id);
        if($request->type == 1)
            return redirect()->route('conversation.chat', $appointment->id);
        else
            return view('conversation.client.thanks');
    }

    public function chat($appointment_id){
        $appointment = Appointment::where('id', $appointment_id)->first();
        if(auth()->user()->type > 0)
            $search_user = $appointment->order;
        else
            $search_user = $appointment->worker;
        return view('conversation.chat', compact('search_user','appointment_id'));
    }

    public function videochat($appointment_id) {
        $appointment = Appointment::where('id', $appointment_id)->first();
        $count = 0;
        $ticket = Ticket::where('buyer_id', $appointment->order_id)->where('ticketprice_id', 1)->first();
        if($ticket != null)
            $count = $ticket->amount;
        if(auth()->user()->type > 0){
            $search_user = $appointment->order;
            $search_user['name'] = config('myconfig.user_type')[0]."  ".$search_user['name'];
        }
        else{
            $search_user = $appointment->worker;
            $search_user['language'] = config('myconfig.language')[$search_user['language']];
            $search_user['name'] = config('myconfig.user_type')[2]."  ".$search_user['name'];
        }
        return view('conversation.videochat', compact('search_user','appointment_id','count'));
    }

    public function ticket(){
        $ticket  = DB::select('select * from ticketprices where type = 1');
        return view('conversation.client.ticket', compact('ticket'));
    }

    public function ticketsList(){
        $ticket = Ticket::where(['buyer_id' => auth()->user()->id, 'ticketprice_id' => 1])->first();
        return view('conversation.client.ticketsList', compact('ticket'));
    }

    public function decreaseTicket(Request $request){
        Ticket::where('buyer_id', auth()->user()->id)->where('ticketprice_id', $request->ticketprice_id)->update(['amount' => $request->amount]);
        $conversation = new Conversation;
        $conversation->user_id = $request->worker_id;
        $conversation->save();
        //pay
        $this->selfPayment(300);
    }

    public function progressAppointments() {
        $user = auth()->user();
        if($user->type == 0){
            $datas = Appointment::where('order_id', $user->id)->where('service_type', 'conversation')->get();
            return view('conversation.client.progressAppointments', compact('datas'));
        }
        else{
            $datas = Appointment::where('worker_id', $user->id)->get();
            return view('conversation.worker.progressAppointments', compact('datas'));
        }
    }

    public function payment(Request $request) {
        if(auth()->user()->type == 2)
        {
            $year = $request->year;
            $month = $request->month;
            if($year != null || $month != null)
            {
                $from = date($year.'-'.$month.'-01');
                $to = date($year.'-'.$month.'-31');
                //$newformat = date('Y-m-d',$time);::whereBetween('reservation_from', [$from, $to])
                $count = Conversation::where('user_id',auth()->user()->id)->whereBetween('created_at', [$from, $to])->count();
            }
            else{
                $count = 0;
            }
            return view('conversation.worker.payment',compact('count'));
        }

    }
    public function sendMail($worker_id){
        $user = User::where('id',$worker_id)->first();
        $details = [
            'title' => '（会話依頼）',
            'body' => '会話の依頼が来ていますので、早急に以下URLをクリックし仕事詳細を確認してください。',
            'url' => route('conversation.progressAppointments')
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
