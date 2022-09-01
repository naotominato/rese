//----- input type="file"を装飾 -----//

$('#file__input').on('change', function () {
    let file = $(this).prop('files')[0];
    $('#file__name').text(file.name);
});

//----- 店舗情報　送信前　確認アラート -----//

$('#register-shop__btn').click(function() {
  if (confirm('店舗情報を登録します。よろしいですか。')) {
    return true
  } else {
    return false
  }
});