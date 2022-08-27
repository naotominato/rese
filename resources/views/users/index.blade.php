@extends('layouts.default')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

@section('search')
<div class="search">
  <form action="{{ route('search') }}" method="get" class="search__form">
    <div class="search__box">
      <div class="area__search">
        <select name="area" id="" class="area__select">
          <option value="" selected>All area</option>
          @foreach ($areas as $area)
          <option value="{{ $area->id }}" @if($area->id == $shop_area) selected @endif>{{ $area->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="genre__search">
        <select name="genre" id="" class="genre__select">
          <option value="" selected>All genre</option>
          @foreach ($genres as $genre)
          <option value="{{ $genre->id }}" @if($genre->id == $shop_genre) selected @endif>{{ $genre->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="shop__search">
        <input type="text" name="name" value="{{ $shop_name }}" class="search__input">
      </div>
      <button class="search__btn">検索</button>
    </div>
  </form>
</div>
@endsection

@section('index')

@if(auth()->check() && auth()->user()->hasVerifiedEmail())
<div>メール認証済みユーザー【ログイン中】</div>
@elseif(auth()->check() && !auth()->user()->hasVerifiedEmail())
<p>【仮登録中】初回のみメール認証が必要です。メールをご確認ください。</p>
@endif
@guest
<div>ユーザー登録も、ログインも、していません！</div>
@endguest

<!-- stripe -->
<form action="{{ route('stripe') }}" method="POST">
  @csrf
  <label for="pay">支払い金額入力：</label>
  <input type="number" name="pay" id="pay">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="{{ env('STRIPE_KEY') }}" data-amount="1000" data-name="Stripe決済デモ" data-label="決済をする" data-description="これはデモ決済です" data-image="https://stripe.com/img/documentation/checkout/marketplace.png" data-locale="auto" data-currency="JPY">
  </script>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
  
</script>
<!-- stripe -->

<div class="shop__list">
  @foreach($shops as $shop)
  <!-- if文、あとで変更予定 -->
  @if($shop->area && $shop->genre && $shop->detail && $shop->image_url)
  <div class="shop__card">
    <img src="{{ $shop->image_url }}" alt="準備中" class="shop__image">
    <div class="shop__desc">
      <h2 class="shop-name">{{ $shop->name }}</h2>
      <div class="shop__tag">
        <p class="shop-area__tag">#{{ $shop->area->name }}</p>
        <p class="shop-genre__tag">#{{ $shop->genre->name }}</p>
      </div>
      <div class="shop__card--bottom">
        <a href="{{ route('detail', ['shop_id' => $shop->id]) }}" class="shop__detail">詳しくみる</a>
        @if(auth()->check() && auth()->user()->hasVerifiedEmail())
        @if(!$shop->isfavoritedBy(Auth::id()))
        <span class="favorite__btn">
          <i class="fa-solid fa-heart favorite__icon" id="favorite__icon" data-favorite-id="{{ $shop->id }}"></i>
        </span>
        @else
        <span class="favorite__btn">
          <i class="fa-solid fa-heart favorite__icon pink" id="favorite__icon" data-favorite-id="{{ $shop->id }}"></i>
        </span>
        @endif
        @endif
      </div>
    </div>
  </div>
  @endif
  @endforeach
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
  $(function() {
    $('.favorite__icon').each(function(i) {
      $(this).attr('id', 'favorite__icon' + (i + 1));
    });
  });

  $(function() {
    $('.favorite__icon').on('click', (function() {
      let $click = $(this).attr('id');
      console.log($click);
    }));
  });

  $(function() {
    $('.favorite__icon').on('click', (function($click) {
      let $this = $(this);
      let shopId = $this.data('favorite-id');
      $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('change')}}",
          method: 'POST',
          data: {
            'shop_id': shopId
          },
        })
        .done(function(data) {
          $this.toggleClass('pink');
        })
        .fail(function() {
          alert('error');
        });
    }));
  });
</script>


@endsection