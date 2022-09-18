<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sample01</title>
</head>
<body>
  <?php
  /* mysqlに接続する
  new mysqli(localhost, user, password, database);
  ->mysqlを参照
  localhost: ホスト名　HostとPortの内容を記入
  ->localhost: 8889
  user: ユーザー名　Usernameの内容を記入
  password: Passwordの内容を記入
  database: 作成したファイル名を記入 */
  $db = new mysqli('localhost:8889', 'root', 'root', 'mydb');

  /* テーブルを削除する
   query('drop table テーブル名); */
   $db->query('drop table if exists test');

  /* SQLをPHPで発行する
  　　db->query('create table テーブル名(変数 型)'); */
  /* テーブルが作成できたかを確認できる様にする
     query()の、失敗したら返り値にfalseを返す特性を活かす */
  $success = $db->query('create table test(id INT)');
  if($success){
    echo 'テーブルを削除して、作成しました';
  }else{
    echo 'SQLが正常に動作しませんでした';
    //error メッセージを表示する
    echo $db->error;
  }
  ?>
</body>
</html>