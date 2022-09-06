//----- メール送信前　確認アラート -----//

function Check() {
    let checked = confirm('メールを送信します。よろしいですか。');
    if (checked == true) {
        return true;
    } else {
        return false;
    }
}

//----- 送信ボタン連打不可 -----//

$(function () {
    $('#manager-mail__btn').click(function() {
        $(this).prop('disabled', true);
        $(this).closest('#manager-mail__form').submit();
    });
});
