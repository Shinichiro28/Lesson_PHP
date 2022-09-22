<?php
//htmlspecialcharsを短くする
function h($value){
    return htmlspecialchars($value, ENT_QUOTES);
}

//DB接続
function dbconnect(){
  $db = new mysqli('localhost: 8889', 'root', 'root', 'min_bbs');
  if(!$db){
    die($db->error);
  }
  return $db;
}


?>