//----- ログインボタン連打不可 -----//

$(function () {
  $('#login__btn').click(function() {
    $(this).prop('disabled', true);
    $(this).closest('#login__form').submit();
  });
});
