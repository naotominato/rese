@extends('layouts.manager')
<link rel="stylesheet" href="{{ asset('css/manager/reserved.css') }}">
<link rel="stylesheet" href="{{ asset('css/manager/mail.css') }}">

@section('nav')
<nav class="manager__nav">
  <ul>
    <li><a href="{{ route('manager.reserved') }}">予約状況確認</a></li>
    <li><a href="{{ route('manager.shop') }}">店舗情報登録 / 更新</a></li>
    <li><a href="{{ route('index') }}">お客様用画面</a></li>
  </ul>
</nav>
@endsection

@section('content')

<h2 class="shop__title">店舗名：<span class="shop-manager">{{ $manager->shop->name }}</span>　店舗代表者：<span class="shop-manager">{{ $manager->name }}</span>さん</h2>

<div class="mail">
  <h3 class="reserved__title mail__title">お気に入り登録済み　お客様宛　メール送信</h3>
  @if(session('message'))
  <p class="result">{{ session('message') }}</p>
  @endif
  <form action="{{ route('mail.sent') }}" method="POST" id="manager-mail__form">
    @csrf
    <div class="mail__text">
      <textarea name="text" id="" class="mail__textarea" placeholder="こちらにメール本文をご入力ください。"></textarea>
    </div>
    <div class="mail__sent">
      <button class="mail__btn" id="manager-mail__btn">送信する</button>
    </div>
  </form>
</div>

<div class="shop-reserved">
  <h3 class="reserved__title">お気に入り登録済み　お客様リスト</h3>
  <div class="reserved__list">
    <table class="reserved__table">
      <tr>
        <th>お名前</th>
        <th>ご連絡先</th>
      </tr>
      @foreach($favorites as $favorite)
      <tr>
        <td>{{ $favorite->user->name }}</td>
        <td>{{ $favorite->user->email }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/manager/mail.js') }}"></script>
@endsection