<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sample20</title>
</head>
<body>
  <?php
  //empty():変数が空か否かを検査する。
  //$_REQUEST[]:リクエスト変数。GET,POST,COOKIEといった仕組みでスクリプトに渡される。
  //※リモートユーザーが変更可能なため、信頼度低。
  //そのため、postで送信する場合は$_POST[]を使う方が良い
  ?>
  <?php if(!empty($_POST['my_name'])): ?>
   <?php
    //htmlspecialchars(string, flags):特殊文字をTHMLエンティティに変換する。
    //string:返還される文字列
    //flags:クォートや無効な符号単位シーケンス、文書型の扱いを指定
    //ENT_QUOTES:シングルクォートとダブルクォートを共に変換。
   ?>
  <p>お名前：<?php echo htmlspecialchars($_POST['my_name'], ENT_QUOTES); ?></p>
  <?php endif; ?>
</body>
</html>