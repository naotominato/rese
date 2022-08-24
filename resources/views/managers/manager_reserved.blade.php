@extends('layouts.manager')

@section('managerreservednav')
<nav class="manager__nav">
  <ul>
    <li><a href="{{ route('managerpage') }}">店舗情報登録 / 更新</a></li>
    <li><a href="{{ route('sentmail') }}">お気に入り（メール）</a></li>
    <li><a href="{{ route('index') }}">お客様用画面</a></li>
  </ul>
</nav>
@endsection

@section('managerreserved')
<link rel="stylesheet" href="{{ asset('css/manager/reserved.css') }}">

<h2 class="shop__title">店舗名：<span class="shop-manager">{{ $manager->shop->name }}</span>　店舗代表者：<span class="shop-manager">{{ $manager->name }}</span>さん</h2>


<div class="shop-reserved">
  <h3 class="reserved__title">お客様　予約リスト</h3>
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

@endsection