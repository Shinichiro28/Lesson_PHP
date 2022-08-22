<?php
date_default_timezone_set('Asia/Tokyo');

for($i=0; $i<366; $i++):
  $time = strtotime("+$i day");
  //'+' . $i . 'day' = "+$i day"
  // ''何が入っていても中身をそのまま表示
  // ""変数は
  $day = date('n/j(D)', $time);
  echo $day . '<br>';
endfor;
// strtotime
// srting to time
// 英文形式の日付をUnixタイムスタンプに変換する
?>

