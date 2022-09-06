@extends('layouts.default')

@section('today')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/today.css') }}">

<h2 class="user__name">{{ $user->name }}さん</h2>

<div class="mypage__content">
  <div class="reserve__section">
    <div class="reserve">
      <div class="reserve__title">
        <h3 class="reserve__title--left">本日の予約状況</h3>
        <a href="{{ route('mypage') }}" class="reserve__title--right">Mypageへ戻る</a>
        <a href="{{ route('past') }}" class="reserve__title--right">過去の予約<br>【レビュー】</a>
      </div>
      @foreach ($reserves as $reserve)
      <div class="reserve__result">
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
        <!-- <button class="change__button" id="butt">予約変更する</button> -->
        <div class="reserve__info">
          <div class="reserve__tables">
            <table class="reserve__show">
              <tr>
                <th>店名</th>
                <td>{{ $reserve->shop->name }}</td>
              </tr>
              <tr>
                <th>日付</th>
                <td>{{ $reserve->start->format('Y年m月d日') }}</td>
              </tr>
              <tr>
                <th>時間</th>
                <td>{{ $reserve->start->format('H:i') }}</td>
              </tr>
              <tr>
                <th>人数</th>
                <td>{{ $reserve->number }}</td>
              </tr>
            </table>
          </div>
          <div class="reserve__info--right">
            <div class="qr">
              <form action="{{ route('qrcode') }}" method="POST">
                @csrf
                <input type="hidden" name="reserve_id" value="{{ $reserve->id }}">
                <button class="qr__button" id="qr__button">来店時QRコード</button>
              </form>
            </div>
            <div class="stripe">
              <!-- stripe -->
              <form action="{{ route('stripe') }}" method="POST" class="form">
                @csrf
                <input type="hidden" name="shop_name" value="{{ $reserve->shop->name }}">
                <input type="hidden" name="shop_id" value="{{ $reserve->shop->id }}">
                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ env('STRIPE_KEY') }}" data-amount="1000" data-name="{{ $reserve->shop->name }}" data-label="決済" data-description="こちらの店舗に支払います" data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto" data-currency="JPY">
                </script>
              </form>
              </script>
              <!-- stripe -->
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/today.js') }}"></script>
@endsection