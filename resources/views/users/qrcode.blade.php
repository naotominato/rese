@extends('layouts.default')

@section('qrcode')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">

<div class="qr">{!! QrCode::size(250)->generate('$reserved->id.$reserved->user->name') !!}</div>


@endsection