
@extends('layouts.app')

@section('title', 'SkyWay - Video chat')

@section('css')
<style>
    .button-group{
        display:flex;
        justify-content:space-between;
        flex-direction:row;
    }
    #their-videos label {
        display:none;
    }
    #their-videos{
        text-align: -webkit-center;
    }
    .button-group {
        margin-top:20px;
    }
    #videochat {
        margin-top:50px;
        margin-bottom:20px;
    }
    .other_stop_screen {
        width: 100%;
        background: white;
        height: 500px;
        display:flex;
        align-items:center;
        justify-content:center;
        color:black;
        font-size:30px;
        border:1px solid black;
    }
    .my_stop_screen {
        width: 100%;
        background: white;
        height: 200px;
        display:flex;
        align-items:center;
        justify-content:center;
        color:black;
        font-size:30px;
        border:1px solid black;
    }
    #my-video {
        display: none;
    }
    #timer {
        font-size: 30px;
    }
    .timer-group {
        margin-left:70%;
        margin-top:50px;
        margin-bottom:50px;
    }
</style>
@endsection

@section('content')
    <h4 class="text-center my-8 text-color-03B917">通話</h4>
    <div class="item-center my-2">
        <div id="grad1"></div>
    </div>
    @csrf
    <input type="hidden" name="ticket_count" id="ticket_count" value="{{$count}}"/>
    <input type="hidden" name="search_user_id" id="search_user_id" value="{{$search_user->id}}">
    <input type="hidden" name="user_type" id="user_type" value="{{auth()->user()->type}}"/>
    <chat></chat>
    <div class="timer-group">
        <div class="mt-8 text-color-03B917 text-center">残り時間</div>
        <div class="my-2 item-center">
            <div id="grad1"></div>
        </div>
        <div class="text-center">
            <span id="timer"></span>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var start_flag = false;
        var stop_flag = false;
        $(document).ready(function() {
            var type = parseInt('{{auth()->user()->type}}');
            if(type > 0){
                $("#acceptBtn").addClass('call');
            }
            else
                $("#callBtn").addClass('call');
            $("#join-room").val({{$appointment_id}});
        });
    </script>

    <script src="{{ asset('js/videoapp.js') }}" defer></script>
    <script type="text/javascript" src="//cdn.webrtc.ecl.ntt.com/skyway-latest.js"></script>
    <script type="text/javascript" src="{{ asset('js/skyway.js') }}"></script>

    <script>
        $(document).ready(function() {
            var data = @json($search_user);
            $("#search_name").html(data['name']);
            var pic_url = "";
            if(data['avatar'] != "")
                pic_url = data['avatar'];
            else
                pic_url = "{{ asset('stisla/img/avatar/avatar-1.png')}}";
            document.getElementById('avatar_img').setAttribute('src', pic_url);
            document.getElementById('timer').innerHTML =  "10" + ":" + "00";
            //startTimer();
        });

        function startTimer() {
            var presentTime = document.getElementById('timer').innerHTML;
            if(stop_flag)
            {
                return;
            }
            if(presentTime == "00:00")
                start_flag = false;
            if(!start_flag){
                $('#endBtn').click();
                document.getElementById('timer').innerHTML =  "10" + ":" + "00";
                var count = $("#ticket_count").val();
                count -= 1;
                decrease(count);
                $("#ticket_count").val(count);
                return;
            }
            var timeArray = presentTime.split(/[:]+/);
            var m = timeArray[0];
            var s = checkSecond((timeArray[1] - 1));
            if(s==59){m=m-1}
            //if(m<0){alert('timer completed')}

            document.getElementById('timer').innerHTML =
                m + ":" + s;
            console.log(m)
            setTimeout(startTimer, 1000);
        }

        function checkSecond(sec) {
            if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
            if (sec < 0) {sec = "59"};
            return sec;
        }
        function decrease(amount){
            var _token = $("input[name='_token']").val();
            var search_user_id = $("input[name='search_user_id']").val();
            $.ajax({
                type:'post',
                url:"{{ route('conversation.decreaseTicket') }}",
                data:{amount:amount, _token:_token, ticketprice_id: 1, worker_id: search_user_id },
                success:function(msg) {
                }
            });
        }
    </script>

@endsection
