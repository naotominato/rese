//----- 予約　リアルタイム入力 -----//

$("#reserve__date").on("input", function (e) {
  var date = e.target
  $(".check__date").text(date.value)
});
$("#reserve__time").on("input", function (e) {
  var time = e.target
  $(".check__time").text(time.value)
});
$("#reserve__number").on("input", function (e) {
  var number = e.target
  $(".check__number").text(number.value + '人')
});

//----- 予約ボタン連打不可（二重予約防止） -----//

$(function() {
  $('#reserve__btn').click(function() {
    $(this).prop('disabled', true);
    $(this).closest('#reserve__form').submit();
  });
});

//----- 予約前　確認アラート -----//

$('#reserve__btn').click(function() {
  if (confirm('予約を確定します。選択された内容でお間違いないでしょうか。')) {
    return true;
  } else {
    return false;
  }
});