<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ez trans オンライン翻訳＋会話＋通訳サービス提供</title>
        <meta name="description" content="経験豊富な翻訳者、海外滞在経験者による(会話スタイル)での現地情報提供、手軽な
通訳サービスを格安に分かりやすくオンラインにてご提供いたします。翻訳は1文字2.5円~。会話は10分200円程、通訳は10分1000円のシンプルな料金体系です。">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/lp.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}">

</style>

    </head>
    <body>
        @include('layouts.topbar')

        <section class="bg-ACD3EC d-flex position-relative item-center">
            <div class="menu" id="menu">
                <ul class="list-group">
                    <!-- <li class="list-group-item"><a href="{{route('register.worker')}}">テスト通過者情報登録（共通）</a></li> -->
                    <li class="list-group-item">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">テスト通過者マイページ</a>
                        <ul class="dropdown-menu text-center">
                            <li class="list-group-item"><a href="{{route('login',1)}}">翻訳者</a></li>
                            <li class="list-group-item"><a href="{{route('login',2)}}">会話者</a></li>
                            <li class="list-group-item"><a href="{{route('login',3)}}">通訳者</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="container" onmouseover="menuHide()" >
                <div class="top-title" style="padding-left:130px;">
                    翻訳＋会話＋通訳サービスの<br>
                    オンラインによる新たなカタチ
                </div>
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="text-light m-4" >
                           <span style="background-color: #707070; padding: 5px;font-size:20px">対応言語</span>
                        </div>
                        <div class="text-light m-4" >
                            英語・中国語(簡体字/繁体字)・韓国語・フランス語<br>ドイツ語・スペイン語・イタリア語
                        </div>
                    </div>

                </div>

                <div class="my-8 text-center">
                    <button class="custom-btn1 text-white" onclick="window.location.href='{{ route('register.client') }}'">
                        依頼者登録をする
                    </button>
                    <div class="mt-4 text-light">{翻訳は１文字2.5円〜10円}</div>
                </div>
            </div>
        </section>

        <section class="padding-y-50 padding-sm-10x ">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6 section-title">
                    <span  class="font-size-80">Service</span>
                    <span style="font-size: 20px;"><i class="d-none d-sm-inline">/</i> &nbsp; サービス概要</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center py-8 lh-2">
                    業務依頼の方はサービス概要をご確認の上、<br>
                    上部写真内登録欄よりご依頼者登録をお願いいたします。
                </div>
            </div>
            <div class="row" style="margin-top:30px;">
                <div class="col-md-7 text-light service-title text-right">
                    <span class="font-size-40">オンライン翻訳サービス</span>
                    <div style="font-size: 20px;display: block;">
                        <span class="d-none d-sm-inline-flex" style="padding: 1px;height:2px;width: 50%;border-bottom: 2px solid white;vertical-align: super;"></span>
                        <span style="padding-left:5px;">Translation</span>
                    </div>
                </div>
                <div class="col-md-5">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-7 pt-16 mb-4 offset-md-3 lh-2">
                    翻訳をピンポイントに済ませたいと思ったことはありませんか？<br>
                    Ez transでは各ジャンル専任の翻訳者とコミュニケーションをお取りいただき、<br>
                    迅速、正確な翻訳をお届けします。料金体系は非常にシンプルです。<br>
                    ＊Ez transは機械翻訳ではありません。
                </div>
            </div>
            <div class="row justify-center item-center relative">
                <div class="col-md-3">
                    <a href="{{ route('category.ec_site') }}">
                        <img src="{{ asset('assets/img/img-1.png') }}" style="width:100%" class="my-8 px-3">
                        <div class="img-text1">
                            ECサイト
                        </div>
                        <div class="img-left">
                            <img src="{{ asset('assets/img/img-text.png') }}">
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('category.travel') }}">
                        <img src="{{ asset('assets/img/img-2.png') }}" style="width:100%" class="my-8 px-3">
                        <div class="img-text1">
                            旅行
                        </div>
                        <div class="img-left">
                            <img src="{{ asset('assets/img/img-text.png') }}">
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('category.business_documents_emails') }}">
                        <img src="{{ asset('assets/img/img-3.png') }}" style="width:100%" class="my-8 px-3">
                        <div class="img-text1">
                            ビジネス文書<br>
                            メール
                        </div>
                        <div class="img-left">
                            <img src="{{ asset('assets/img/img-text.png') }}">
                        </div>
                    </a>
                </div>
            </div>
            <div class="row justify-center item-center relative">
                <div class="col-md-3">
                    <a href="{{ route('category.web_it') }}">
                        <img src="{{ asset('assets/img/img-4.png') }}" style="width:100%" class="my-8 px-3">
                        <div class="img-text1">
                            IT
                        </div>
                        <div class="img-left">
                            <img src="{{ asset('assets/img/img-text.png') }}">
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('category.other') }}">
                        <img src="{{ asset('assets/img/img-5.png') }}" style="width:100%" class="my-8 px-3">
                        <div class="img-text1">
                            WEB・その他
                        </div>
                        <div class="img-left">
                            <img src="{{ asset('assets/img/img-text.png') }}">
                        </div>
                    </a>
                </div>
            </div>
            <div class="text-center">
                <button class="service-button" onclick="window.location.href='{{ route('service.translate') }}'">詳しくはこちら</button>
                <div class="mb-3">＊事前にご依頼者登録をお願いいたします＊</div>
            </div>
            <div class="row ">
                <div class="col-md-6 padding-30 offset-md-3 bg-EAF9EB lh-2 text-center">
                    <a href="{{route('guide.file')}}" style="color:black;">
                        ＜ファイル翻訳＞<br>
                        ファイル翻訳ご希望の方はこちらをクリックしてください。<br>
                        上記とはサービス別です。
                    </a>
                </div>
            </div>
        </section>

        <section >
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-7 text-light  service-title text-left">
                    <span class="font-size-40">オンライン会話サービス</span>
                    <div class="font-size: 20px;display: block;">
                        <span class="d-none d-sm-inline-flex" style="padding: 1px;height:2px;width: 70%;border-bottom: 2px solid white;display: inline-flex;vertical-align: super;"></span>
                        <span style="padding-left:5px;">Conversation</span>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row col-md-12 my-16 px-0">
                    <div class="col-md-6 px-0">
                        <div style="line-height: 2;">
                            Ez transの会話はレッスンではありません。<br>
                            日本語と各言語で海外在住者もしくは海外滞在経験が豊富な会話者が日頃の疑問やお知りになりたい情報を会話、チャットでご提供致します。完全チケット制で入会金その他費用はかかりません。
                        </div>
                        <div class="text-center">
                            <button class="service-button" onclick="window.location.href='{{ route('service.conversation') }}'">詳しくはこちら</button>
                            <div class="mb-3">＊事前にご依頼者登録をお願いいたします＊</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/img/img-6.png') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="row">
                <div class="col-md-7 text-light  service-title text-right">
                    <span class="font-size-40">
                        オンライン通訳サービス
                    </span>
                    <div class="font-size: 20px;display: block;">
                        <span class="d-none d-sm-inline-flex" style="padding: 1px;height:2px;width: 50%;border-bottom: 2px solid white;display: inline-flex;vertical-align: super;"></span>
                        <span style="padding-left:5px;">Interpretation</span>
                    </div>
                </div>
                <div class="col-md-5"></div>
            </div>
            <div class="container">
                <div class="row col-md-12 my-16 px-0">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/img/Interpretation.png') }}" alt="">
                    </div>
                    <div class="col-md-6 px-0">
                        <div class="px-8" style="line-height: 2;">
                            １対１の外国語ネイティブとのオンライン会議。<br>
                            または複数でも。現代のビジネスシーンにおいて海外との<br>
                            オンラインを通じた商談は欠くことのできない１場面になってきています。
                            また渡航先や様々なシチュエーションで正確な通訳サービスを利用してみませんか？<br>
                        </div>
                        <div class="text-center">
                            <button class="service-button" onclick="window.location.href='{{ route('service.interpretation') }}'">詳しくはこちら</button>
                            <div class="mb-3">＊事前にご依頼者登録をお願いいたします＊</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="padding-y-50 padding-sm-10x ">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6 section-title">
                    <span  class="font-size-80">About</span>
                    <span style="font-size: 20px;"><i class="d-none d-sm-inline">/</i> &nbsp; Ez Trans とは？</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 py-8 lh-2">
                翻訳会社に依頼することで発生する、多額の進行管理費を削減。翻訳サービスをわかりやすくより安価に提供し、<br>
                翻訳者によるクオリティーチェックは確実に行う。<br><br>

                日頃疑問に感じる外国語の表現の数々、WEBサイトを検索しても出てくる回答は様々です。どの情報が自分の知りたい情報なのか、海外滞在経験者がお答えします。<br><br>

                また、経験豊富な通訳者によるオンラインでの通訳サービスをご提供いたします。

                </div>
            </div>

        </section>
        <section class="padding-y-50 text-light" style="background-color:#00DE1A;">
            <div class="container">
                <div class="row col-md-12">
                    <div class="col-md-9">
                        <span  class="font-size-50">Recruitment</span>
                        <span class="ml-4"><i class="d-none d-sm-inline">/</i> &nbsp; 登録者募集</span>
                    </div>
                </div>
                <div class="text-center mt-4" style="line-height:2">
                    翻訳者、会話者、通訳者を随時募集しております。<br>
                    初めて登録ご希望の方は募集要項をよくお読みの上、メールにてご連絡ください。<br>
                   <a href="{{route('guide.requirement')}}" class="text-light">＜募集要項はこちら＞</a>
                </div>
            </div>
        </section>
        <section id="section6" class="py-4 bg-service6">
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8  text-light" style="display: flex; align-items: baseline;">
                    <span  class="font-size-60" style="margin-right:70px;">Contact</span>
                    <span style="font-size: 20px;"><i class="d-none d-sm-inline">/</i> &nbsp; お問い合わせ</span>
                </div>
            </div>
            <div class="mt-1 mb-3 text-center  text-white  lh-2">
                サービスについての不明点などがございましたら<br>
                お問い合わせフォームからお気軽に<br>
                お問い合わせ下さい。
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="custom-btn1 text-white" onclick="window.location.href='{{ route('contact.index') }}'"><i><img src="{{ asset('assets/img/message.png') }}" style="width: 10%;" alt=""></i>
                        お問い合わせフォーム
                    </button>
                </div>
            </div>
            <div class="mt-2 text-center lh-2" >
                <a style="color:white" href="{{route('auth.privacy')}}">プライバシーポリシーはこちら</a>
            </div>
            <div class="mt-1 text-center lh-2" >
                <a style="color:white" href="{{route('logout.index')}}">退会をご希望される方はこちら</a>
            </div>
        </section>
        <section id="footer" class="footer">
            <div class="text-white text-center">
                @Copyright Ez Trans 2020 All rights reserved.
            </div>
        </section>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="{{ asset('assets/js/lp.js') }}" type="text/javascript"></script>


        <script type="text/javascript">
        /// some script

        // jquery ready start
        $(document).ready(function() {
            // jQuery code


            $("[data-trigger]").on("click", function(e){
                e.preventDefault();
                e.stopPropagation();
                var offcanvas_id =  $(this).attr('data-trigger');
                $(offcanvas_id).toggleClass("show");
                $('body').toggleClass("offcanvas-active");
                $(".screen-overlay").toggleClass("show");
            });

            // Close menu when pressing ESC
            $(document).on('keydown', function(event) {
                if(event.keyCode === 27) {
                $(".mobile-offcanvas").removeClass("show");
                $("body").removeClass("overlay-active");
                }
            });

            $(".btn-close, .screen-overlay").click(function(e){
                $(".screen-overlay").removeClass("show");
                $(".mobile-offcanvas").removeClass("show");
                $("body").removeClass("offcanvas-active");


            });
            $( ".toggle-menu" ).mouseover(function() {
                var data_target = $(this).attr('data-target');
                $(data_target).collapse('show');
            });



        }); // jquery end

        function menuHide(){
            $("#menu, #right_menu").collapse('hide');
        }
        </script>
    </body>
</html>
