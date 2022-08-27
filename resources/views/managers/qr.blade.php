@extends('layouts.manager')

@section('managerreservedqr')

@if(isset($reserved))
<h2>下記の予約で照合されました！</h2>
<p>予約番号：{{ $reserved->id }}</p>
<p>{{ $reserved->user->name }}様</p>
<p>予約店舗：{{ $reserved->shop->name }}</p>
<p>予約日時：{{ $reserved->start->format('Y年m月d日 H時i分') }}</p>
<p>予約人数：{{ $reserved->number }}名</p>

<p>こちらの予約内容でお間違いないでしょうか。</p>
<button>はい</button>
<button>いいえ</button>
<p>※お客様に押してもらう</p>
<p>その後、reservesテーブルに新カラム「予約済み」を登録し、店舗代表者ページ内の予約一覧画面で、表示/分割できるようにするのはどうだろう！！！</p>
@else
<h2>照合されませんでした。</h2>
@endif

@endsection