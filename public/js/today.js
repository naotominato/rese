//----- QRコードページ遷移前　確認アラート -----//

$('#qr__button').click(function() {
  if (confirm('こちらは来店時に使用するQRコードです。表示してよろしいでしょうか。')) {
    return true;
  } else {
    return false;
  }
});