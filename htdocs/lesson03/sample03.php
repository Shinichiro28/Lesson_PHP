<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sample03</title>
</head>
<body>
  <?php
  $db = new mysqli('localhost:8889', 'root', 'root', 'mydb');
  //メモの残し方: insert テーブル名 (カラム名) values ('メモの内容')
  $ret = $db->query('insert memos (memo) values("PHPからのメモです")');
  if($ret){
    echo 'データを挿入しました';
  }else{
    echo $db->error;
  }
  ?>
</body>
</html>