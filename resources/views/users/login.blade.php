@extends('layouts.default')

@section('login')

<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="login">
  <div class="login__box">
    <h2 class="login__title">Login</h2>
    <div class="login__form">
      <form action="{{ route('login') }}" method="POST" id="login__form">
        @csrf
        <table>
          @error('email')
          <tr>
            <th></th>
            <td class="login__td--error">{{ $message }}</td>
          </tr>
          @enderror
          <tr>
            <th>
              <label for="email">
                <img src="img/email.png" alt="" class="login__icon">
              </label>
            </th>
            <td class="login__td">
              <input type="text" name="email" id="email" class="login__input" placeholder="Email" value="{{ old('email') }}">
            </td>
          </tr>
          @error('password')
          <tr>
            <th></th>
            <td class="login__td--error">{{ $message }}</td>
          </tr>
          @enderror
          <tr>
            <th>
              <label for="password">
                <img src="img/password.png" alt="" class="login__icon">
              </label>
            </th>
            <td class="login__td"><input type="password" name="password" id="password" class="login__input" placeholder="Password"></td>
          </tr>
        </table>
        @if (isset($user_none))
        <p class="login__none">{{ $user_none }}</p>
        @endif
        <div class="login__box--bottom">
          <button id="login__btn" class="login__btn">ログイン</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/login.js') }}"></script>
@endsection