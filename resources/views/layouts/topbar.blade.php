
<section id="header">
    <b class="screen-overlay"></b>
    <div class="card mobile-offcanvas" id="card_mobile">
        <div class="offcanvas-header">
            <span class="btn-close" style="font-size:60px;color:white;margin:10px;"> &times </span>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">

            </ul>
        </div>
    </div>

    <nav class="navbar navbar-expand-md navbar-light bg-header py-0" id="navbar">
        <div class="container">
            @if(Request::is('/'))
            <a class="navbar-toggler click-nabvar-bt collapsed border-0 toggle-menu" data-toggle="collapse" data-target="#menu" href="#">
                <!-- these spans become the three lines -->
                <span> </span>
                <span> </span>
                <span> </span>
            </a>
            @endif
            <a class="navbar-brand" href="{{route('welcome')}}"><img src="{{ asset('assets/img/logo.png') }}"></a>

            <!-- <button data-trigger="#card_mobile" class="d-lg-none btn btn-warning" type="button">  Show card </button> -->
            <div class="collapse navbar-collapse font-size-15" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                </ul>
                @if(Request::is('admin/*'))
                <ul class="navbar-nav">
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="{{route('admin.deposit')}}">入金一覧</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="{{route('admin.userList')}}">登録者一覧</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="{{route('admin.userTypeList')}}">登録者数一覧</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="{{route('admin.requestTable')}}">業務依頼一覧</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link" href="{{route('admin.requestList')}}">依頼業務一覧</a>
                    </li>
                </ul>
                @else
                <ul class="navbar-nav">
                    <li class="nav-item  dropdown mr-2">
                        <a class="nav-link dropdown-toggle toggle-menu" data-toggle="collapse" href="#" data-target="#right_menu">サービス利用ガイド（依頼者の方）</a>
                        <ul class="dropdown-menu text-center" id="right_menu">
                            <li class="list-group-item"><a href="{{route('guide.translation')}}">翻訳サービス</a></li>
                            <li class="list-group-item"><a href="{{route('guide.conversation')}}">会話サービス</a></li>
                            <li class="list-group-item"><a href="{{route('guide.interpretation')}}">通訳サービス</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{route('login',0)}}">（ 依頼者の方 ）マイページ</a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </nav>
</section>
