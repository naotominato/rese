@extends('layouts.default')

@section('email')

<h2>仮登録中です！</h2>
<p>ご登録いただいたメールアドレス宛に確認メールを送信しております。</p>
<p>メールのリンクからログインをいたしますと、本登録が完了いたします。</p>
<p>確認メールを再送する場合は、下記再送ボタンを押してください。</p>

@if (session('status') == 'verification-link-sent')
<div class="mb-4 font-medium text-sm text-green-600">
  {{ __('A new verification link has been sent to the email address you provided during registration.') }}
</div>
@endif

<div class="mt-4 flex items-center justify-between">
  <form method="POST" action="{{ route('verification.send') }}">
    @csrf

    <div>
      <x-button>
        確認メールを再送する
      </x-button>
    </div>
  </form>

</div>


@endsection