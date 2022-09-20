<?php
require('dbconnect.php');
//limit: １ページに載せる件数を絞る。　limit 0, 5: ５件に絞る
$stmt = $db->prepare('select * from memos order by id desc limit ?, 5');
if(!$stmt){
  die($db->error);
}
/* 最大ページを求める */
$records = $db->query('select count(*) as cnt from memos');
$record = $records->fetch_assoc();
$max = ceil($record['cnt'] / 5);
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
//URLパラメータの省略
//if構文を三項演算子で
$page = ($page ?: 1);
$start = ($page - 1) * 5;
$stmt->bind_param('i', $start);
$result = $stmt->execute();
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
  <p>→ <a href="input.html">新しいメモ</a></p>
  <!-- URLパラメータの制御(表示するリンクのないページ用) -->
  <?php if(!$result) : ?>
    <p>表示するメモはありません</p>
  <?php endif; ?>
  <?php $stmt->bind_result($id, $memo, $created); ?>
  <?php while($stmt->fetch()): ?>
  <div>
    <!--mb_substr(string, a, b): 文字を省略する
        string: 省略する文字
        a: 返し位置
        b: 何文字切り取るか -->
    <h2><a href="memo.php?id=<?php echo $id; ?>"><?php echo htmlspecialchars(mb_substr($memo, 0, 50)); ?></a></h2>
    <time><?php echo htmlspecialchars($created); ?></time>
  </div>
  <!--hrタグで枠線を作る-->
  <hr>
  <?php endwhile; ?>

  <p>
    <!--０ページ目への表示をさせない-->
    <?php if($page>1): ?>
      <a href="?page=<?php echo $page-1; ?>"><?php echo $page-1; ?>ページ目へ</a>
    <?php endif; ?>
    ｜
    <?php if($page<$max): ?>
    <a href="?page=<?php echo $page+1; ?>"><?php echo $page+1; ?>ページ目へ</a>
    <?php endif; ?>
  </p>
</body>
</html>