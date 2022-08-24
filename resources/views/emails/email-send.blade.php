@extends('layouts.default')

@section('email')

<h2>現在、仮登録中です！</h2>
<p>ご登録いただいたメールアドレス宛に確認メールを送信しております。</p>
<p>メールのリンクからログインされますと、本登録が完了いたします。</p>
<p>確認メールを再送する場合は、下記再送ボタンを押してください。</p>

@if (session('status') == 'verification-link-sent')
<div class="mb-4 font-medium text-sm text-green-600">
  <p>新たに確認メールを送信いたしました。</p>
</div>
@endif

<div class="mt-4 flex items-center justify-between">
  <form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <div>
      <button>確認メールを再送する</button>
    </div>
  </form>

</div>


@endsection