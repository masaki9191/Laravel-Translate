<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Translate;
use App\Models\Conversation;
use App\Models\Appointment;
use App\Models\AdminTicket;

class AdminController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('admin');
    }
    public function login(){
        return view('admin.login');
    }
    public function loginPost(Request $request){
        $pwd = $request->password;
        if($pwd == "hello")
        {
            session(["admin" => true]);
            return redirect()->route('admin.deposit');
        }
        else
            return back();
    }
    public function deposit($year1 = null, $month1 = null, Request $request){
        $categorys = DB::select('select * from categorys');
        $conversations = DB::table('ticketprices')->where('type', 1)->get();
        $intergretions = DB::table('ticketprices')->where('type', 2)->get();
        $translation_total_price = Translate::all()->sum('price');
        $translation_category_count = [];
        $ticket_amount = [0,0,0,0];
        $translation_category_sum = 0;
        $conversation_ticket = 0;
        $translation_price_sum = 0;
        for($i=0;$i<=9;$i++)
        {
            $translation_category_count[$i] = 0;
        }

        //dd($month);
        $year = $request->year;
        $month = $request->month;
        session(['year' => $year]);
        session(['month' => $month]);
        if($year!=null && $month!=null)
        {
            $from = date($year.'-'.$month.'-01');
            $to = date($year.'-'.$month.'-31');
            for($i=0;$i<=9;$i++)
            {
                $translation_category_count[$i] = Translate::where('category',$i)->whereBetween('created_at', [$from, $to])->sum('count');
            }
            $translation_category_sum =Translate::whereBetween('created_at', [$from, $to])->sum('count');
            $translation_price_sum =Translate::whereBetween('created_at', [$from, $to])->sum('price');

            for($j=1;$j<=4;$j++)
            {
                $ticket_amount[$j-1] = AdminTicket::where('ticketprice_id',$j)->whereBetween('created_at', [$from, $to])->sum('amount');
            }
        }
        $total_price =$translation_price_sum + $ticket_amount[0] * $conversations[0]->price + $ticket_amount[1] * $intergretions[0]->price + $ticket_amount[2] * $intergretions[1]->price + $ticket_amount[3] * $intergretions[2]->price;
        return view('admin.deposit',compact('categorys', 'conversations', 'intergretions', 'translation_total_price', 'translation_category_count','translation_category_sum','conversation_ticket','ticket_amount','total_price'));
    }
    public function updateCategory(Request $request)
    {
        $id = $request->id;
        $key = $request->key;
        $value = $request->value;
        $affected = DB::table('categorys')->where('id', $id)->update([ $key => $value ]);
        return response()->json(['success'=>'Added new records.']);
    }
    public function updateTicket(Request $request)
    {
        $id = $request->id;
        $key = $request->key;
        $value = $request->value;
        $affected = DB::table('ticketprice')->where('id', $id)->update([ $key => $value ]);
        return response()->json(['success'=>'Added new records.']);
    }

    public function userList($type = null , $value =null){
        if($type == null){
            $users = User::where('type','>',0)->orderBy('type', 'desc')->paginate(8);
        }
        else
        {
            $users = User::where('type','>',0)->where($type, $value)->orderBy('type', 'desc')->paginate(8);
            session([$type => $value]);
            //dd($type);
        }
        return view('admin.userlist',compact('users'));
    }
    public function userTypeList() {
        $data = [];
        $sum = [0,0,0];
        for($i=0;$i<=6;$i++)
        {
            $data[$i] = [0,0,0];
            for($j=1;$j<=3;$j++)
            {
                $data[$i][$j-1]= User::where('type',$j)->where('language', $i)->get()->count();
                $sum[$j-1] += $data[$i][$j-1];
            }
        }
        return view('admin.userTypeList',compact('data','sum'));
    }
    public function requestList(){
        $order_contents = Translate::where('status', 0)->get();
        return view('admin.requestList',compact('order_contents'));
    }

    public function requestTable(){
        $data = [];
        $sum = [0,0,0];
        for($i=0;$i<=6;$i++)
        {

            $data[$i][0]=Translate::where('language', $i)->get()->count();
            $sum[0] += $data[$i][0];
            $data[$i][1]= Appointment::where('service_type',"conversation")->where('language', $i)->get()->count();
            $sum[1] += $data[$i][1];
            $data[$i][2]= Appointment::where('service_type',"interpretation")->where('language', $i)->get()->count();
            $sum[2] += $data[$i][2];
        }
        $dataByCategory = [];
        $dataByCategory[0]=Translate::whereBetween('category', [0,1])->get()->count();
        $dataByCategory[1]=Translate::whereBetween('category', [2,2])->get()->count();
        $dataByCategory[2]=Translate::whereBetween('category', [3,6])->get()->count();
        $dataByCategory[3]=Translate::whereBetween('category', [7,7])->get()->count();
        $dataByCategory[4]=Translate::whereBetween('category', [8,9])->get()->count();
        $bigCategory = ["EC","旅行","ビジネス","IT","WEBその他"];
        $sumCategory = 0;
        for($i=0; $i<5; $i++)
        {
            $sumCategory +=$dataByCategory[$i];
        }
        return view('admin.requestTable',compact('data','dataByCategory','bigCategory', 'sum', 'sumCategory'));
    }
}
