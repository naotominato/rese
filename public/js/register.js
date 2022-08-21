//----- 登録ボタン連打不可 -----//
//連打で既に登録済みとなり、画面上ではemail uniqueバリデーションがかかってしまうため、それを防ぐ。

$(function () {
    $('#register__btn').click(function() {
      $(this).prop('disabled', true);
      $(this).closest('#register__form').submit();
    });
  });