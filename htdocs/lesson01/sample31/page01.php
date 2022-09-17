<?php
//指定のファイルを読み込ませる処理
require('intax.php');

$price = 1500;
$price_tax = intax($price);
echo $price_tax;
?>