@extends('layouts.default')

@section('qrcode')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">

<div class="reserved__info">
  <h2>{{ $reserved->user->name }}様</h2>
  <p>予約店舗：{{ $reserved->shop->name }}</p>
  <p>予約日時：{{ $reserved->start->format('Y年m月d日 H時i分') }}</p>
  <p>予約人数：{{ $reserved->number }}名</p>
  <p>※ご予約の内容をお確かめの上、こちらを店舗スタッフへご提示ください。</p>
</div>

<div class="qr">
  {!! QrCode::size(200)->generate(route('managerreservedqr', ['reserved' => $reserved->id, 'user' => $reserved->user->id, 'shop' => $reserved->shop->id])) !!}
</div>

<!-- <div class="qr">
  {!! QrCode::size(200)->generate('$reserved->id.$reserved->user->id.$reserved->shop->id') !!}
</div> -->

@endsection