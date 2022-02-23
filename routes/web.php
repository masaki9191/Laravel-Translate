<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\InterpretationController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LoginController;

//profile manager
use App\Http\Controllers\Profile\ClientProfileController;
use App\Http\Controllers\Profile\TranslatorProfileController;
use App\Http\Controllers\Profile\ConversatorProfileController;
use App\Http\Controllers\Profile\InterpreterProfileController;

//mypage
use App\Http\Controllers\MyPage\MypageClientController;
use App\Http\Controllers\MyPage\MypageWorkerController;

//admin
use App\Http\Controllers\AdminController;


use App\Http\Controllers\TestController;
Route::get('test/index', [TestController::class, 'index'])->name('test.index');
Route::post('test/transfer', [TestController::class, 'create'])->name('test.transfer');
Route::get('test/platform-balance', [TestController::class, 'platformbalance'])->name('test.platformbalance');
Route::post('test/add-platform-balance', [TestController::class, 'addplatformbalance'])->name('test.addplatformbalance');
Route::get('test/recent-accounts', [TestController::class, 'recentaccounts'])->name('test.recent-accounts');
Route::get('test/express-dashboard-link', [TestController::class, 'expressdashboardlink'])->name('test.expressdashboardlink');
Route::get('personal/index', [TestController::class, 'personal'])->name('test.personal.index');
Route::post('personal/createpersonal', [TestController::class, 'createpersonal'])->name('test.personal.create');

Route::get('/register/worker', function(){
    if (Auth::check()) {
        Auth::logout();
    }
    return view('auth.worker_register');
})
->name('register.worker');
Route::get('/register/client', function(){
    if (Auth::check()) {
        Auth::logout();
    }
    return view('auth.client_register');
})
->name('register.client');

//LP route
Route::view('/', 'welcome')->name('welcome');

//email verify
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Request $request) {
    $userID = $request['id'];
    $user = User::findOrFail($userID);
    $date = date("Y-m-d g:i:s");
    $user->email_verified_at = $date;
    $user->save();
    $credentials = ["email" => $user->email,"password" => "pwd123", "type" => $user->type];

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
    }
    if($user->type == 0)
    {
        return redirect()->route('profile.client.create');
    }
    if($user->type == 1)
    {
        return redirect()->route('profile.translator.create');
    }
    if($user->type == 2)
    {
        return redirect()->route('profile.conversator.create');
    }
    if($user->type == 3)
    {
        return redirect()->route('profile.interpreter.create');
    }
})->name('verification.verify');


//precautions
Route::view('precautions', 'auth.precautions')->name('auth.precautions');

//privacy
Route::view('privacy', 'auth.privacy')->name('auth.privacy');

//contact
Route::view('contact/complete', 'contact.complete')->name('contact.complete');
Route::resource('contact', ContactController::class);
//category
Route::get('category/ec_site',function(){
    $categorys = DB::table('categorys')->get();
    return view('category.ec_site',compact('categorys'));
})->name('category.ec_site');
Route::get('category/travel',function(){
    $categorys = DB::table('categorys')->get();
    return view('category.travel',compact('categorys'));
})->name('category.travel');
Route::get('category/business_documents_emails',function(){
    $categorys = DB::table('categorys')->get();
    return view('category.business_documents_emails',compact('categorys'));
})->name('category.business_documents_emails');
Route::get('category/web_it',function(){
    $categorys = DB::table('categorys')->get();
    return view('category.web_it',compact('categorys'));
})->name('category.web_it');
Route::get('category/other',function(){
    $categorys = DB::table('categorys')->get();
    return view('category.other',compact('categorys'));
})->name('category.other');

//service
Route::get('service/conversation',function(){
    $ticketprices = DB::table('ticketprices')->get();
    return view('service.conversation',compact('ticketprices'));
})->name('service.conversation');
Route::get('service/interpretation',function(){
    $ticketprices = DB::table('ticketprices')->get();
    return view('service.interpretation',compact('ticketprices'));
})->name('service.interpretation');
Route::view('service/translate', 'service.translate')->name('service.translate');

//guide
Route::view('guide/common', 'guide.common')->name('guide.common');
Route::view('guide/translation', 'guide.translation')->name('guide.translation');
Route::view('guide/conversation', 'guide.conversation')->name('guide.conversation');
Route::view('guide/interpretation', 'guide.interpretation')->name('guide.interpretation');
Route::view('guide/translator', 'guide.translator')->name('guide.translator');
Route::view('guide/conversator', 'guide.conversator')->name('guide.conversator');
Route::view('guide/interpreter', 'guide.interpreter')->name('guide.interpreter');
Route::view('guide/requirement', 'guide.requirement')->name('guide.requirement');
Route::view('guide/file', 'guide.file')->name('guide.file');
Route::get('guide/price', function(){
    $categorys = DB::table('categorys')->get();
    return view('guide.price',compact('categorys'));
})->name('guide.price');

//logout
Route::view('logout/index', 'logout.index')->name('logout.index');
Route::post('logout/out', [LogoutController::class, 'out'])->name('logout.out');
Route::get('login/{type?}', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.post');

Route::middleware('auth', 'verified')->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    //profile register
    Route::get('profile/client/create', [ClientProfileController::class, 'create'])->name('profile.client.create');
    Route::post('profile/client/store', [ClientProfileController::class, 'store'])->name('profile.client.store');
    Route::post('profile/client/update', [ClientProfileController::class, 'update'])->name('profile.client.update');
    Route::get('profile/client/update/basic', [ClientProfileController::class, 'update_basic_get'])->name('profile.client.update_basic_get');
    Route::post('profile/client/update/basic', [ClientProfileController::class, 'update_basic'])->name('profile.client.update_basic');

    Route::get('profile/translator/create', [TranslatorProfileController::class, 'create'])->name('profile.translator.create');
    Route::post('profile/translator/store', [TranslatorProfileController::class, 'store'])->name('profile.translator.store');
    Route::get('profile/translator/update/basic', [TranslatorProfileController::class, 'update_basic_get'])->name('profile.translator.update_basic_get');
    Route::get('profile/translator/update/career', [TranslatorProfileController::class, 'update_career_get'])->name('profile.translator.update_career_get');
    Route::get('profile/translator/update/payment', [TranslatorProfileController::class, 'update_payment_get'])->name('profile.translator.update_payment_get');
    Route::post('profile/translator/update/basic', [TranslatorProfileController::class, 'update_basic'])->name('profile.translator.update_basic');
    Route::post('profile/translator/update/career', [TranslatorProfileController::class, 'update_career'])->name('profile.translator.update_career');
    Route::post('profile/translator/update/payment', [TranslatorProfileController::class, 'update_payment'])->name('profile.translator.update_payment');

    Route::get('profile/conversator/create', [ConversatorProfileController::class, 'create'])->name('profile.conversator.create');
    Route::post('profile/conversator/store', [ConversatorProfileController::class, 'store'])->name('profile.conversator.store');
    Route::get('profile/conversator/update/basic', [ConversatorProfileController::class, 'update_basic_get'])->name('profile.conversator.update_basic_get');
    Route::get('profile/conversator/update/career', [ConversatorProfileController::class, 'update_career_get'])->name('profile.conversator.update_career_get');
    Route::get('profile/conversator/update/payment', [ConversatorProfileController::class, 'update_payment_get'])->name('profile.conversator.update_payment_get');
    Route::post('profile/conversator/update/basic', [ConversatorProfileController::class, 'update_basic'])->name('profile.conversator.update_basic');
    Route::post('profile/conversator/update/career', [ConversatorProfileController::class, 'update_career'])->name('profile.conversator.update_career');
    Route::post('profile/conversator/update/payment', [ConversatorProfileController::class, 'update_payment'])->name('profile.conversator.update_payment');

    Route::get('profile/interpreter/create', [InterpreterProfileController::class, 'create'])->name('profile.interpreter.create');
    Route::post('profile/interpreter/store', [InterpreterProfileController::class, 'store'])->name('profile.interpreter.store');
    Route::get('profile/interpreter/update/basic', [InterpreterProfileController::class, 'update_basic_get'])->name('profile.interpreter.update_basic_get');
    Route::get('profile/interpreter/update/career', [InterpreterProfileController::class, 'update_career_get'])->name('profile.interpreter.update_career_get');
    Route::get('profile/interpreter/update/payment', [InterpreterProfileController::class, 'update_payment_get'])->name('profile.interpreter.update_payment_get');
    Route::post('profile/interpreter/update/basic', [InterpreterProfileController::class, 'update_basic'])->name('profile.interpreter.update_basic');
    Route::post('profile/interpreter/update/career', [InterpreterProfileController::class, 'update_career'])->name('profile.interpreter.update_career');
    Route::post('profile/interpreter/update/payment', [InterpreterProfileController::class, 'update_payment'])->name('profile.interpreter.update_payment');

    Route::post('profile/bank/branch', function(Request $request){
        $bank = $request->code;
        $path = storage_path() . "/json/bank/branches/$bank.json";
        $branches = json_decode(file_get_contents($path), true);
        return response()->json($branches);
    })->name('profile.bank.branch');

    // profile update
    Route::get('profile/worker/basic/update', function () {
        if(Auth::user()->type == 1)
            return redirect()->route('profile.translator.update_basic_get');
        if(Auth::user()->type == 2)
            return redirect()->route('profile.conversator.update_basic_get');
        if(Auth::user()->type == 3)
            return redirect()->route('profile.interpreter.update_basic_get');
    })->name('profile.worker.basic.update');

    Route::get('profile/worker/career/update', function () {
        if(Auth::user()->type == 1)
            return redirect()->route('profile.translator.update_career_get');
        if(Auth::user()->type == 2)
            return redirect()->route('profile.conversator.update_career_get');
        if(Auth::user()->type == 3)
            return redirect()->route('profile.interpreter.update_career_get');
    })->name('profile.worker.career.update');

    Route::get('profile/worker/payment/update', function () {
        if(Auth::user()->type == 1)
            return redirect()->route('profile.translator.update_payment_get');
        if(Auth::user()->type == 2)
            return redirect()->route('profile.conversator.update_payment_get');
        if(Auth::user()->type == 3)
            return redirect()->route('profile.interpreter.update_payment_get');
    })->name('profile.worker.payment.update');

    // mypage
    Route::get('mypage/client',[MypageClientController::class, 'index'])->name('mypage.client.index');
    Route::get('mypage/client/change/{type}',[MypageClientController::class, 'change'])->name('mypage.client.change');
    Route::get('mypage/worker',[MypageWorkerController::class, 'index'])->name('mypage.worker.index');
    Route::get('mypage', function () {
        if(Auth::user()->type == 0)
            return redirect()->route('mypage.client.index');
        else
            return redirect()->route('mypage.worker.index');
    })->name('mypage');

    //payment

    Route::get('payment/index', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('payment/thanks', [PaymentController::class, 'thanks'])->name('payment.thanks');
    Route::get('payment/test', [PaymentController::class, 'test'])->name('payment.test');
    Route::get('payment/applepay', [PaymentController::class, 'applepay'])->name('payment.applepay');
    Route::get('payment/cardpay', [PaymentController::class, 'cardpay'])->name('payment.cardpay');
    Route::post('payment/ticket', [PaymentController::class, 'ticket'])->name('payment.ticket');
    Route::post('payment/ticketstore', [PaymentController::class, 'ticketstore'])->name('payment.ticketstore');
    Route::post('payment/translation', [PaymentController::class, 'translation'])->name('payment.translation');
    Route::post('payment/translationstore', [PaymentController::class, 'translationstore'])->name('payment.translationstore');
    Route::get('payment/translation/thanks', [PaymentController::class, 'thanks_translation'])->name('payment.thanks.translation');
    Route::get('payment/ticket/thanks', [PaymentController::class, 'thanks_ticket'])->name('payment.thanks.ticket');


    //chat
    Route::get('/chat/{type}/{id}', [ChatController::class, 'index'])->name('chat');
    Route::get('/chat', [ChatController::class, 'index']);

    // message
    Route::group(['prefix' => 'message'], function () {
        Route::get('user/{query}', [MessageController::class, 'user']);
        Route::get('user-message/{id}', [MessageController::class, 'message']);
        Route::get('user-message/{id}/read', [MessageController::class, 'read']);
        Route::post('user-message', [MessageController::class, 'send']);
        Route::post('fileupload', [MessageController::class, 'fileupload']);
        Route::get('{uuid}/download', [MessageController::class, 'download'])->name('message.download');
    });


    //translation service
    Route::get('translation/create/{big_category}', [TranslationController::class, 'create'])->name('translation.create');
    Route::get('translation/thanks', [TranslationController::class, 'thanks'])->name('translation.thanks');
    Route::get('translation/requestConfirm', [TranslationController::class, 'requestConfirm'])->name('translation.requestConfirm');
    Route::get('translation/translatorList/{language}', [TranslationController::class, 'translatorList'])->name('translation.translatorList');
    Route::get('translation/orderAccept/{id?}', [TranslationController::class, 'orderAccept'])->name('translation.orderAccept');
    Route::get('translation/progresslist', [TranslationController::class, 'progresslist'])->name('translation.progresslist');
    Route::get('translation/requestlist', [TranslationController::class, 'requestlist'])->name('translation.requestlist');
    Route::get('translation/show/{id}', [TranslationController::class, 'show'])->name('translation.show');
    Route::delete('translation/destroy{translate}', [TranslationController::class, 'destroy'])->name('translation.destroy');
    Route::post('translation/client_workspace', [TranslationController::class, 'client_workspace'])->name('translation.client.workspace');
    Route::get('translation/worker_workspace/{job_id}', [TranslationController::class, 'worker_workspace'])->name('translation.worker.workspace');
    Route::post('translation/worker/delivery', [TranslationController::class, 'delivery'])->name('translation.worker.delivery');
    Route::get('translation/delivery/view/{job_id}', [TranslationController::class, 'delivery_view'])->name('translation.delivery.view');
    Route::get('translation/delivery/cancel/{job_id}', [TranslationController::class, 'delivery_cancel'])->name('translation.delivery.cancel');
    Route::get('translation/endlist', [TranslationController::class, 'endlist'])->name('translation.endlist');
    Route::get('translation/receipt/{job_id}', [TranslationController::class, 'receipt'])->name('translation.receipt');
    Route::post('translation/payment/details', [TranslationController::class, 'payment'])->name('translation.payment.details');

    //update state for worker
    Route::post('worker/state/update', function(Request $request){
        $state = $request->state;
        User::where('id',auth()->user()->id)->update(['state' => $state]);
        return response()->json(['success'=>'Update.']);
    })->name('worker.updateState');


    //interpretation service
    Route::post('interpretation/translatordataGet', [InterpretationController::class, 'translatordataGet'])->name('interpretation.translatordataGet');
    Route::get('interpretation/interpretationList', [InterpretationController::class, 'interpretationList'])->name('interpretation.interpretationList');
    Route::get('interpretation/create', [InterpretationController::class, 'create'])->name('interpretation.create');
    Route::post('interpretation/getInterpretor', [InterpretationController::class, 'getInterpretor'])->name('interpretation.getInterpretor');
    Route::get('interpretation/ticket', [InterpretationController::class, 'ticket'])->name('interpretation.ticket');
    Route::get('interpretation/ticketsList', [InterpretationController::class, 'ticketsList'])->name('interpretation.ticketsList');
    Route::get('interpretation/progressAppointments', [InterpretationController::class, 'progressAppointments'])->name('interpretation.progressAppointments');
    Route::get('interpretation/receiptList', [InterpretationController::class, 'receiptList'])->name('interpretation.receiptList');
    Route::post('interpretation/payment/details', [InterpretationController::class, 'payment'])->name('interpretation.payment.details');
    Route::get('interpretation/chat/{id}', [InterpretationController::class, 'chat'])->name('interpretation.chat');
    Route::resource('interpretation', InterpretationController::class)->except('create');

    //conversation service
    Route::post('conversation/getConversator', [ConversationController::class, 'getConversator'])->name('conversation.getConversator');
    Route::get('conversation/conversationList', [ConversationController::class, 'conversationList'])->name('conversation.conversationList');
    Route::get('conversation/create/{id?}', [ConversationController::class, 'create'])->name('conversation.create');
    Route::get('conversation/chat/{id}', [ConversationController::class, 'chat'])->name('conversation.chat');
    Route::get('conversation/videochat/{id}', [ConversationController::class, 'videochat'])->name('conversation.videochat');
    Route::get('conversation/ticket', [ConversationController::class, 'ticket'])->name('conversation.ticket');
    Route::get('conversation/ticketsList', [ConversationController::class, 'ticketsList'])->name('conversation.ticketsList');
    Route::get('conversation/progressAppointments', [ConversationController::class, 'progressAppointments'])->name('conversation.progressAppointments');
    Route::post('conversation/decreaseTicket', [ConversationController::class, 'decreaseTicket'])->name('conversation.decreaseTicket');
    Route::post('conversation/payment/details', [ConversationController::class, 'payment'])->name('conversation.payment.details');
    Route::resource('conversation', ConversationController::class)->except('create');

});

Route::group(['prefix' => 'admin'], function () {
    Route::get('deposit/{year?}/{month?}', [AdminController::class, 'deposit'])->name('admin.deposit');
    Route::post('updateCategory', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');
    Route::post('updateTicket', [AdminController::class, 'updateTicket'])->name('admin.updateTicket');
    Route::get('registrantslist', [AdminController::class, 'registrantslist'])->name('admin.registrantslist');
    Route::get('registrantscount', [AdminController::class, 'registrantscount'])->name('admin.registrantscount');
    Route::get('userList/{type?}/{value?}', [AdminController::class, 'userList'])->name('admin.userList');
    Route::get('userTypeList', [AdminController::class, 'userTypeList'])->name('admin.userTypeList');
    Route::get('requestTable', [AdminController::class, 'requestTable'])->name('admin.requestTable');
    Route::get('requestList', [AdminController::class, 'requestList'])->name('admin.requestList');
    Route::get('login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('login', [AdminController::class, 'loginPost'])->name('admin.login.post');
});
