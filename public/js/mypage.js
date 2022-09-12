//----- 予約　削除前　確認アラート -----//

$('.cancel__btn').click(function() {
  if (confirm('選択された予約をキャンセルしてもよろしいでしょうか。')) {
    return true
  } else {
    return false
  }
});

//----- 予約　変更前　確認アラート -----//

$('.change__btn').click(function() {
  if (confirm('選択された内容で予約を変更してよろしいでしょうか。')) {
    return true;
  } else {
    return false;
  }
});