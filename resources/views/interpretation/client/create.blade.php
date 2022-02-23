@extends('layouts.app')

@section('title', 'Interpretors Show')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
.inputwidth {
    width:100px;
}
table td, .table th {
    padding: .25rem !important;
}
input {
text-align: center;
}
</style>
@endsection

@section('content')
    <div class="order-header">
        <img src="{{asset('assets/img/img-10.png')}}" alt="">
        <div class="position-absolute">
            <h4 class="font-size-40">通訳依頼</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad2"></div>
            </div>
        </div>
    </div>
    <div class="container" style="padding:40px 0px;">
        <form method="POST" name="interpretationForm" id="interpretationForm" action="{{ route('interpretation.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="order_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="worker_id" id="worker_id">
        <input type="hidden" name="type" id="type">
        <input type="hidden" name="sum_time" id="sum_time">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="label" style="width:100%">チケットを購入して下さい。</label>
                    <a class="a_button_style" href="{{ route('interpretation.ticket') }}">購入画面へ</a>
                </div>
                <div class="form-group">
                    <label class="label">{{ __('言語を選択して下さい。') }}</label>
                    <select class="form-control" id="language" name="language">
                        @foreach(config('myconfig.language') as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="label">{{ __('業務開始希望時間') }}</label>
                    <input type="date" class="form-control" id="business_start_time" name="business_start_time"  language="jp"/>
                </div>
                <div class="form-group">
                    <label class="label">{{ __('業務時間') }}</label>
                    <input type="text" class="form-control" id="business_hours" name="business_hours"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="container">
                    <h4 class="text-center"><使用チケット></h4>
                    <table class="table table-bordered text-center ">
                        <thead>
                            <tr >
                                <th>チケット種別</th>
                                <th>利用枚数</th>
                                <th>利用時間</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$ticketprice[0]->during}}分</td>
                                <td ><input type="number" class="form-control " id="count1" name="count1" min="1" maxlength="4" size="4" onchange="changeCount('count1')"></td>
                                <td id="count1_time"></td>
                            </tr>
                            <tr>
                                <td>{{$ticketprice[1]->during}}分</td>
                                <td class="inputwidth"><input type="number" class="form-control " id="count5" name="count5" min="1" maxlength="4" size="4" onchange="changeCount('count5')"></td>
                                <td id="count5_time"></td>
                            </tr>
                            <tr>
                                <td>{{$ticketprice[2]->during}}分</td>
                                <td class="inputwidth"><input type="number" class="form-control " id="count10" name="count10" min="1" maxlength="4" size="4" onchange="changeCount('count10')"></td>
                                <td id="count10_time"></td>
                            </tr>
                            <tr>
                                <td>合計</td>
                                <td></td>
                                <td  id="sum_time_text"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">＊利用枚数をご入力ください</div>
                </div>
            </div>
        </div>
        </form>
        <div class="">
            ＊業務時間と使用チケットご利用時間をご確認ください。<br>
            ＊ご希望担当者をご確認の上チケットをご購入ください。
        </div>
        <div class="translator_show margin-50">
            <div class="content-title font-size-40">
                該当言語登録者状況
            </div>
            <div class="content-below-title font-size-20">
                ご希望の登録者を選択してください
            </div>
            <div class="row">
                @foreach($interpretors as $interpretor)
                    <div class="col-md-3">
                        <a onclick="orderDetail({{$interpretor->id}})" style="cursor: pointer;">
                            <div class="img-style">
                                @if ($interpretor->avatar == "")
                                    <img class="img-circle" id="interpretor_img" src="{{ asset('stisla/img/avatar/avatar-1.png')}}">
                                @else
                                    <img class="img-circle" id="interpretor_img" src="{{$interpretor->avatar}}" alt="">
                                @endif
                                <div class="text-center status-show">{{config('myconfig.worker_status')[$interpretor->state]}}</div>
                            </div>
                            <div class="text-center font-size-15" style="cursor: pointer; color: black; font-weight: bold;">{{$interpretor->name}}</div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="row" style="flex-direction: column;align-items: center;">
                {{ $interpretors->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-body">
                <h4 class="text-center">通訳者プロフィール</h4>
                <div class="d-flex justify-content-center align-items-center my-4">
                    <div id="grad1"></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-6 margin-40" style="align-items:center;">
                        <div class="position-center">
                            <img id="avatar_img" src="" style="border-radius:50%; width:200px; height:200px;" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 margin-50 font-size-20" style="line-height:50px">
                        <div class="row">
                            <div class="col-md-6">ワークネーム</div>
                            <div class="col-md-6" id="interpretation_name"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">対応可能言語</div>
                            <div class="col-md-6" >日本語、<span id="interpretation_language"></span></div>
                        </div>
                    </div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">性別</div>
                    <div class="col-md-5" id="interpretation_sex" ></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">海外在住</div>
                    <div class="col-md-5" id="interpretation_abroad" ></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">SkypeのID</div>
                    <div class="col-md-5" id="interpretation_skype_id" ></div>
                </div>
                <h5 class="mt-16 mb-8 offset-md-1">実績・スキルについて</h5>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">
                        専門分野
                    </div>
                    <div class="col-md-5" id="interpretation_category" ></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">
                        経験年数
                    </div>
                    <div class="col-md-5" id="interpretation_experience_year"></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">実績</div>
                    <div class="col-md-5" id="interpretation_performance" ></div>
                </div>
                <div class="row margin-20">
                    <div class="col-md-5 offset-md-1">その他アピールポイント</div>
                    <div class="col-md-5" id="interpretation_other_point" ></div>
                </div>
                <div class="mt-4 text-center">
                    <button class="ec_button_lg" type="button" onclick="formSubmit()"><span>会話を依頼する </span></button>
                </div>
                <div class="my-8 text-center">
                    <button class="ec_button_lg" type="button" onclick="formSubmit()"><span>アポイントを取る </span></button>
                    <div class="">＊希望担当者がログインしていない場合</div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="default_button" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    var ticket = @json($ticket);
    var ticketprice = @json($ticketprice);
    var sum_time = 0;
    function orderDetail(interpretor_id)
    {
        var business_start_time = document.getElementById('business_start_time').value;
        var business_hours = document.getElementById('business_hours').value;

        if(sum_time == 0)
        {
            alert("使用するチケットの数を入力してください。");return;
        }
        if(business_start_time == "")
        {
            alert("営業開始時間を入力してください。");return;
        }
        if(business_hours == "")
        {
            alert("営業時間を入力してください");return;
        }
        else {
            //var translator_id = 3
            var _token = $("input[name='_token']").val();
            $.ajax({
                type:'post',
                url:"{{ route('interpretation.getInterpretor') }}",
                data:{id:interpretor_id, _token:_token},
                success:function(msg) {
                    //console.log(msg);
                    showModal(msg);
                }
            });
        }
    }

    function showModal(data)
    {
        var sex = @json(config('myconfig.sex'));
        document.getElementById('worker_id').value = data['id'];
        document.getElementById('type').value = data['state'];
        document.getElementById('interpretation_name').innerText = data['name'];
        document.getElementById('interpretation_sex').innerText = sex[data['sex']];
        if(data['abroad'] == 1);
            document.getElementById('interpretation_abroad').innerText = "☑";
        document.getElementById('interpretation_skype_id').innerText = data['skype_id'];
        document.getElementById('interpretation_language').innerText = data['language'];
        document.getElementById('interpretation_category').innerText = data['category'];
        document.getElementById('interpretation_experience_year').innerText = data['experience_year'];
        document.getElementById('interpretation_performance').innerText = [data['performance']];
        document.getElementById('interpretation_other_point').innerText = data['other_point'];

        var pic_url = "";
        if(data['avatar'] != "")
            pic_url = data['avatar'];
        else
            pic_url = "{{ asset('stisla/img/avatar/avatar-1.png')}}";
        document.getElementById('avatar_img').setAttribute('src', pic_url);
        $("#myModal").modal('show');
    }

    function formSubmit()
    {
        document.interpretationForm.submit();
    }


    function changeCount(type){
        sum_time = 0;
        if(ticket.length == 0){
            alert("チケットを購入してください");
            return;
        }
        console.log(ticketprice);
        var count1 = $("#count1").val();
        if(type == "count1")
        {
            if(ticket[0].amount <  count1){
                alert("購入された枚数よりも多いです。");
                $("#count1").val(0);
                return;
            }
            else{
                $("#count1_time").html(count1 * ticketprice[0].during);
            }
        }
        var count5 = $("#count5").val();
        if(type == "count5")
        {
            if(ticket[1].amount <  count5){
                alert("購入された枚数よりも多いです。");
                $("#count5").val(0);
                return;
            }
            else{
                $("#count5_time").html(count5 * ticketprice[1].during);
            }
        }
        var count10 = $("#count10").val();
        if(type == "count10")
        {
            if(ticket[2].amount <  count10){
                alert("購入された枚数よりも多いです。");
                $("#count10").val(0);
                return;
            }
            else{
                $("#count10_time").html(count10 * ticketprice[2].during);
            }
        }
        sum_time += count1 * ticketprice[0].during;
        sum_time += count5 * ticketprice[1].during;
        sum_time += count10 * ticketprice[2].during;
        $("#sum_time_text").html(sum_time);
        $("#sum_time").val(sum_time);
    }
</script>
@endsection
