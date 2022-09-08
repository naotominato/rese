@extends('layouts.manager')

@section('managercompletion')

<link rel="stylesheet" href="{{ asset('css/manager/send.css') }}">

<div class="send">
  <h2 class="send__text">【メール送信完了しました】</h2>
  <p class="send__text">下記ボタンからお戻りください。</p>
    <a href="{{ route('manager.mail') }}" class="return__link">戻る</a>
</div>

@endsection