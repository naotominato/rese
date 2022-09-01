@extends('layouts.manager')

@section('managerpagenav')
<nav class="manager__nav">
  <ul>
    <li><a href="{{ route('managerreserved') }}">予約状況確認</a></li>
    <li><a href="{{ route('sentmail') }}">お気に入り（メール）</a></li>
    <li><a href="{{ route('index') }}">お客様用画面</a></li>
  </ul>
</nav>
@endsection

@section('managerpage')
<link rel="stylesheet" href="{{ asset('css/manager/page.css') }}">

<h2 class="shop__title">店舗名：<span class="shop-manager">{{ $manager->shop->name }}</span>　店舗代表者：<span class="shop-manager">{{ $manager->name }}さん</span></h2>

<div class="manager__content">
  <div class="shop__edit">
    <div class="shop__register">
      <h3 class="register__title">店舗情報登録 / 更新</h3>
      @foreach ($errors->all() as $error)
      <ul class="error__ul">
        <li class="error__li">{{$error}}</li>
      </ul>
      @endforeach
      <form enctype="multipart/form-data" action="{{ route('shopcreate') }}" method="POST">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $manager->shop_id }}">

        <label for="area">Area：</label>
        <select name="area_id" id="area" class="shop__select">
          <option hidden>選択してください</option>
          @foreach ($areas as $area)
          <option value="{{ $area->id }}" @if($area->id == $shop->area_id) selected @endif>{{ $area->name }}</option>
          @endforeach
        </select>

        <label for="genre">Genre：</label>
        <select name="genre_id" id="genre" class="shop__select">
          <option hidden>選択してください</option>
          @foreach ($genres as $genre)
          <option value="{{ $genre->id }}" @if($genre->id == $shop->genre_id) selected @endif>{{ $genre->name }}</option>
          @endforeach
        </select>

        <div class="shop__detail">
          <label for="detail" class="shop__label">店舗紹介文（500文字以内）</label>
          @if (!old('detail'))
          <textarea name="detail" id="detail" class="shop__textarea" placeholder="店舗説明文">{{ $shop->detail }}</textarea>
          @elseif (old('detail'))
          <textarea name="detail" id="detail" class="shop__textarea">{{ old('detail') }}</textarea>
          @endif
        </div>

        <!-- <div class="shop__image-url">
          <label for="image_url" class="shop__label">画像URL</label>
          <input type="text" name="image_url" id="imageurl" class="shop__input" placeholder="画像URL" value="{{ $shop->image_url }}">
        </div> -->

        <div class="file__image">
          <p class="file__title">店舗画像【 jpg, jpeg, png, gif / 10MBまで 】</p>
          <label class="file__label">
            <input type="file" name="shop_image" class="file__input" id="file__input">アップロード
          </label>
          <p class="file__data" id="file__data">【 <span class="file__name" id="file__name">ファイルをアップロードしてください</span> 】</p>
        </div>

        <div class="shop__btn">
          <button class="register-shop__btn" id="register-shop__btn">登録</button>
        </div>
      </form>
      <!-- <div class="shop__image">
        <form action="" method="POST" enctype="multipart/form-date">
          @csrf
          <input type="file" nama="image">
          <button>アップロード</button>
        </form>
      </div> -->
    </div>
  </div>
  <div class="edit__result">
    @if(!$shop->area && !$shop->genre && !$shop->detail && !$shop->image_url)
    <p class="result">店舗情報は現在、未設定です。</p>
    @elseif(!$shop->image_url)
    <h4 class="result">現在の店舗情報</h4>
    <div class="shop__info">
      <p class="shop__image">店舗画像が設定されておりません<br>店舗画像を登録しないと、ユーザーには表示されません。</p>
      <div class="shop__tag">
        <p class="shop-area__tag">#{{ $shop->area->name }}</p>
        <p class="shop-genre__tag">#{{ $shop->genre->name }}</p>
      </div>
      <p class="shop__detail">{{ $shop->detail }}</p>
    </div>
    @else
    <h4 class="result">現在の店舗情報</h4>
    <div class="shop__info">
      <img src="{{ asset($shop->image_url) }}" alt="" class="shop__image">
      <div class="shop__tag">
        <p class="shop-area__tag">#{{ $shop->area->name }}</p>
        <p class="shop-genre__tag">#{{ $shop->genre->name }}</p>
      </div>
      <p class="shop__detail">{{ $shop->detail }}</p>
    </div>
    @endif
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/manager/create.js') }}"></script>
<!-- <script>
  $('#file__input').on('change', function() {
    let file = $(this).prop('files')[0];
    $('#file__name').text(file.name);
  });
</script> -->

<!-- <script src="{{ asset('js/manager/create.js') }}"></script> -->

<!-- 必要なければ、削除する -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>　追加ファイルの表示
  $(function() {
    $('.js-upload-file').on('change', function() { //ファイルが選択されたら
      var file = $(this).prop('files')[0]; //ファイルの情報を代入(file.name=ファイル名/file.size=ファイルサイズ/file.type=ファイルタイプ)
      $('.js-upload-filename').text(file.name); //ファイル名を出力
    });
  });
</script>

<script>　選択ファイルの削除ボタン表示
  $(function() {
    $('.js-upload-file').on('change', function() { //ファイルが選択されたら
      let file = $(this).prop('files')[0]; //ファイルの情報を代入(file.name=ファイル名/file.size=ファイルサイズ/file.type=ファイルタイプ)
      $('.js-upload-filename').text(file.name); //ファイル名を出力
      $('.js-upload-fileclear').show(); //クリアボタンを表示
    });
    $('.js-upload-fileclear').click(function() { //クリアボタンがクリックされたら
      $('.js-upload-file').val(''); //inputをリセット
      $('.js-upload-filename').text('ファイルが未選択です'); //ファイル名をリセット
      $(this).hide(); //クリアボタンを非表示
    });
  });
</script> -->
@endsection