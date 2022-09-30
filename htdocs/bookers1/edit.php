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
$result = $stmt->fetch();
if(!$result){
  die('メモの指定がありません');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>編集</title>
</head>
<body>
  <form action="update_do.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <p>Title</p>
    <textarea name="title" cols="20" rows="1" placeholder="タイトルを入力して下さい"><?php echo htmlspecialchars($title); ?></textarea>
    <p>Body</p>
    <textarea name="body" cols="20" rows="5" placeholder="感想を入力して下さい"><?php echo htmlspecialchars($body); ?></textarea>
    <button type="submit">Update Book</button>
  </form>
  <p>
    <a href="book.php?id=<?php echo $id; ?>">Show</a>
    ｜
    <a href="book.php">Back</a>
  </p>
</body>
</html>