<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ez trans オンライン翻訳＋会話＋通訳サービス提供</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="経験豊富な翻訳者、海外滞在経験者による(会話スタイル)での現地情報提供、手軽な
通訳サービスを格安に分かりやすくオンラインにてご提供いたします。翻訳は1文字2.5円~。会話は10分200円程、通訳は10分1000円のシンプルな料金体系です。">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">



    </head>
    <body>

        <section>
            @yield('content')
        </section>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="{{ asset('assets/js/lp.js') }}" type="text/javascript"></script>


        <script type="text/javascript">
            $(document).ready(function() {



            });
        </script>
    </body>
</html>
