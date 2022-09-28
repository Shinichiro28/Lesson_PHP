<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メモ詳細</title>
</head>
<body>
  <?php 
  require('dbconnect.php');
  $stmt = $db->prepare('select * from memos where id=?');
  if(!$stmt){
    die($db->error);
  }
  //idによって自由にメモの内容を取り出せるようにする
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  //正しいURLパラメーターを渡さなかった場合やいたずらで、存在しないIDを渡されたりする可能性があり、それを防ぐ
  if(!$id){
    echo '表示するメモを指定して下さい';
    exit();
  }
  $stmt->bind_param('i', $id);
  $stmt->execute();
  //bind_result(): 渡ってくる値で各カラムを何の変数に割り当てるかを指定する
  $stmt->bind_result($id, $memo, $created);
  //fetch(): データベースからデータを１件取り出す
  $stmt->fetch();
  ?>
  <div><pre><?php echo htmlspecialchars($memo); ?></pre></div>
  <p>
    <a href="update.php?id=<?php echo $id; ?>">編集する</a>
    ｜
    <a href="delete.php?id=<?php echo $id; ?>">削除する</a>
    ｜
    <a href="/memo">一覧へ</a>
  </p>
</body>
</html>