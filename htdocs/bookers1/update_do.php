<?php
require('dbconnect.php');
$stmt = $db->prepare('update books set title=?, body=? where id=?');
if(!$stmt){
  die($db->error);
}
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
$stmt->bind_param('ssi', $title, $body, $id);
$success = $stmt->execute();
if(!$success){
  die($db->error);
}
header('Location: book.php?id=' . $id);
?>