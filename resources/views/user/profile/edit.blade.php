@extends('layouts.user')

@section('title', '登録情報変更')

@section('content')

<h1>登録情報変更</h1>

@if ($errors->any())
    <ul class="error-box">
        @foreach($errors->all() as $_error)
            <li>{{ $_error }}</li>
        @endforeach
    </ul>
@endif

@if ($_flash_msg = Session::get('_flash_msg'))
    <p class="info-box">{{ $_flash_msg }}</p>
@endif

<form method="post">
    {{ csrf_field() }}
    
    <ul>
        <li>
            <label>名前</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" />
        </li>
        <li>
            <label>メールアドレス</label>
            <input type="text" name="email" value="{{ old('name', $user->email) }}" />
        </li>
    </ul>
    
    <input type="submit" value="更新する">
    
</form>

@stop