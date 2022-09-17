<?php
//独自ファンクションを作成
function intax($value){
  return ceil($value * 1.1);
}

$price = 150;
$price_tax = intax($value)
echo $price_tax;
?>