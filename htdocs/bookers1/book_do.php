<?php
//投稿
require('dbconnect.php');
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_SPECIAL_CHARS);
if(!($title == '') && !($body == '')){
  $stmt = $db->prepare('insert into books (title, body) values(?,?)');
  if(!$stmt){
    die($db->error);
  }
  $stmt->bind_param('ss', $title, $body);
  $success = $stmt->execute();
  if(!$success){
    echo $db->error;
  }
}else{
  header('Location: books.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投稿</title>
</head>
<body>
  登録されました。<br>
  <a href="books.php">→トップへ戻る</a>
</body>
</html>