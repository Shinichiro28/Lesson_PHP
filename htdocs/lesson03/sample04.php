<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sample04</title>
</head>
<body>
  <?php
  $db = new mysqli('localhost:8889', 'root', 'root', 'mydb');
  $message = 'フォームからのメモです';
  /*prepare(): 実行するためのSQL文を準備する、組み立てる。
  　※フォームなどから直接querで実行しようとすると非常に危険
  prepare()は?をSQLの中に入れることができ、後からbind_paramで指定することができる */
  $stmt = $db->prepare('insert into memos(memo) values(?)');
  //prepare()で構文チェックが入るため、if構文でチェックが必要
  if(!$stmt):
    //die(): メッセージを表示させてそのままプログラムを終了させる。 exit()と同義。
    die($db->error);
  endif;
  /*bind_param('type', var): SQLの中に?がある時に、その?の中に何を入れるかをパラメータとして指定
  type: 入れる変数の型(の頭文字のみを小文字で)
  var: 変数 */
  $stmt->bind_param('s', $message);
  //execute(): bind_paramsした値を使ってprepareで準備されたSQLを実行する
  $ret = $stmt->execute();
  if($ret){
    echo 'データを挿入しました';
  }else{
    echo $db->error;
  }
  ?>
</body>
</html>