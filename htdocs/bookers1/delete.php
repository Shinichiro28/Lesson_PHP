<?php
require('dbconnect.php');
$stmt = $db->prepare('delete from books where id=?');
if(!$stmt){
  die($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!$id){
  echo '該当の本を正しく指定されていません';
}
$stmt->bind_param('i', $id);
$success = $stmt->execute();
if(!$success){
  die($db->error);
}
header('Location: books.php');
exit();
?>