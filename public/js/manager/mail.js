function Check(){
      let checked = confirm('メールを送信します。よろしいですか。');
      if (checked == true) {
          return true;
      } else {
          return false;
      }
  }
