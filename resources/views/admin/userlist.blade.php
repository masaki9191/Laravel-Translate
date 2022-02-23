@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card-header margin-50">
        <h4 class="font-size-40">登録者一覧</h4>
        <div class="d-flex justify-content-center align-items-center my-4">
            <div id="grad1"></div>
        </div>
    </div>
    <div class="">
    <div class="form-group">
        <label class="label">言語</label>
        <select class="form-control" id="language" name="language" onchange="changeSearch('language',this)">
            <option value="">選択なし</option>
            @foreach (config('myconfig.language') as $key => $value)
                <option value="{{$key}}" {{ session('language') == $key ? "selected" : "" }}>{{$value}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="label">ジャンル(翻訳)</label>
        <select class="form-control" id="category" name="category" onchange="changeSearch('category',this)">
            <option value="">選択なし</option>
            @foreach (config('myconfig.category') as $key => $value)
                <option value="{{$key}}" {{ session('category') == $key ? "selected" : "" }}>{{$value}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label class="label">業務種別</label>
        <select class="form-control" id="user_type" name="user_type" onchange="changeSearch('type',this)">
            <option value="">選択なし</option>
            <option value="1">翻訳</option>
            <option value="2">会話</option>
            <option value="3">通訳</option>
        </select>
    </div>

    </div>
    <div class="">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ワークネーム</th>
                    <th>業務種別</th>
                    <th>言語</th>
                    <th>ジャンル(翻訳)</th>
                    <th>メールアドレス</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0 ?>
                @forelse  ($users as $user)
                <tr>
                    <td>{{$i+=1 }}</th>
                    <td>{{$user->name}}</td>
                    <td>{{ config('myconfig.user_type')[$user->type] }}</td>
                    <td>
                        @if(isset($user->language))
                            {{ config('myconfig.language')[$user->language] }}
                        @endif
                    </td>
                    <td>
                        @if(isset($user->category))
                            {{ config('myconfig.category')[$user->category] }}
                        @endif
                    </td>
                    <td>{{$user->email}}</td>
                </tr>
                @empty
                <tr><td colspan="5">ユーザーなし</td></p>
                @endforelse
            </tbody>
        </table>

    </div>
    <div class="row" style="flex-direction: column;align-items: center;">
        {{ $users->links() }}
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
    function changeSearch(type,obj){
        var value = obj.value;
        location.href="/admin/userList/"+type+"/"+value;
    }
</script>
@endsection
