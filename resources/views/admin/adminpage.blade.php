@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">

@section('adminnav')
<nav class="admin__nav">
  <ul>
    <li><a href="{{ route('shoppage') }}">店舗作成/一覧</a></li>
    <li><a href="{{ route('index') }}">お客様用画面</a></li>
  </ul>
</nav>
@endsection

@section('page')
<h2 class="register__title">店舗代表者作成</h2>

<div class="register-manager">
  <ul class="error__ul">
    @foreach ($errors->all() as $error)
    <li class="error__li">{{$error}}</li>
    @endforeach
  </ul>
  <form action="{{ route('adminCreate') }}" method="POST">
    @csrf
    <div class="shop">
      <label for="shop_id">店舗選択　：</label>
      <select name="shop_id" id="" class="shop__select">
        <option hidden>Shop 選択</option>
        @foreach ($shops as $shop)
        @if (!$shop->managerShop())
        <option value="{{ $shop->id }}">{{ $shop->name }}</option>
        @endif
        @endforeach
      </select>
    </div>

    <div class="manager">
      <label for="manager_name">店舗代表者：</label>
      <input type="text" name="manager_name" id="name" class="manager__input" placeholder="Manager Name" value="{{ old('manager_name') }}">
      <label for="email">　メールアドレス：</label>
      <input type="text" name="email" id="email" class="manager__input" placeholder="Email" value="{{ old('email') }}">
      <label for="password">　パスワード：</label>
      <input type="password" name="password" id="password" class="manager__input" placeholder="Password">
      <button class="register-manager__btn" id="register-manager__btn">登録</button>
    </div>
  </form>
</div>

<div class="manager__list">
  <h3 class="list__title">店舗代表者 登録済み店舗　一覧</h3>
  <table class="manager__table">
    <tr>
      <th>登録ID</th>
      <th>店舗名(店舗ID)</th>
      <th>店舗代表者名</th>
      <th>メールアドレス</th>
    </tr>
    @foreach($managers as $manager)
    <tr>
      <td class="manager-id">{{ $manager->id }}</td>
      <td>{{ $manager->shop->name }}({{ $manager->shop_id}})</td>
      <td>{{ $manager->name }}</td>
      <td>{{ $manager->email }}</td>
    </tr>
    @endforeach
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/admin/manager.js') }}"></script>
@endsection