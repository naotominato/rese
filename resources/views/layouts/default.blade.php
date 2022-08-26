<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Ajax meta１つ削除予定 -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
  <script src="https://kit.fontawesome.com/a5a8dd12f2.js" crossorigin="anonymous"></script>
</head>
<title>Rese</title>
</head>

<body>
  <header>
    <div class="container">
      <div class="header">
        <div class="header-left">
          <div class="hamburger">
            <input id="checkbox" type="checkbox" class="hamburger__checkbox">
            <label class="hamburger-trigger" for="checkbox">
              <span></span>
              <span></span>
              <span></span>
            </label>
          </div>
          <h1 class="hedder__title">Rese</h1>
        </div>
        <div class="header-right">
          @yield('search')
        </div>
      </div>
    </div>
    @if(auth()->check() && auth()->user()->hasVerifiedEmail())
    <div class="menu">
      <div class="menu__position">
        <div class="menu__item">
          <a href="{{ route('index') }}">Home</a>
        </div>
        <div class="menu__item">
          <a href="{{ route('logout') }}">Logout</a>
        </div>
        <div class="menu__item">
          <a href="{{ route('mypage') }}">Mypage</a>
        </div>
      </div>
    </div>
    @elseif(auth()->check() && !auth()->user()->hasVerifiedEmail())
    <div class="menu">
      <div class="menu__list">
        <div class="menu__item">
          <a href="{{ route('index') }}">Home</a>
        </div>
        <div class="menu__item">
          <a href="{{ route('verification.notice') }}">send-email</a>
        </div>
        <div class="menu__item">
          <a href="{{ route('logout') }}">Logout</a>
        </div>
      </div>
    </div>
    @endif
    @guest
    <div class="menu">
      <div class="menu__list">
        <div class="menu__item">
          <a href="{{ route('index') }}">Home</a>
        </div>
        <div class="menu__item">
          <a href="{{ route('register') }}">Registration</a>
        </div>
        <div class="menu__item">
          <a href="{{ route('login') }}">Login</a>
        </div>
      </div>
    </div>
    @endguest
  </header>
  <main>
    <div class="container">
      @yield('index')
      @yield('detail')
      @yield('register')
      @yield('created')
      @yield('login')
      @yield('mypage')
      @yield('reserved')
      <!-- @yield('verify') -->
      @yield('email')
      @yield('registered')
      @yield('mailauth')
      @yield('qrcode')
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/layout.js') }}"></script>
</body>

</html>