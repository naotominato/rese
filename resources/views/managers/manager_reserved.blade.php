@extends('layouts.manager')
<link rel="stylesheet" href="{{ asset('css/manager/reserved.css') }}">

@section('nav')
<nav class="manager__nav">
  <ul>
    <li><a href="{{ route('manager.shop') }}">店舗情報登録 / 更新</a></li>
    <li><a href="{{ route('manager.mail') }}">メール送信</a></li>
    <li><a href="{{ route('index') }}">お客様用画面</a></li>
  </ul>
</nav>
@endsection

@section('content')

<h2 class="shop__title">店舗名：<span class="shop-manager">{{ $manager->shop->name }}</span>　店舗代表者：<span class="shop-manager">{{ $manager->name }}</span>さん</h2>

<div class="shop-reserved">
  <h3 class="reserved__title">【本日】予約リスト（時間順）</h3>
  <div class="reserved__list">
    <table class="reserved__table">
      <tr>
        <th>日付</th>
        <th>時間</th>
        <th>人数</th>
        <th>お名前</th>
        <th>ご連絡先</th>
      </tr>
      @foreach($todays as $today)
      <tr>
        <td>{{ $today->start->format('Y年m月d日') }}</td>
        <td>{{ $today->start->format('H:i') }}</td>
        <td>{{ $today->number }}</td>
        <td>{{ $today->user->name }}</td>
        <td>{{ $today->user->email }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

<div class="shop-reserved">
  <h3 class="reserved__title">【今後】予約リスト（日時順）</h3>
  <div class="reserved__list">
    <table class="reserved__table">
      <tr>
        <th>日付</th>
        <th>時間</th>
        <th>人数</th>
        <th>お名前</th>
        <th>ご連絡先</th>
      </tr>
      @foreach($reserves as $reserve)
      <tr>
        <td>{{ $reserve->start->format('Y年m月d日') }}</td>
        <td>{{ $reserve->start->format('H:i') }}</td>
        <td>{{ $reserve->number }}</td>
        <td>{{ $reserve->user->name }}</td>
        <td>{{ $reserve->user->email }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

<div class="shop-reserved">
  <h3 class="reserved__title">【過去】予約リスト（直近の日時順）</h3>
  <div class="reserved__list">
    <table class="reserved__table">
      <tr>
        <th>日付</th>
        <th>時間</th>
        <th>人数</th>
        <th>お名前</th>
        <th>ご連絡先</th>
      </tr>
      @foreach($pasts as $past)
      <tr>
        <td>{{ $past->start->format('Y年m月d日') }}</td>
        <td>{{ $past->start->format('H:i') }}</td>
        <td>{{ $past->number }}</td>
        <td>{{ $past->user->name }}</td>
        <td>{{ $past->user->email }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

@endsection