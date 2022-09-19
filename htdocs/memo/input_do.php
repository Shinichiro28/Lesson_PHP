<?php
/* filter_input(type, var_name, filter): get, post, cookie, serverなどの値を受け取り、それにフィルターをかける
   type: 受け取り方の設定。INPUT_GET,INPUT_POST,INPUT_COOKIE,INPUT_SERVER,INPUT_ENV のいずれか。
   var_name: 取得する変数の名前
   filter: 適用するフィルタのID
   FILTER_SANITIZE_SPECIAL_CHARS: 文字化けや誤動作を起こす様なものを無害化する
*/
$memo = filter_input(INPUT_POST, 'memo', FILTER_SANITIZE_SPECIAL_CHARS);
//DB接続を共通化
require('dbconnect.php');

$stmt = $db->prepare('insert into memos(memo) values(?)');
if(!$stmt):
  die($db->error);
endif;
$stmt->bind_param('s', $memo);
$ret = $stmt->execute();
if($ret):
  echo '登録されました';
  echo '<br>→ <a href="index.php">トップへ戻る</a>';
else:
  echo $db->error;
endif;
?>