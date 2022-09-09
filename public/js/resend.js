//----- メール再送　確認アラート -----//

$('.resend__btn').click(function () {
  if (confirm('確認メールを再送しますか。')) {
    return true
  } else {
    return false
  }
});