<?php
$random = rand(0, 1);
if($random == 0){
  echo 'あたりです';
} else {
  echo 'ハズレです';
}
echo $random;
?>