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
<p class="login-status">【ログイン中】<span class="user">{{ auth()->user()->name }}</span>様　(メール認証済み）</p>
@elseif(auth()->check() && !auth()->user()->hasVerifiedEmail())
<div class="temporary-login">
  <p class="temporary">【仮登録中】初回のみメール認証が必要です。届いたメールをご確認ください。</p>
  <p class="resend">※万が一、ログイン前にメール認証を行なった場合は、もう一度、メール認証を行なってください。<br>あなたの情報を正しく判別するために、ログイン後のメール認証への流れが必要になります。</p>
  <p class="resend">※もう一度メールを受け取りたい場合は、下記ボタンを押して、届いたメールをご確認ください。<br>　届かない場合は、恐れ入りますが、もう一度、メールアドレスをご確認の上、再度、ご登録ください。</p>
  <form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <div>
      <button class="resend__btn">確認メールを再送する</button>
    </div>
  </form>
</div>
@endif
@guest
<p class="login-status">【ゲスト様】ログインしておりません</p>
@endguest



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
          $this.toggleClass('red');
        })
        .fail(function() {
          alert('反映することができませんでした。');
        });
    }));
  });
</script>


@endsection