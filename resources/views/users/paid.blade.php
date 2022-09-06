@extends('layouts.default')

@section('paid')
<link rel="stylesheet" href="{{ asset('css/created.css') }}">

<div class="created">
  <h2 class="created__text">【お支払いが完了しました】</h2>
  <p class="created__text">ご利用ありがとうございます。<br>またのご利用をお待ちしております。</p>
  <a href="{{ route('today') }}" class="login__link">本日の予約へ戻る</a>
</div>

@endsection