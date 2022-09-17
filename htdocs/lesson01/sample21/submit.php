<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sample21</title>
</head>
<body>
  <h2>ご予約日</h2>
  <!--reserveが配列のため、$_REQUESTでは直接表示できない-->
  <!--そのため一旦変数に代入する-->
  <?php $reserves = $_REQUEST['reserve']; ?>
  <ul>
    <!--変数に代入した配列をforeach構文で表示する-->
    <?php foreach($reserves as $reserve): ?>
      <li><?php echo htmlspecialchars($reserve); ?></li>
    <?php endforeach; ?>
  </ul>
</body>
</html>