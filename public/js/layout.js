//----- ドロワーメニュー -----//   

$(function () {
  $('#checkbox').on('click', function() {
    $('.menu').toggleClass('is-active');
  });
}());

//----- フォームボタン連打不可 -----//

// $(function() {
//     $('button').click(function() {
//       $(this).prop('disabled', true);
//       $(this).closest('form').submit();

//     });
// });