@extends('layouts.default')

@section('created')
    <link rel="stylesheet" href="{{ asset('css/created.css') }}">

<div class="created">
  <h2 class="created__text">会員登録ありがとうございます</h2>
  <a href="{{ route('login') }}" class="login__link">ログインする</a>
</div>

@endsection