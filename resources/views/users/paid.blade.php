@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="{{ asset('css/paid.css') }}">

<div class="paid">
  @if(session('message'))
  <h2 class="paid__text">【お支払い結果】</h2>
  <p class="paid__text">{{ session('message') }}</p>
  @else
  <h2 class="paid__text">【こちらからお戻りください】</h2>
  @endif
  <a href="{{ route('today') }}" class="mypage__link">本日の予約へ戻る</a>
</div>

@endsection