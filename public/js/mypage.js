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
  if (confirm('選択された内容で予約を変更してよろしいでしょうか')) {
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



//----- 予約変更画面の表示 -----//

// $(function(){
//     $('.change__button').each(function(i){
//         $(this).attr('id','butt' + (i+1));
//     });
// });

// $(function(){
//     $('.change__form').each(function(i){
//         $(this).attr('class','butt' + (i+1));
//     });
// });

// $(function(){
//   $('.change__form').hide();

//   $('.change__button').on('click',function(){
//     // クリックした要素の ID と違うクラス名のセクションを非表示
//     $('.change__form').not($('.'+$(this).attr('id'))).hide();
//     // クリックした要素の ID と同じクラスのセクションを表示
//     $('.'+$(this).attr('id')).show();

//     // toggle にすると、同じボタンを 2 回押すと非表示になる
//     // $('.'+$(this).attr('id')).toggle();
//   });
// });


