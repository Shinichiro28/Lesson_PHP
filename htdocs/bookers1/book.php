<?php
require('dbconnect.php');
$stmt = $db->prepare('select * from books where id=?');
if(!$stmt){
  die($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($id, $title, $body);
$stmt->fetch();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>詳細</title>
</head>
<body>
  <p><strong>Title：</strong><?php echo htmlspecialchars($title); ?></p>
  <p><strong>Body： </strong><?php echo htmlspecialchars($body); ?></p>
  <p>
    <a href="edit.php?id=<?php echo $id; ?>">Edit</a>
    ｜
    <a href="books.php">Back</a>
  </p>
</body>
</html>