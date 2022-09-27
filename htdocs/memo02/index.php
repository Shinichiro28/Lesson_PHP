<?php
require('dbconnect.php');
$stmt = $db->prepare('select * from memos_02 order by id desc limit ?, 5');
if(!$stmt){
  die($db->error);
}
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);

$start = ($page - 1) * 5;
$stmt->bind_param('i', $start);

$success = $stmt->execute();
if(!$success){
  echo $db->error;
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メモ帳</title>
</head>
<body>
  <h1>メモ帳</h1>
  <div>→<a href="input.html">新しいメモ</a></div>
  <?php
  $stmt->bind_result($id, $memo, $created);
  while($stmt->fetch()):
  ?>
  <h2><a href="memo.php?=<?php echo $id; ?>"><?php echo htmlspecialchars(mb_substr($memo, 0, 50)); ?></a></h2>
  <p><?php echo htmlspecialchars($created); ?></p>
  <hr>
  <?php endwhile; ?>
  <a href="?page=2">2ページ目へ</a>
  ｜
  <a href="?page=2">２ページ目へ</a>
</body>
</html>