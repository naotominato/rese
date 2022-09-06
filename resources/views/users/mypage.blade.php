@extends('layouts.default')

@section('mypage')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">

<h2 class="user__name">{{ $user->name }}さん</h2>

<div class="mypage__content">
  <div class="reserve__section">
    <div class="reserve">
      <div class="reserve__title">
        <h3 class="reserve__title--left">現在の予約状況</h3>
        <a href="{{ route('today') }}" class="reserve__title--right">本日の予約<br>【QR / 決済】</a>
        <a href="{{ route('past') }}" class="reserve__title--right">過去の予約確認<br>【レビュー】</a>
      </div>
      @foreach ($reserves as $reserve)
      <div class="reserve__result" id="reserve__result">
        <div class="reserve__heading">
          <div class="reserve__heading--left">
            <img src=" {{ asset('img/clock.png') }}" alt="" class="reserve__icon">
            <h4 class="reserve__name">予約</h4>
          </div>

          <div class="reserve__heading--right">
            <a href="{{ route('cancel', ['reserve_id' => $reserve->id]) }}" id="cancel__btn" class="cancel__btn">
              <img src=" {{ asset('img/cancel.png') }}" alt="" class="reserve__cancel">
            </a>
          </div>
        </div>
        <!-- <button class="change__button" id="butt">予約変更する</button> -->
        <div class="reserve__tables">
          <table class="reserve__show" id="reserve_show">
            <tr>
              <th>店名</th>
              <td class="reserved-shop" id="reserved-shop">{{ $reserve->shop->name }}</td>
            </tr>
            <tr>
              <th>日付</th>
              <td class="reserved-date" id="reserved-date">{{ $reserve->start->format('Y年m月d日') }}</td>
            </tr>
            <tr>
              <th>時間</th>
              <td class="reserved-time" id="reserved-time">{{ $reserve->start->format('H:i') }}</td>
            </tr>
            <tr>
              <th>人数</th>
              <td class="reserved-number" id="reserved-number">{{ $reserve->number }}</td>
            </tr>
          </table>
          <form id="change__form" class="change__form butt red">
            @csrf
            <input type="hidden" name="reserve_id" value="{{ $reserve->id }}" class="reserve__id" id="reserve__id" data-reserve-id="{{ $reserve->id }}">
            @error('reserve_id')
            <p class="error">{{ $message }}</p>
            @enderror
            <input type="hidden" name="shop_id" value="{{ $reserve->shop_id }}" class="shop__id" id="shop__id" data-shop-id="{{ $reserve->shop_id }}">
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
                  <input type="date" name="date" id="date__input" class="date__input date__id" value="{{ $reserve->start->format('Y-m-d') }}" data-date-id="{{ $reserve->start->format('Y-m-d') }}">
                </td>
              </tr>
              <tr>
                <th>時間⇒</th>
                <td>
                  <select name="time" id="time__select" class="reserve__select time__select">
                    @for ($i = 10; $i <= 22; $i++) <option class="time__option" value="{{ $i }}:00" data-time-id="{{ $i }}:00" @if ($i.':00'===$reserve->start->format('H:i')) selected @endif>{{ $i }}:00</option>
                      <option class="time__option" value="{{ $i }}:30" data-time-id="{{ $i }}:30" @if ($i.':30'===$reserve->start->format('H:i')) selected @endif>{{ $i }}:30</option>
                      @endfor
                      <option class="time__option" value="23:00" data-time-id="23:00" @if ('23:00'===$reserve->start->format('H:i'))selected @endif>23:00</option>
                  </select>
                  @error('time')
                  <p class="error">{{ $message }}</p>
                  @enderror
                </td>
              </tr>
              <tr>
                <th>人数⇒</th>
                <td>
                  <select name="number" id="number__select" class="reserve__select number__select">
                    @for ($n = 1; $n <= 20; $n++) <option class="number__option" value="{{ $n }}" data-number-id="{{ $n }}" @if ($n===$reserve->number) selected @endif>{{ $n }}人</option>
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
    <!-- <div class="reserve">
      <h3 class="reserve__title">過去の予約（最新順）</h3>
      @foreach ($pasts as $past)
      <div class="reserve__result" id="reserve__result">
        <div class="reserve__heading">
          <div class="reserve__heading--left">
            <img src=" {{ asset('img/clock.png') }}" alt="" class="reserve__icon">
            <h4 class="reserve__name">過去の予約</h4>
          </div>
          @if (isset($errors))
          <div class="reserve__heading--right">
            <ul class="error__ul" id="error__ul">
              @foreach ($errors->all() as $error)
              <li class="error__li">{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
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
              @for ($r = 5; $r >= 1; $r--) <input id="star{{ $r . $past->id }}" type="radio" name="evaluation{{$past->id}}" disabled @if($past->reviewed()->evaluation == $r) checked @endif>
              <label for="star{{ $r . $past->id }}">★</label>
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
    </div>　-->
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
  //   $('.reserve__result').each(function(i) {
  //     $(this).attr('id', 'reserve__result' + (i + 1));
  //   });
  // });

  // $(function() {
  //   $('.reserve__show').each(function(i) {
  //     $(this).attr('id', 'reserve__show' + (i + 1));
  //   });
  // });



  // $(function() {
  //   $('.reserved-shop').each(function(i) {
  //     $(this).attr('id', 'reserved-shop' + (i + 1));
  //   });
  // });
  // $(function() {
  //   $('.reserved-date').each(function(i) {
  //     $(this).attr('id', 'reserved-date' + (i + 1));
  //   });
  // });
  // $(function() {
  //   $('.reserved-time').each(function(i) {
  //     $(this).attr('id', 'reserved-time' + (i + 1));
  //   });
  // });
  // $(function() {
  //   $('.reserved-number').each(function(i) {
  //     $(this).attr('id', 'reserved-number' + (i + 1));
  //   });
  // });

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

  let idName = [
    'reserve__result',
    'reserve__show',
    'reserved-shop',
    'reserved-date',
    'reserved-time',
    'reserved-number',
    'change__form',
    'reserve__id',
    'shop__id',
    'date__input',
    'time__select',
    'number__select',
    'change__btn'
  ];
  // $.each(idName, function(index,value) {
  //     $('.' + result).each(function(i) {
  //       $(this).attr('id', result + (i + 1));
  //     });
  //   });
  idName.forEach(function(result) {
    $(function() {
      $('.' + result).each(function(i) {
        $(this).attr('id', result + (i + 1));
      });
    });
  });

  // $(function() {
  //   $('.change__form').each(function(i) {
  //     $(this).attr('id', 'change__form' + (i + 1));
  //   });
  // });
  // $(function() {
  //   $('.change__btn').each(function(i) {
  //     $(this).attr('id', 'change__btn' + (i + 1));
  //   });
  // });

  // let $form = $('.change__form').attr('id');
  // let $btn = $('.change__btn').attr('id');

  $(function() {
    $('.change__form').on('click', (function() {
      let $form = $(this).attr('id');
      console.log($form);
    }));
  });
  $(function() {
    $('.change__form').submit('click', (function(e, $form) {
      e.preventDefault();
      let $this = $(this);
      let formData = $this.serialize();
      console.log(formData);
      // let $reserveId = $('.reserve__id').attr('id');
      // let $shopId = $('.shop__id').attr('id');
      // let $dateInput = $('.date__input').attr('id');
      // let $timeSelect = $('.time__select').attr('id');
      // let $numberSelect = $('.number__select').attr('id');
      // console.log($reserveId, $shopId, $dateInput, $timeSelect, $numberSelect);
      // let formData = $(form).serialize();
      // let $formData = $form.serialize();
      // let $this = $(this);
      // let reserveId = $('.reserve__id').val();
      // let shopId = $('.shop__id').val();
      // let dateInput = $('.date__input').val();
      // let timeSelect = $('.time__select').val();
      // let numberSelect = $('.number__select').val();
      // let reserveId = $this.data('reserve-id');
      // let shopId = $this.data('shop-id');
      // let dateInput = $this.data('date-id');
      // let timeSelect = $this.data('time-id');
      // let numberSelect = $this.data('number-id');
      // console.log(reserveId, shopId, dateInput, timeSelect, numberSelect);

      // let reserveId = $this.$('.reserve__id').data('reserve-id');
      // let shopId = $this.$('.shop__id').data('shop-id');
      // let dateInput = $this.$('.date__input').data('date-id');
      // let timeSelect = $this.$('.time__option').data('time-id');
      // let numberSelect = $this.$('.number__option').data('number-id');
      // console.log(reserveId, shopId, dateInput, timeSelect, numberSelect);
      $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "{{ route('update')}}",
          method: 'POST',
          data: formData,
          // {
          //   // 'form': formData
          //   // 'form': formData
          //   'reserve_id': reserveId,
          //   'shop_id': shopId,
          //   'date': dateInput,
          //   'time': timeSelect,
          //   'number': numberSelect,
          // },
        })
        .done(function(data) {
          // $this.toggleClass('red');
          alert('成功');
          // let $date = $('.reserved-date');
          // let $time = $('.reserved-time');
          // let $number = $('.reserved-number');
          // console.log($date, $time, $number)

          console.log(data);

          let date = data.date;
          let time = data.time;
          let number = data.number;
          console.log(date, time, number);

          // let htme = '';
          // html = `

          //         `
          // })
          $('#' + $form , '.reserved-date').html(date);
          $('#' + $form , '.reserved-time').html(time);
          $('#' + $form , '.reserved-number').html(number);

          // $('#reserved-shop1').html(shop);
          // $('#reserved-date1').html($date);
          // $('#reserved-time1').html(time);
          // $('#reserved-number1').html(number);
        })
        .fail(function() {
          alert('error');
        });
    }));
  });

  // １つ前（予約変更）
  // $(function() {
  //   $('.change__btn').on('click', (function() {
  //     let $form = $('.change__form').attr('id');
  //     console.log($form);
  //   }));
  // });
  // $('.change__form').submit('click', (function(e, $form) {
  //   e.preventDefault();
  //   let $reserveId = $('.reserve__id').attr('id');
  //   let $shopId = $('.shop__id').attr('id');
  //   let $dateInput = $('.date__input').attr('id');
  //   let $timeSelect = $('.time__select').attr('id');
  //   let $numberSelect = $('.number__select').attr('id');
  //   console.log($reserveId, $shopId, $dateInput, $timeSelect, $numberSelect);
  //   // let formData = $(form).serialize();
  //   // let $formData = $form.serialize();
  //   // let $this = $(this);
  //   // let reserveId = $('.reserve__id').val();
  //   // let shopId = $('.shop__id').val();
  //   // let dateInput = $('.date__input').val();
  //   // let timeSelect = $('.time__select').val();
  //   // let numberSelect = $('.number__select').val();
  //   let reserveId = $('#' + $reserveId).val();
  //   let shopId = $('#' + $shopId).val();
  //   let dateInput = $('#' + $dateInput).val();
  //   let timeSelect = $('#' + $timeSelect).val();
  //   let numberSelect = $('#' + $numberSelect).val();
  //   $.ajax({
  //       headers: {
  //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //       },
  //       url: "{{ route('update')}}",
  //       method: 'POST',
  //       data: {
  //         // 'form': formData
  //         // 'form': formData
  //         'reserve_id': reserveId,
  //         'shop_id': shopId,
  //         'date': dateInput,
  //         'time': timeSelect,
  //         'number': numberSelect,
  //       },
  //     })
  //     .done(function(data) {
  //       // $this.toggleClass('red');
  //       alert('成功');
  //       let $table = $('.reserve__show').attr('id');
  //       let $shop = $('.reserved-shop').attr('id');
  //       let $date = $('.reserved-date').attr('id');
  //       let $time = $('.reserved-time').attr('id');
  //       let $number = $('.reserved-number').attr('id');
  //       console.log($table, $date, $time, $number)

  //       console.log(data);

  //       let shop = data.shop;
  //       let date = data.date;
  //       let time = data.time;
  //       let number = data.number;
  //       console.log(date, time, number);

  //       // let htme = '';
  //       // html = `

  //       //         `
  //       // })
  //       $('#' + $date).html(date);
  //       $('#' + $time).html(time);
  //       $('#' + $number).html(number);

  //       $('#reserved-shop1').html(shop);
  //       // $('#reserved-date1').html($date);
  //       // $('#reserved-time1').html(time);
  //       // $('#reserved-number1').html(number);
  //     })
  //     .fail(function() {
  //       alert('error');
  //     });
  // }));
  // });


  //１つ前（レビュー機能）
  $(function() {
    $('.reserve__result').each(function(i) {
      $(this).attr('id', 'reserve__result' + (i + 1));
    });
  });
  $(function() {
    $('.error__ul').each(function(i) {
      $(this).attr('id', 'error__ul' + (i + 1));
    });
  });


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