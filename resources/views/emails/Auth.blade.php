@extends('layouts.default')

@section('mailauth')
<link rel="stylesheet" href="{{ asset('css/created.css') }}">

<div class="created">
  <h2 class="created__text">メール認証が完了いたしました。</h2>
  <a href="{{ route('index') }}" class="login__link">こちらから、お入りください</a>
</div>

@endsection