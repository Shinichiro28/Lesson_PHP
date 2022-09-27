<?php
//db接続
require('dbconnect.php');
//情報を受け取り、無害化する
$memo = filter_input(INPUT_POST, 'memo', FILTER_SANITIZE_SPECIAL_CHARS);
//dbに保存
if(!($memo == '')){
  $stmt = $db->prepare('insert into memos_02(memo) values(?)');
  if(!$stmt){
    die($db->error);
  }
  $stmt->bind_param('s', $memo);
  $success = $stmt->execute();
  if(!$success){
    echo $db->error;
  }
}else{
  header('Location: input.html');
  exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>送信</title>
</head>
<body>
  登録されました。<br>
  <a href="index.php">→トップへ戻る</a>
</body>
</html>