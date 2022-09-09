//----- 登録ボタン連打不可 -----//

$(function () {
    $('#register__btn').click(function() {
      $(this).prop('disabled', true);
      $(this).closest('#register__form').submit();
    });
  });