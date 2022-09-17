<?php
//session_start(): 新しいセッションを開始or既存のセッションを再開する
session_start();
//現在のセッションIDを新しく生成したものと置き換える
session_regenerate_id();

//$_SESSION[]: セッション変数
$_SESSION['message'] = 'セッションに保存した値です';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lesson27</title>
</head>
<body>
  <a href="page02.php">２ページ目へ</a>
</body>
</html>