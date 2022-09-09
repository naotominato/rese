@extends('layouts.default')

@section('register')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">

<div class="register">
  <div class="register__box">
    <h2 class="register__title">Registration</h2>
    <form action="{{ route('create') }}" method="POST" id="register__form" class="register__form">
      @csrf
      <table class="register__table">
        @error('name')
        <tr>
          <th></th>
          <td class="register__td--error">{{ $message }}</td>
        </tr>
        @enderror
        <tr>
          <th>
            <label for="name">
              <img src="{{ asset('img/name.png') }}" alt="" class="register__icon">
            </label>
          </th>
          <td class="register__td">
            <input type="text" name="name" id="name" class="register__input" placeholder="Username" value="{{ old('name') }}">
          </td>
        </tr>
        @error('email')
        <tr>
          <th></th>
          <td class="register__td--error">{{ $message }}</td>
        </tr>
        @enderror
        <tr>
          <th>
            <label for="email">
              <img src="{{ asset('img/email.png') }}" alt="" class="register__icon">
            </label>
          </th>
          <td class="register__td">
            <input type="text" name="email" id="email" class="register__input" placeholder="Email" value="{{ old('email') }}">
          </td>
        </tr>
        @error('password')
        <tr>
          <th></th>
          <td class="register__td--error">{{ $message }}</td>
        </tr>
        @enderror
        <tr>
          <th>
            <label for="password">
              <img src="{{ asset('img/password.png') }}" alt="" class="register__icon">
            </label>
          </th>
          <td class="register__td">
            <input type="password" name="password" id="password" class="register__input" placeholder="Password">
          </td>
        </tr>
      </table>
      <div class="register__box--bottom">
        <button id="register__btn" class="register__btn">登録</button>
      </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/register.js') }}"></script>

              @endsection