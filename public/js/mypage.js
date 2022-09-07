//----- 予約削除前　確認アラート -----//

$('.cancel__btn').click(function() {
  if (confirm('選択された予約をキャンセルしてもよろしいでしょうか。')) {
    return true
  } else {
    return false
  }
});

//----- 予約変更前　確認アラート -----//

$('.change__btn').click(function() {
  if (confirm('選択された内容で予約を変更してよろしいでしょうか。')) {
    return true;
  } else {
    return false;
  }
});

//----- 評価　送信前　確認アラート -----//

$('.review__btn').click(function() {
  if (confirm('レビューありがとうございます！　一度投稿されたレビューは修正、取消ができません。投稿してもよろしいでしょうか。')) {
    return true
  } else {
    return false
  }
});



// let idName = [
//     'reserve__result',
//     'reserve__show',
//     'reserved-shop',
//     'reserved-date',
//     'reserved-time',
//     'reserved-number',
//     'change__form',
//     'reserve__id',
//     'shop__id',
//     'date__input',
//     'time__select',
//     'number__select',
//     'change__btn'
// ];

// idName.forEach(function(result) {
//   $(function() {
//     $('.' + result).each(function(i) {
//       $(this).attr('id', result + (i + 1));
//     });
//   });
// });

// $(function() {
//   $('.change__form').on('click', (function() {
//     let $form = $(this).attr('id');
//     console.log($form);
//   }));
// });
// $(function() {
//   $('.change__form').submit('click', (function(e, $form) {
//     e.preventDefault();
//     let $this = $(this);
//     let formData = $this.serialize();
//     console.log(formData);
//     $.ajax({
//           headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           },
//           url: "{{ route('update')}}",
//           method: 'POST',
//           data: formData,
//           })
//       .done(function (data) {
//         alert('成功');
//         console.log(data);

//         let date = data.date;
//         let time = data.time;
//         let number = data.number;
//         console.log(date, time, number);

//         $('#' + $form , '.reserved-date').html(date);
//         $('#' + $form , '.reserved-time').html(time);
//         $('#' + $form, '.reserved-number').html(number);
//         })
//         .fail(function() {
//           alert('error');
//         });
//     }));
//   });