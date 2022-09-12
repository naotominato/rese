@extends('layouts.default')

@section('content')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">

<div class="detail-page__content">
  <div class="shop__info">
    <div class="shop__title">
      <a href="{{ route('back') }}" class="page__back">
        < </a>
          <h2 class="shop__name">{{ $shop->name }}</h2>
    </div>
    <img src="{{ asset($shop->image_url) }}" alt="準備中" class="shop__image">

    <div class="shop__tag">
      <p class="shop-area__tag">#{{ $shop->area->name }}</p>
      <p class="shop-genre__tag">#{{ $shop->genre->name }}</p>
    </div>
    <p class="shop__detail">{{ $shop->detail }}</p>
  </div>
  @if(auth()->check() && auth()->user()->hasVerifiedEmail())
  <div class="reserve">
    <div class="reserve__box">
      <form action="{{ route('reserve') }}" method="POST" id="reserve__form">
        @csrf
        <div class="reserve__body">
          <h2 class="reserve__title">予約</h2>
          <input type="hidden" name="shop_id" value="{{ $shop->id }}">
          @error('shop_id')
          <p class="error">{{ $message }}</p>
          @enderror
          <input type="date" name="date" value="{{ $reserve }}" min="{{ $reserve }}" id="reserve__date" class="date__input">
          @error('date')
          <p class="error">{{ $message }}</p>
          @enderror
          <select name="time" id="reserve__time" class="reserve__select">
            <option hidden>時間を選択</option>
            @for ($i = 10; $i <= 22; $i++) <option value="{{ $i }}:00">{{ $i }}:00</option>
              <option value="{{ $i }}:30">{{ $i }}:30</option>
              @endfor
              <option value="23:00">23:00</option>
          </select>
          @error('time')
          <p class="error">{{ $message }}</p>
          @enderror
          <select name="number" id="reserve__number" class="reserve__select">
            <option hidden>人数を選択</option>
            @for ($n = 1; $n <= 20; $n++) <option value="{{ $n }}">{{ $n }}人</option>
              @endfor
          </select>
          @error('number')
          <p class="error">{{ $message }}</p>
          @enderror
          <div class="realtime__check">
            <table class="realtime__table">
              <tr>
                <th>Shop</th>
                <td class="check__shop">{{ $shop->name }}</td>
              </tr>
              <tr>
                <th>Date</th>
                <td class="check__date"></td>
              </tr>
              <tr>
                <th>Time</th>
                <td class="check__time"></td>
              </tr>
              <tr>
                <th>Number</th>
                <td class="check__number"></td>
              </tr>
            </table>
          </div>
        </div>
        <button id="reserve__btn" class="reserve__btn">予約する</button>
      </form>
    </div>
  </div>
  @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/detail.js') }}"></script>

@endsection