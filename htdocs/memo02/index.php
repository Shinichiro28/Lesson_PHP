<?php
require('dbconnect.php');
$counts = $db->query('select count(*) as cnt from memos_02');
$count = $counts->fetch_assoc();
$max = ceil($count['cnt'] / 5);
$stmt = $db->prepare('select * from memos_02 order by id desc limit ?, 5');
if(!$stmt){
  die($db->error);
}
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
if(!$page){
  $page = 1;
}
$start = ($page - 1) * 5;
$stmt->bind_param('i', $start);

$success = $stmt->execute();
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
  <?php if(!$success): ?>
    <p>表示するデータはありません</p>
  <?php endif; ?>
  
  <h1>メモ帳</h1>
  <div>→<a href="input.html">新しいメモ</a></div>
  <?php
  $stmt->bind_result($id, $memo, $created);
  while($stmt->fetch()):
  ?>
  <h2><a href="memo.php?id=<?php echo $id; ?>"><?php echo htmlspecialchars(mb_substr($memo, 0, 50)); ?></a></h2>
  <p><?php echo htmlspecialchars($created); ?></p>
  <hr>
  <?php endwhile; ?>
  <?php if($page>1): ?>
    <a href="?page=<?php echo $page-1; ?>"><?php echo $page-1; ?>ページ目へ</a>
    ｜
  <?php endif; ?>
  <?php if($page<$max): ?>
    <a href="?page=<?php echo $page+1; ?>"><?php echo $page+1; ?>ページ目へ</a>
  <?php endif; ?>
</body>
</html>