@extends('layouts.default')

@section('qrcode')
<link rel="stylesheet" href="{{ asset('css/qrcode.css') }}">

<div class="reserved__content">
  <div class="reserved__body">
    <h2 class="reserved__title">ご予約内容</h2>
    <div class="reserved__info">
      <h3 class="reserved__username">{{ $reserved->user->name }}様</h2>
        <p class="reserved__detail">店舗：{{ $reserved->shop->name }}</p>
        <p class="reserved__detail">ご来店日時：{{ $reserved->start->format('Y年m月d日 H時i分') }}</p>
        <p class="reserved__detail">人数：{{ $reserved->number }}名</p>
        <p class="reserved__text">※ご予約内容をご確認の上、店舗スタッフへご提示ください。</p>
    </div>
    <div class="qrcode">
      {!! QrCode::size(120)->generate(route('manager.qr', ['reserved_id' => $reserved->id, 'user_id' => $reserved->user->id, 'shop_id' => $reserved->shop->id])) !!}
    </div>
  </div>
</div>
@endsection