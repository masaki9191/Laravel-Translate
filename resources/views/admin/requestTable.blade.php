@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-40">業務依頼一覧</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h4>言語</h4>
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
        <div class="col-md-4">
            <h4>ジャンル</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>翻訳</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0 ?>
                    @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td>{{ $bigCategory[$i]}}</td>
                        <td>{{$dataByCategory[$i]}}</td>
                    </tr>
                    @endfor
                    <tr>
                        <td>合計</td>
                        <td>{{$sumCategory}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
