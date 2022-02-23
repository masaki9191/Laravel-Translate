@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-40">登録者数一覧</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>

    <div class="">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>翻訳</th>
                    <th>会話</th>
                    <th>通訳</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0 ?>
                @for ($i = 0; $i < 7; $i++)
                <tr>
                    <td>{{ config('myconfig.language')[$i]}}</td>
                    <td>{{$data[$i][0]}}</td>
                    <td>{{$data[$i][1]}}</td>
                    <td>{{$data[$i][2]}}</td>
                </tr>
                @endfor
                <tr>
                    <td>合計</td>
                    <td>{{$sum[0]}}</td>
                    <td>{{$sum[1]}}</td>
                    <td>{{$sum[2]}}</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
@endsection
