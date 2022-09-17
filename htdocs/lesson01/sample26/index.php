<?php
$value = '変数に保存した値です';
//setcookie(name, value, options): クッキーを送信する
//name: クッキーの名前
//value: クッキーの値 変数など…
//options: クッキーの有効期限。秒
setcookie('message', 'Cookieに保存した値です', time() + 60 * 60 * 24 * 14);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>lesson26</title>
</head>
<body>
  <a href="page02.php">２ページ目へ</a>
</body>
</html>