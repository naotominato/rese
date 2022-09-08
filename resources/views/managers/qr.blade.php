<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
  <link rel="stylesheet" href="{{ asset('css/manager/qrcode.css') }}">
  <title>Rese（店舗代表者）</title>
</head>

<body>
  <header>
    <div class="container">
      <div class="header">
        <h1 class="header__title">Rese</h1>
      </div>
    </div>
  </header>

  <main>
    <div class="container">
      @if(isset($reserved))
      <div class="reserved__content">
        <div class="reserved__body">
          <div class="reserved__info">
            <h2 class="reserved__title">当店の予約情報と照合されました！</h2>
            <p class="reserved__detail">予約番号：{{ $reserved->id }}</p>
            <p class="reserved__detail">{{ $reserved->user->name }}様</p>
            <p class="reserved__detail">予約店舗：{{ $reserved->shop->name }}</p>
            <p class="reserved__detail">予約日時：{{ $reserved->start->format('Y年m月d日 H時i分') }}</p>
            <p class="reserved__detail">予約人数：{{ $reserved->number }}名</p>
            <p class="reserved__text">ご来店ありがとうございます！</p>
          </div>
        </div>
      </div>
      @elseif(isset($different))
      <div class="reserved__content">
        <div class="reserved__body">
          <div class="reserved__info">
            <h2 class="reserved__title">{{ $different }}</h2>
            <p class="reserved__text">※もう一度、お客様のご予約をお確かめください。</p>
          </div>
        </div>
      </div>
      @endif
    </div>
  </main>

</body>

</html>