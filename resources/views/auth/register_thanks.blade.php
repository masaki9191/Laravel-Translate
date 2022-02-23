@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="item-center" style="height: 80vh;">
        <div>
            <h4 class="text-center mt-4 color-02B917">THANK YOU!!</h4>
            <div class="item-center my-2">
                <div id="grad1"></div>
            </div>
            <div class="text-center" style="margin:40px 0px">
            メールの送信が完了致しました。<br>
            送信されたメールにあるURLをクリックして<br>
            登録情報を入力して下さい。
            </div>
            <div class="text-center my-16">
            メールが届かない場合<br>
            <br>
            info@eztrans49.comからのメールを受け取れるように設定して下さい。<br>
            また、迷惑メールフォルダに入っている可能性があります。<br>
            <br>
            上記でも解決しない場合は<br>
            お問い合わせフォームからお問い合わせください。

            </div>
        </div>
    </div>
@endsection
