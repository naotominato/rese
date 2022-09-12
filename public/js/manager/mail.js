//----- メール送信前　確認アラート　＋　送信ボタン連打不可 -----//

$(function () {
    $('#manager-mail__btn').click(function() {
        if (confirm('メールを送信します。よろしいですか。')) {
            $(this).prop('disabled', true);
            $(this).closest('#manager-mail__form').submit();
            return true;
        } else {
            return false;
        }
    });
});

