//----- 新規店舗名登録　送信前　確認アラート -----//

$('#create-shop__btn').click(function() {
  if (confirm('新規店舗の店舗名のみを登録します。よろしいですか。')) {
    return true
  } else {
    return false
  }
});