@extends('layouts.default')

@section('mypage')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">

<h2 class="user__name">{{ $user->name }}さん</h2>

<div class="mypage__content">
  <div class="reserve__section">
    <div class="reserve">
      <h3 class="reserve__title">予約状況</h3>
      @foreach ($reserves as $reserve)
      <div class="reserve__result">
        <div class="reserve__heading">
          <div class="reserve__heading--left">
            <img src=" {{ asset('img/clock.png') }}" alt="" class="reserve__icon">
            <h4 class="reserve__name">予約</h4>
          </div>
          <div class="reserve__heading--right">
            <a href="{{ route('qrcode', ['reserved_id' => $reserve->id]) }}">QRcode</a>
            <a href="{{ route('cancel', ['reserve_id' => $reserve->id]) }}" id="cancel__btn" class="cancel__btn">
              <img src=" {{ asset('img/cancel.png') }}" alt="" class="reserve__cancel">
            </a>
          </div>
        </div>
        <!-- <button class="change__button" id="butt">予約変更する</button> -->
        <div class="reserve__tables">
          <table class="reserve__show">
            <tr>
              <th>店名</th>
              <td>{{ $reserve->shop->name }}</td>
            </tr>
            <tr>
              <th>日付</th>
              <td>{{ $reserve->start->format('Y年m月d日') }}</td>
            </tr>
            <tr>
              <th>時間</th>
              <td>{{ $reserve->start->format('H:i') }}</td>
            </tr>
            <tr>
              <th>人数</th>
              <td>{{ $reserve->number }}</td>
            </tr>
          </table>
          <form action="{{ route('update')}}" method="POST" id="change__form" class="change__form butt red">
            @csrf
            <input type="hidden" name="reserve_id" value="{{ $reserve->id }}" class="reserve__id">
            @error('reserve_id')
            <p class="error">{{ $message }}</p>
            @enderror
            <input type="hidden" name="shop_id" value="{{ $reserve->shop_id }}" class="shop__id">
            @error('shop_id')
            <p class="error">{{ $message }}</p>
            @enderror
            @error('date')
            <p class="error">{{ $message }}</p>
            @enderror
            <table class="reserve__change">
              <tr>
                <th>日付⇒</th>
                <td>
                  <input type="date" name="date" id="reserve__date" class="date__input date__id" value="{{ $reserve->start->format('Y-m-d') }}">
                </td>
              </tr>
              <tr>
                <th>時間⇒</th>
                <td>
                  <select name="time" id="reserve__time" class="reserve__select time__select">
                    @for ($i = 10; $i <= 22; $i++) <option value="{{ $i }}:00" @if ($i.':00'===$reserve->start->format('H:i')) selected @endif>{{ $i }}:00</option>
                      <option value="{{ $i }}:30" @if ($i.':30'===$reserve->start->format('H:i')) selected @endif>{{ $i }}:30</option>
                      @endfor
                      <option value="23:00" @if ('23:00'===$reserve->start->format('H:i'))selected @endif>23:00</option>
                  </select>
                  @error('time')
                  <p class="error">{{ $message }}</p>
                  @enderror
                </td>
              </tr>
              <tr>
                <th>人数⇒</th>
                <td>
                  <select name="number" id="reserve__number" class="reserve__select number__select">
                    @for ($n = 1; $n <= 20; $n++) <option value="{{ $n }}" @if ($n===$reserve->number) selected @endif>{{ $n }}人</option>
                      @endfor
                  </select>
                  @error('number')
                  <p class="error">{{ $message }}</p>
                  @enderror
                </td>
              </tr>
            </table>
            <div class="change__form--bottom">
              <button type="submit" id="change__btn" class="change__btn">予約を変更する</button>
            </div>
          </form>
        </div>
      </div>
      @endforeach
    </div>
    <div class="reserve">
      <h3 class="reserve__title">過去の予約（最新順）</h3>
      @foreach ($pasts as $past)
      <div class="reserve__result">
        <div class="reserve__heading">
          <div class="reserve__heading--left">
            <img src=" {{ asset('img/clock.png') }}" alt="" class="reserve__icon">
            <h4 class="reserve__name">過去の予約</h4>
          </div>
          <div class="reserve__heading--right">
            <ul class="error__ul">
              @foreach ($errors->all() as $error)
              <li class="error__li">{{$error}}</li>
              @endforeach
            </ul>
          </div>
        </div>
        <div class="reserved__content">
          <div class="reserved__tables">
            <table class="reserved__show">
              <tr>
                <th>店名</th>
                <td>{{ $past->shop->name }}</td>
              </tr>
              <tr>
                <th>日付</th>
                <td>{{ $past->start->format('Y年m月d日') }}</td>
              </tr>
              <tr>
                <th>時間</th>
                <td>{{ $past->start->format('H:i') }}</td>
              </tr>
              <tr>
                <th>人数</th>
                <td>{{ $past->number }}</td>
              </tr>
            </table>
          </div>
          <div class="reviewed">
            @if($past->reviewed())
            <div class="reviewed__star">
              @for ($r = 5; $r >= 1; $r--) <input id="star{{ $r . $reserve->id }}" type="radio" name="evaluation{{$past->id}}" disabled @if($past->reviewed()->evaluation == $r) checked @endif>
              <label for="star{{ $r . $reserve->id }}">★</label>
              @endfor
              <p class="star__p">５段階評価：</p>
            </div>
            <p class="comment__p">コメント：</p>
            <div class="comment__box">
              <p class="comment__text">{!! nl2br(e($past->reviewed()->comment)) !!}</p>
            </div>
            <p class="comment__end">入力済み</p>
            @elseif(!$past->reviewed())
            <form action="{{ route('review')}}" method="POST" class="review__form">
              @csrf
              <input type="hidden" name="reserve_id" value="{{ $past->id }}" class="reserve__id">
              <input type="hidden" name="shop_id" value="{{ $past->shop->id }}" class="shop__id">
              <div class="star">
                @for ($r = 5; $r >= 1; $r--) <input id="star{{ $r . $past->id }}" type="radio" name="evaluation" class="star" value="{{ $r }}">
                <label for="star{{ $r . $past->id }}">★</label>
                @endfor
                <p class="star__p">５段階評価：</p>
              </div>
              <p class="comment__p">コメント：(120文字以内 / 改行可）</p>
              <div class="comment">
                <textarea name="comment" class="comment__textarea"></textarea>
              </div>
              <div class="review__button">
                <button class="review__btn" id="review__btn">レビューを送信</button>
              </div>
            </form>
            @endif
          </div>
        </div>
      </div>

      @endforeach
    </div>
  </div>
  <div class="favorite__section">
    <h3 class="favorite__title">お気に入り店舗</h3>
    <div class="shop__list">
      @foreach($favorites as $favorite)
      <div class="shop__card">
        <img src="{{ $favorite->shop->image_url }}" alt="" class="shop__image">
        <div class="shop__desc">
          <h2 class="shop__name">{{ $favorite->shop->name }}</h2>
          <div class="shop__tag">
            <p class="shop-area__tag">#{{ $favorite->shop->area->name }}</p>
            <p class="shop-genre__tag">#{{ $favorite->shop->genre->name }}</p>
          </div>
          <div class="shop__card--bottom">
            <a href="{{ route('detail', ['shop_id' => $favorite->shop->id]) }}" class="shop__detail">詳しくみる</a>
            <form action="{{ route('delete', ['shop_id' => $favorite->shop->id]) }}" method="POST" class="favorite__form">
              @csrf
              <input type="hidden" name="favorite" value="{{ $favorite->shop->id }}">
              <button class="favorite__btn">
                <i class="fa-solid fa-heart favorite__icon pink" id="favorite__icon"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('js/mypage.js') }}"></script>

<script>
  // $(function() {
  //   $('.change__btn').each(function(i) {
  //     $(this).attr('id', 'change__btn' + (i + 1));
  //   });
  // });

  // $(function() {
  //   $('.change__btn').on('click', (function() {
  //     let $click = $(this).attr('id');
  //     console.log($click);
  //   }));
  // });

  //１つ前
  // $(function() {
  //   $('.change__form').each(function(i) {
  //     $(this).attr('id', 'change__form' + (i + 1));
  //   });
  // });

  // // $(function() {
  // //   $('.change__btn').on('click', (function() {
  // //     let $form = $('.change__form').attr('id');
  // //     console.log($form);
  // //   }));
  // // });

  //１つ前（予約変更）
  // $(function() {
  //   $('.change__btn').on('click', (function() {
  //     let $form = $('.change__form').attr('id');
  //     console.log($form);
  //   }));
  //   $('.reserve__result').submit(function(e, $form) {
  //     e.preventDefault();
  //     // let formData = $(form).serialize();
  //     // let $formData = $form.serialize();
  //     // let $this = $(this);
  //     let reserveId = $('.reserve__id').val();
  //     let shopId = $('.shop__id').val();
  //     let dateId = $('.date__id').val();
  //     let timeId = $('.time__select').val();
  //     let numberId = $('.number__select').val();
  //     $.ajax({
  //         headers: {
  //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //         },
  //         url: "{{ route('update')}}",
  //         method: 'POST',
  //         data: {
  //           // 'form': formData
  //           // 'form': formData
  //           'reserve_id': reserveId,
  //           'shop_id': shopId,
  //           'date': dateId,
  //           'time': timeId,
  //           'number': numberId
  //         },

  //       })
  //       .done(function() {
  //         // $this.toggleClass('red');
  //         alert('成功');
  //       })
  //       .fail(function() {
  //         alert('error');
  //       });
  //   });
  // });


  //１つ前（レビュー機能）
  // $(function() {
  //   $('.change__form').each(function(i) {
  //     $(this).attr('id', 'change__form' + (i + 1));
  //   });
  // });

  // $(function() {
  //   $('.review__form').submit(function(e) {
  //     e.preventDefault();
  //     // $(function() {
  //     //   $('.change__btn').on('click', (function() {
  //     //     let $form = $('.change__form').attr('id');
  //     //     console.log($form);
  //     //   }));
  //     // });
  //     // let formData = $(form).serialize();
  //     // let $formData = $form.serialize();
  //     // let $this = $(this);
  //     let reserveId = $('.reserve__id').val();
  //     let shopId = $('.shop__id').val();
  //     let starId = $('.star').val();
  //     let commentId = $('.comment__textarea').val();
  //     $.ajax({
  //         headers: {
  //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //         },
  //         url: "{{ route('review')}}",
  //         method: 'POST',
  //         data: {
  //           // 'form': formData
  //           // 'form': formData
  //           'reserve_id': reserveId,
  //           'shop_id': shopId,
  //           'evaluation': starId,
  //           'comment': commentId,
  //         },

  //       })
  //       .done(function() {
  //         // $this.toggleClass('red');
  //         alert('成功');
  //       })
  //       .fail(function() {
  //         alert('error');
  //       });
  //   });
  // });
</script>

@endsection