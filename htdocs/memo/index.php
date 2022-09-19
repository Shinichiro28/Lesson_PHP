<?php
require('dbconnect.php');
$memos = $db->query('select * from memos order by id desc');
if(!$memos){
  die($db->error);
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
  <p>→ <a href="input.html">新しいメモ</a></p>
  <?php while($memo = $memos->fetch_assoc()): ?>
  <div>
    <!--mb_substr(string, a, b): 文字を省略する
        string: 省略する文字
        a: 返し位置
        b: 何文字切り取るか -->
    <h2><a href="#"><?php echo htmlspecialchars(mb_substr($memo['memo'], 0, 50)); ?></a></h2>
    <time><?php echo htmlspecialchars($memo['created']); ?></time>
  </div>
  <!--hrタグで枠線を作る-->
  <hr>
  <?php endwhile; ?>
</body>
</html>