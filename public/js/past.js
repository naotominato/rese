//----- 評価　送信前　確認アラート -----//

$('.review__btn').click(function() {
  if (confirm('レビューありがとうございます！\n一度投稿されたレビューは修正、取消ができません。\n投稿してもよろしいでしょうか。')) {
    return true
  } else {
    return false
  }
});