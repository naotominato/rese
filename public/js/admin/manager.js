//----- 店舗代表者登録　送信前　確認アラート -----//

$('#register-manager__btn').click(function() {
  if (confirm('新規で店舗代表者を登録します。よろしいですか。')) {
    return true
  } else {
    return false
  }
});