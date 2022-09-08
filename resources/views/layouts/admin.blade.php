<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/layout.css') }}">
</head>
<title>Rese（管理者）</title>
</head>

<body>
  <header>
    <div class="container">
      <div class="header">
        <div class="header-left">
          @auth
          <div class="hamburger">
            <input id="checkbox" type="checkbox" class="hamburger__checkbox">
            <label class="hamburger-trigger" for="checkbox">
              <span></span>
              <span></span>
              <span></span>
            </label>
          </div>
          @endauth
          <h1 class="header__title">Rese</h1>
        </div>
        <div class="header-right">
          @yield('adminnav')
          @yield('createnav')
        </div>
      </div>
    </div>
    @auth
    <div class="menu">
      <div class="menu__position">
        <div class="menu__item">
          <a href="{{ route('shop.list') }}">店舗作成 / 店舗一覧</a>
        </div>
        <div class="menu__item">
          <a href="{{ route('manager.list') }}">店舗代表者作成 / 店舗代表者一覧</a>
        </div>
        <div class="menu__item">
          <a href="{{ route('admin.logout') }}">Logout</a>
        </div>
      </div>
    </div>
    @endauth
  </header>
  <main>
    <div class="container">
      @yield('login')
      @yield('page')
      @yield('create')
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/layout.js') }}"></script>
</body>

</html>