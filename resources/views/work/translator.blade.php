@extends('layouts.app')

@section('title', 'Screen Displayed')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
    <div class="card container">
        <div class="card-body">
            <div class="row margin-40 margin-bottom-50">
                <div class="col-md-5 text-right" style="margin-top:10px">
                    <img class=" image-cropper profile-pic" src="{{asset('stisla/img/avatar/avatar-1.png')}}" alt="" style="width:200px;height200px;">
                </div>
                <div class="col-md-7">
                    <div class="font-size-40">翻訳&nbsp;&nbsp;&nbsp;太郎&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:blue;">FREE</span></div>
                    <div class="font-size-20 margin-30">対応可能言語：日本語、英語</div>
                    <div class="font-size-20 margin-30">学歴</div>
                    <div class="font-size-16 margin-20">
                        バンクーバー国際高校卒業(2015年)<br>
                        トロント大学経済学部卒業(2020年)
                    </div>
                    <div class="font-size-20 margin-30">資格</div>
                    <div class="font-size-16 margin-20">
                        TOEIC 990点<br>
                        英検1級<br>
                        国際スピーチコンテスト優勝
                    </div>
                </div>
            </div>
            <div class=" text-center margin-bottom-50">
                    <a class="btn btn-bg text-light btn-md" href="{{route('translation.index')}}">翻訳を依頼する</a>
                    <a class="btn btn-bg text-light btn-md" href="{{route('expression.index')}}">表現を依頼する </a>
            </div>
        </div>
    </div>
@endsection
