@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-40">入金一覧</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="text-right">{{$total_price}}円</div>
    <form action="{{ route('admin.deposit') }}" name="dateForm" method="get" class="my-8 d-flex" style="align-item:center;justify-content:center">
        @csrf
        <label class="col-md-1 text-right">年度 </label>
        <input type="text" class="form-control col-md-3 " id="year" name="year" value="{{ session('year') }}" />
        <label class="col-md-1 text-right">月　 </label>
        <input type="text" class="form-control col-md-3 " id="month" name="month" value="{{ session('month') }}" />
        <button class="ec_button my-0 mx-4 p-1" type="submit" >明細を見る</button>
    </form>
    <div class="">
        @csrf
        <table class="table table-bordered">
        <thead>
            <tr>
            <th colspan="5" class="text-center">翻訳</th>
            </tr>
            <tr>
            <th>ジャンル</th>
            <th>文字数</th>
            <th>単価 1文字</th>
            <th>手数料</th>
            <th>合計</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorys as $key => $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$translation_category_count[$key]}}</th>
                    <td>
                        <input type="text" value="{{$category->price}}" class="form-control" onchange="changeCategory({{$category->id}},'price', this)">
                    </td>
                    <td>
                        <input type="text" value="{{$category->fee}}" class="form-control" onchange="changeCategory({{$category->id}},'fee', this)">
                    </td>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$translation_category_sum}}</td>
            </tr>
        </tbody>
        </table>
        <table class="table table-bordered">
        <thead>
            <tr>
            <th colspan="5" class="text-center">会話</th>
            </tr>
            <tr>
            <th>チケット枚数</th>
            <th>運営手数料（１人につき）</th>
            <th>合計</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($conversations as $conversation)
                <tr>
                    <td>{{$ticket_amount[0]}}</td>
                    <td>
                        <input type="text" value="{{$conversation->fee}}" class="form-control" onchange="changeTicket({{$conversation->id}},'fee', this)">
                    </td>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>{{$ticket_amount[0]}}</td>
            </tr>
        </tbody>
        </table>
        <table class="table table-bordered">
        <thead>
            <tr>
            <th colspan="5" class="text-center">通訳</th>
            </tr>
            <tr>
            <th>コース単価</th>
            <th>1チケット</th>
            <th>チケット枚数</th>
            <th>運営手数料（１チケットにつき）</th>
            <th>合計</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($intergretions as $key => $intergretion)
                <tr>
                    <td>
                        <input type="text" value="{{$intergretion->price}}" class="form-control" onchange="changeTicket({{$intergretion->id}},'price', this)">
                    </td>
                    <td>
                        <input type="text" value="{{$intergretion->during}}" class="form-control" onchange="changeTicket({{$intergretion->id}},'during', this)">
                    </td>
                    <td>{{$ticket_amount[$key+1]}}</td>
                    <td>
                        <input type="text" value="{{$intergretion->fee}}" class="form-control" onchange="changeTicket({{$intergretion->id}},'fee', this)">
                    </td>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$ticket_amount[1] + $ticket_amount[2] + $ticket_amount[3]}}</td>
            </tr>
        </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
<script>
    function changeTicket (id, key, inputSelf) {
        var _token = $("input[name='_token']").val();
        var value = inputSelf.value;
        $.ajax({
            url: "{{ route('admin.updateTicket') }}",
            type:'POST',
            data: {_token:_token, id:id, key:key,value:value},
            success: function(success) {
                console.log(success);
            }
        });
    }
    function changeCategory (id, key, inputSelf) {
        var _token = $("input[name='_token']").val();
        var value = inputSelf.value;
        $.ajax({
            url: "{{ route('admin.updateCategory') }}",
            type:'POST',
            data: {_token:_token, id:id, key:key,value:value},
            success: function(success) {
                console.log(success);
            }
        });
    }
</script>
@endsection
