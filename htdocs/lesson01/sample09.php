<?php
date_default_timezone_set('Asia/Tokyo');

$hello = 'こんにちは';
echo $hello . '<br>';
echo '$hello<br>';
echo "$hello<br>"; //""は中に変数が入っているときに限り、変数を展開できる
for($i=0; $i<366; $i++):
  $time = strtotime("+$i  day");
  $day = date('n/j(D)', $time);
  echo $day . '<br>';
endfor;
?>
