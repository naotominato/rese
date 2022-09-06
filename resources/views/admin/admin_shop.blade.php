@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/admin/shop.css') }}">

@section('createnav')
<nav class="admin__nav">
  <ul>
    <li><a href="{{ route('adminpage') }}">店舗代表者作成 / 店舗代表者一覧</a></li>
    <li><a href="{{ route('index') }}">お客様用画面</a></li>
  </ul>
</nav>
@endsection

@section('create')

<h2 class="admin__title">新規店舗名　作成</h2>

<div class="create-shop">
  <form action="{{ route('shopCreate') }}" method="POST">
    @csrf
    <label for="shop_name">新規作成　店舗名</label>
    <input type="text" name="shop_name" class="create-shop__input" id="shop_name" placeholder="店舗名" value="{{ old('shop_name') }}">
    <button class="create-shop__btn" id="create-shop__btn">登録</button>
  </form>
  @error('shop_name')
  <p class="error">{{ $message }}</p>
  @enderror
  @if(isset($shop_name))
  <p class="error">新店舗「{{ $shop_name }}」が追加されました。</p>
  @endif
</div>

<div class="shop__list">
  <h3 class="admin__title">既存店舗　一覧表</h3>
  <table class="shop__table">
    <tr>
      <th>店舗ID</th>
      <th>店舗名</th>
      <th>所在地</th>
      <th>ジャンル</th>
      <th>店舗代表者名</th>
    </tr>
    @foreach($shops as $shop)
    <tr>
      <td class="shop-id">{{ $shop->id }}</td>
      <td>{{ $shop->name }}</td>
      @if($shop->area && $shop->genre)
      <td>{{ $shop->area->name }}</td>
      <td>{{ $shop->genre->name }}</td>
      @else
      <td class="not-exist">未登録</td>
      <td class="not-exist">未登録</td>
      @endif
      @if($shop->managerShop())
      <td class="exist">{{ $shop->managerShop()->name}}</td>
      @else
      <td class="not-exist">未設定</td>
      @endif
    </tr>
    @endforeach
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/admin/shop.js') }}"></script>
@endsection