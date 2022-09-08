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