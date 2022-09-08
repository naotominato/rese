@extends('layouts.default')

@section('mypage')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">

<h2 class="user__name">{{ $user->name }}さん</h2>

<div class="mypage__content">
  <div class="reserve__section">
    <div class="reserve__title">
      <h3 class="reserve__title--left">現在の予約状況</h3>
      <a href="{{ route('today') }}" class="reserve__title--right">本日の予約<br>【QR / 決済】</a>
      <a href="{{ route('past') }}" class="reserve__title--right">過去の予約確認<br>【レビュー】</a>
    </div>
    <ul class="error__ul">
      @foreach ($errors->all() as $error)
      <li class="error">{{$error}}</li>
      @endforeach
    </ul>
    @foreach ($reserves as $reserve)
    <div class="reserve__result" id="reserve__result">
      <div class="reserve__heading">
        <div class="reserve__heading--left">
          <img src=" {{ asset('img/clock.png') }}" alt="" class="reserve__icon">
          <h4 class="reserve__name">予約</h4>
        </div>

        <div class="reserve__heading--right">
          <a href="{{ route('cancel', ['reserve_id' => $reserve->id]) }}" id="cancel__btn" class="cancel__btn">
            <img src=" {{ asset('img/cancel.png') }}" alt="" class="reserve__cancel">
          </a>
        </div>
      </div>
      <div class="reserve__tables">
        <table class="reserve__show" id="reserve_show">
          <tr>
            <th>店名</th>
            <td class="reserved-shop" id="reserved-shop">{{ $reserve->shop->name }}</td>
          </tr>
          <tr>
            <th>日付</th>
            <td class="reserved-date" id="reserved-date">{{ $reserve->start->format('Y年m月d日') }}</td>
          </tr>
          <tr>
            <th>時間</th>
            <td class="reserved-time" id="reserved-time">{{ $reserve->start->format('H:i') }}</td>
          </tr>
          <tr>
            <th>人数</th>
            <td class="reserved-number" id="reserved-number">{{ $reserve->number }}</td>
          </tr>
        </table>
        <form action="{{ route('update') }}" method="POST" id="change__form" class="change__form butt red">
          @csrf
          <input type="hidden" name="reserve_id" value="{{ $reserve->id }}" class="reserve__id" id="reserve__id" data-reserve-id="{{ $reserve->id }}">
          <input type="hidden" name="shop_id" value="{{ $reserve->shop_id }}" class="shop__id" id="shop__id" data-shop-id="{{ $reserve->shop_id }}">
          <table class="reserve__change">
            <tr>
              <th>日付⇒</th>
              <td>
                <input type="date" name="date" id="date__input" class="date__input date__id" value="{{ $reserve->start->format('Y-m-d') }}" data-date-id="{{ $reserve->start->format('Y-m-d') }}">
              </td>
            </tr>
            <tr>
              <th>時間⇒</th>
              <td>
                <select name="time" id="time__select" class="reserve__select time__select">
                  @for ($i = 10; $i <= 22; $i++) <option class="time__option" value="{{ $i }}:00" data-time-id="{{ $i }}:00" @if ($i.':00'===$reserve->start->format('H:i')) selected @endif>{{ $i }}:00</option>
                    <option class="time__option" value="{{ $i }}:30" data-time-id="{{ $i }}:30" @if ($i.':30'===$reserve->start->format('H:i')) selected @endif>{{ $i }}:30</option>
                    @endfor
                    <option class="time__option" value="23:00" data-time-id="23:00" @if ('23:00'===$reserve->start->format('H:i'))selected @endif>23:00</option>
                </select>
              </td>
            </tr>
            <tr>
              <th>人数⇒</th>
              <td>
                <select name="number" id="number__select" class="reserve__select number__select">
                  @for ($n = 1; $n <= 20; $n++) <option class="number__option" value="{{ $n }}" data-number-id="{{ $n }}" @if ($n===$reserve->number) selected @endif>{{ $n }}人</option>
                    @endfor
                </select>
              </td>
            </tr>
          </table>
          <div class="change__form--bottom">
            <button type="submit" id="change__btn" class="change__btn">予約を変更する</button>
          </div>
        </form>
      </div>
    </div>
    @endforeach
  </div>
  <div class="favorite__section">
    <h3 class="favorite__title">お気に入り店舗</h3>
    <div class="shop__list">
      @foreach($favorites as $favorite)
      <div class="shop__card">
        <img src="{{ $favorite->shop->image_url }}" alt="" class="shop__image">
        <div class="shop__desc">
          <h2 class="shop__name">{{ $favorite->shop->name }}</h2>
          <div class="shop__tag">
            <p class="shop-area__tag">#{{ $favorite->shop->area->name }}</p>
            <p class="shop-genre__tag">#{{ $favorite->shop->genre->name }}</p>
          </div>
          <div class="shop__card--bottom">
            <a href="{{ route('detail', ['shop_id' => $favorite->shop->id]) }}" class="shop__detail">詳しくみる</a>
            <form action="{{ route('delete', ['shop_id' => $favorite->shop->id]) }}" method="POST" class="favorite__form">
              @csrf
              <input type="hidden" name="favorite" value="{{ $favorite->shop->id }}">
              <button class="favorite__btn">
                <i class="fa-solid fa-heart favorite__icon pink" id="favorite__icon"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/mypage.js') }}"></script>

@endsection