@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="{{ asset('css/resend.css') }}">

<div class="resend">
  <h2 class="resend__title">現在、仮登録中です！</h2>
  <p class="resend__text--top">ご登録いただいたメールアドレス宛に確認メールを送信しております。<br>メールのリンクからログインされますと、本登録が完了いたします。</p>
  <p class="resend__text--top">確認メールを再送する場合は、下記再送ボタンを押してください。</p>

  <form method="POST" action="{{ route('verification.send') }}" id="resend__form">
    @csrf
    <div>
      <button class="resend__btn">確認メールを再送する</button>
    </div>
  </form>
  <p class="resend__text--bottom"> 届かない場合は、恐れ入りますが、<br>もう一度、メールアドレスをご確認の上、再度、ご登録ください。</p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/resend.js') }}"></script>
@endsection