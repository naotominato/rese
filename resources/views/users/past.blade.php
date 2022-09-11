@extends('layouts.default')

@section('past')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/past.css') }}">

<h2 class="user__name">{{ $user->name }}さん</h2>


<div class="mypage__content">
  <div class="reserve__section">
    <div class="reserve__section--left">
      <div class="reserve__title">
        <h3 class="reserve__title--left">過去の予約（日時順）</h3>
        <a href="{{ route('mypage') }}" class="reserve__title--right">Mypageへ戻る</a>
        <a href="{{ route('today') }}" class="reserve__title--right">本日の予約<br>【QR / 決済】</a>
      </div>
      <ul class="error__ul">
        @foreach ($errors->all() as $error)
        <li class="error">{{$error}}</li>
        @endforeach
      </ul>
      @if(session('message'))
      <p class="thanks">{{ session('message') }}</p>
      @endif
      @foreach ($pasts as $past)
      @if(!$past->reviewed())
      <div class="reserve__result">
        <div class="reserve__heading">
          <div class="reserve__heading--left">
            <img src=" {{ asset('img/clock.png') }}" alt="" class="reserve__icon">
            <h4 class="reserve__name">過去の予約</h4>
          </div>
        </div>
        <div class="reserved__content">
          <div class="reserved__tables">
            <table class="reserved__show">
              <tr>
                <th>店名</th>
                <td>{{ $past->shop->name }}</td>
              </tr>
              <tr>
                <th>日付</th>
                <td>{{ $past->start->format('Y年m月d日') }}</td>
              </tr>
              <tr>
                <th>時間</th>
                <td>{{ $past->start->format('H:i') }}</td>
              </tr>
              <tr>
                <th>人数</th>
                <td>{{ $past->number }}</td>
              </tr>
            </table>
          </div>
          <div class="reviewed">
            <form action="{{ route('review')}}" method="POST" class="review__form">
              @csrf
              <input type="hidden" name="reserve_id" value="{{ $past->id }}" class="reserve__id">
              <input type="hidden" name="shop_id" value="{{ $past->shop->id }}" class="shop__id">
              <div class="star">
                @for ($r = 5; $r >= 1; $r--) <input id="star{{ $r . $past->id }}" type="radio" name="evaluation" class="star" value="{{ $r }}">
                <label for="star{{ $r . $past->id }}">★</label>
                @endfor
                <p class="star__p">評価：</p>
              </div>
              <p class="comment__p">コメント：(120文字以内）</p>
              <div class="comment">
                <textarea name="comment" class="comment__textarea"></textarea>
              </div>
              <div class="review__button">
                <button class="review__btn" id="review__btn">レビューを送信</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
    <div class="reserve__section--right">
      <div class="reserve__title">
        <h3 class="reserve__title--left">レビュー済み（日時順）</h3>
      </div>
      @foreach ($pasts as $past)
      @if($past->reviewed())
      <div class="reserve__result reviewed__result">
        <div class="reserve__heading">
          <div class="reserve__heading--left">
            <img src=" {{ asset('img/clock.png') }}" alt="" class="reserve__icon">
            <h4 class="reserve__name">過去の予約</h4>
          </div>
          <div class="reserve__heading--right">
            <ul class="error__ul">
              @foreach ($errors->all() as $error)
              <li class="error__li">{{$error}}</li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="reserved__content">
          <div class="reserved__tables">
            <table class="reserved__show">
              <tr>
                <th>店名</th>
                <td>{{ $past->shop->name }}</td>
              </tr>
              <tr>
                <th>日付</th>
                <td>{{ $past->start->format('Y年m月d日') }}</td>
              </tr>
              <tr>
                <th>時間</th>
                <td>{{ $past->start->format('H:i') }}</td>
              </tr>
              <tr>
                <th>人数</th>
                <td>{{ $past->number }}</td>
              </tr>
            </table>
          </div>
          <div class="reviewed">
            <div class="reviewed__star">
              @for ($r = 5; $r >= 1; $r--) <input id="star{{ $r . $past->id }}" type="radio" name="evaluation{{$past->id}}" disabled @if($past->reviewed()->evaluation == $r) checked @endif>
              <label for="star{{ $r . $past->id }}">★</label>
              @endfor
              <p class="star__p">評価：</p>
            </div>
            <p class="comment__p">コメント：</p>
            <div class="comment__box">
              <p class="comment__text">{!! nl2br(e($past->reviewed()->comment)) !!}</p>
            </div>
            <p class="comment__end">入力済み</p>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/mypage.js') }}"></script>

@endsection