<?php
date_default_timezone_set('Asia/Tokyo');
$time = date('G');
?>

<?php if($time < 15): ?>
  <p>※ 営業時間外です</p>
<?php else: ?>
  <p>ようこそ</p>
<?php endif; ?>

<?php
$s = '山下美月';
if($s):
  echo '文字が入っています。';
else:
  echo '文字が入っていません';
endif;

$x = 0;
if($x):
  echo '0ではありません';
else:
  echo '0です';
endif;
?>