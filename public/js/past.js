//----- 評価　送信前　確認アラート -----//

$('.review__btn').click(function() {
  if (confirm('レビューありがとうございます！　一度投稿されたレビューは修正、取消ができません。投稿してもよろしいでしょうか。')) {
    return true
  } else {
    return false
  }
});