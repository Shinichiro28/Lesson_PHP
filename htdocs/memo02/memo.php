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

$stmt = $db->prepare('select * from memos_02 where id=?');
if(!$stmt){
  die($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!$id){
  echo '表示するメモを指定して下さい';
}
$stmt->bind_param('i', $id);
$stmt->execute();

$stmt->bind_result($id, $memo, $created);
$stmt->fetch();

?>

  <p><pre><?php echo htmlspecialchars($memo); ?></pre></p>
  <p>
    <a href="update.php?id=<?php echo $id; ?>">編集する</a>
    ｜
    <a href="delete.php?id=<?php echo $id; ?>">削除する</a>
    ｜
    <a href="index.php">一覧へ</a>
  </p>
</body>
</html>