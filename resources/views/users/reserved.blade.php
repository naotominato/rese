@extends('layouts.default')

@section('reserved')
<link rel="stylesheet" href="{{ asset('css/reserved.css') }}">

<div class="reserved">
  <h2 class="reserved__text">ご予約ありがとうございます</h2>
  <a href="{{ route('mypage') }}" class="mypage__link">戻る</a>
</div>

@endsection