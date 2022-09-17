<?php
$age = '２３';
//mb_convert_kana(string, mode, encording): カナを全角かな、半角かなに変換する
//mode: nは全角を半角に変換するためのパラメーター。他にもいっぱいある
//encording: 文字エンコーディングを指定。デフォルトは内部文字エンコーディング
$age = mb_convert_kana($age, 'n', 'UTF-8');

//is_numeric: 
if(is_numeric($age)){
  echo $age . '歳です';
}else{
  echo '※ 数字で入力して下さい';
}
?>