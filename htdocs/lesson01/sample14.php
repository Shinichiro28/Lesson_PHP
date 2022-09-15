<?php
//2021.08.03といった日付にしたい
//sprintf 文字列をフォーマット化するファンクション
$date = sprintf('%04d.%02d.%02d', 2021, 8, 3);
echo $date;
?>

<?php
$time = date('o.m.d');
echo $time;
?>
