@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="{{ asset('css/created.css') }}">

<div class="created">
  <h2 class="created__text">メール認証が完了いたしました。<br>ありがとうございます。</h2>
  <a href="{{ route('index') }}" class="login__link">こちらから、お入りください</a>
</div>

@endsection