@extends('layouts.app')

@section('title', 'F_List')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
    <div class="card container">
        <div class="card-header margin-50">
            <h4 class="font-size-40">依頼業務一覧</h4>
            <div class="d-flex justify-content-center align-items-center my-4">
                <div id="grad1"></div>
            </div>
        </div>
        <?php $i=0; $sum=0; $sum_price=0;?>
        <div class="card-body">
            @foreach ($order_contents as $order_content)
            <div class="background-EAF9EB font-size-20" style="padding:20px; margin-top:40px;">
                    <div class="row">
                        <div class="col-md-2">
                            仕事no
                        </div>
                        <div class="col-md-3">
                            {{$order_content->id}}
                        </div>
                        <div class="col-md-4">
                            受注料金
                        </div>
                        <div class="col-md-3">
                            {{$order_content->price}}円
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            依頼者名
                        </div>
                        <div class="col-md-3">
                        {{$order_content->order->surname."  ".$order_content->order->lastname}}
                        </div>
                        <div class="col-md-4">
                            受注日
                        </div>
                        <div class="col-md-3">
                            {{ explode(' ', $order_content->created_at)[0]  }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            言語
                        </div>
                        <div class="col-md-3">
                            {{ config('myconfig.language')[$order_content->language] }}
                        </div>
                        <div class="col-md-4">
                            ステイタス
                        </div>
                        <div class="col-md-3">
                            見積もり
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            ジャンル
                        </div>
                        <div class="col-md-3">
                            {{ config('myconfig.category')[$order_content->category] }}
                        </div>
                        <div class="col-md-4">
                            納品時期
                        </div>
                        <div class="col-md-3">
                            {{$order_content->delivery_date}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            文字数
                        </div>
                        <div class="col-md-3">
                            {{$order_content->count}}文字
                        </div>
                    </div>
                <div class="margin-30 item-center">
                    <button class="ec_button font-size-20" type="button" onclick="window.location.href='{{ route('translation.orderAccept', $order_content->id) }}'">受注する</button>

                </div>
                <?php $sum=$sum+$order_content->count; ?>
                <?php $sum_price=$sum_price+$order_content->price ?>
                <?php $i++;?>
            </div>
            @endforeach
            <div class="row" style="margin-top:100px;">
                <div class="col-md-6">
                    <div class="font-size-24 text-center">
                        合計件数&nbsp;&nbsp;&nbsp;{{$i}}件
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="font-size-24 text-center">
                        合計分量&nbsp;&nbsp;&nbsp; {{$sum}} 文字
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
