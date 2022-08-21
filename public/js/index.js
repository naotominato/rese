// お気に入りアイコンのidに "１" スタートで 連番処理

$(function () {
    $('.favorite__icon').each(function(i) {
      $(this).attr('id', 'favorite__icon' + (i + 1));
    });
});
  
// クリックしたクラス（.favorite__icon）のidを取得
// console.logは取得idを確認する用にとりあえず配置（削除する？）

  $(function() {
    $('.favorite__icon').on('click', (function() {
      let $click = $(this).attr('id');
      console.log($click);
    }));
  });

//クリックした .favorite__icon のidを引数で取得して、ajax処理

  $(function() {
    $('.favorite__icon').on('click', (function($click) {
      let $this = $(this);
      let shopId = $this.data('favorite-id');
      $.ajax({
          url: "{{ route('change')}}",
          method: 'POST',
          data: {
            'shop_id': shopId
          },
        })
        .done(function(data) {
          $this.toggleClass('pink');
        })
        //ユーザーに表示させないので、削除予定？   
        .fail(function() {
          alert('error');
        });
    }));
  });