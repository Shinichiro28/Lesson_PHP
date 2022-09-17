<?php 
//$_FILES[]: HTTP ファイルをアップロード
$file = $_FILES['picture'];

//jpegまたはpngの写真以外は受け付けない様にする
if($file['type'] == 'image/jpeg' ||
    $file['type'] == 'image/png'){
  $path = 'images/' . $file['name'];
  //move_uploaded_file(from, to): アップロードされたファイルを新しい位置に移動する
  //具体的には、from で指定されたファイルが有効なアップロードファイルであるかどうかを確認し、そのファイルが有効な場合、to で指定したファイル名に移動される。
  //from: アップロードしたファイルのファイル名
  //to: ファイルの保存先
  $success = move_uploaded_file($file['tmp_name'], $path);

  if($success) {
    echo '成功しました';
  } else{
    echo '失敗しました';
  }
} else{
  echo 'ファイル形式が不正です';
}
?>