
<table class="table table-bordered text-center" style="width:50%; margin-top:50px;">
    <thead>
        <tr>
            <th>名前</th>
            <th>対応言語</th>
            <th>ジャンル</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($translators as $translator)
            <tr>
                <td>{{$translator->name}}</td>
                <td>{{ config('myconfig.category')[$translator->category] }}</td>
                <td>{{ config('myconfig.language')[$translator->language] }}</td>
            </tr>
        @endforeach
    </tbody>
    {{ $translators->links() }}
</table>
