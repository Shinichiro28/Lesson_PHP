<?php
require('dbconnect.php');
$stmt = $db->prepare('delete from memos_02 where id=?');
if(!$stmt){
  die($db->error);
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!$id){
  echo 'メモが正しく指定されていません';
}
$stmt->bind_param('i', $id);
$success = $stmt->execute();
if(!$success){
  die($db->error);
}
header('Location: index.php');
?>