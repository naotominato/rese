//----- QRコードページ遷移前　確認アラート -----//

$('.qr__button').click(function() {
  if (confirm('こちらは来店時に使用するQRコードです。\n表示してよろしいでしょうか。')) {
    return true;
  } else {
    return false;
  }
});

//----- 予約削除前　確認アラート -----//

$('.reserve__cancel').click(function() {
  if (confirm('こちらは本日のご予約です。\n選択された予約をキャンセルしてもよろしいでしょうか。')) {
    return true;
  } else {
    return false;
  }
});

//----- 予約削除　不可アラート -----//

$('.reserve__no-cancel').click(function () {
  alert('予約時間を過ぎたため、こちらからはキャンセルできません。\n直接、店舗へご連絡ください。')
});