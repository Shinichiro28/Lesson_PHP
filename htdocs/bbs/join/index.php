<?php
session_start();

/* htmlspecialcharsの短縮版を全ページで使える様にする
   保存先のファイルを読み込む */
require('../library.php');

//フォームが空の場合のエラーメッセージを出す準備　フォームの中が空
//確認画面の書き直すリンクからの移動の場合は、入力情報を表示する
if(isset($_GET['action']) && $_GET['action'] == 'rewrite' && isset($_SESSION['form'])){
    $form = $_SESSION['form'];
}else{
    $form = [
        'name' => '',
        'email' => '',
        'password' => ''
    ];
}
$error = [];



//フォームが送信された時のif構文(フォームの内容をチェック)
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $form['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    if($form['name'] == ''){
        $error['name'] = 'blank';
    }
    $form['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    if($form['email'] == ''){
        $error['email'] = 'blank';
    }else{
        $db = dbconnect();
        $stmt = $db->prepare('select count(*) from members where email=?');
        if(!$stmt){
            die($db->error);
        }
        $stmt->bind_param('s', $form['email']);
        $success = $stmt->execute();
        if(!$success){
            die($db->error);
        }
        $stmt->bind_result($cnt);
        $stmt->fetch();

        if($cnt > 0){
            $error['email'] = 'duplicate';
        }
    }
    $form['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if($form['password'] == ''){
        $error['password'] = 'blank';
    }else if(strlen($form['password']) < 4){
        $error['password'] = 'length';
    }
    //画像のチェック
    $image = $_FILES['image'];
    if($image['name'] !== '' && $image['error'] == 0){
        //mime_content_type(): 何のファイイルがアップロードされたのかが分かる
        $type = mime_content_type($image['tmp_name']);
        if($type !== 'image/png' && $type !== 'image/jpeg'){
            $error['image'] = 'type';
        }
    }

    //エラーがなければ次のページに移動する
    if(empty($error)){
        $_SESSION['form'] = $form;

        /* 画像のアップロード
           $filenameではファイル名が作成される */
        //画像が指定されていなかった時のif構文
        if($image['name'] !== ''){
        $filename = date('YmdHis', ) . '_' . $image['name'];
            /* move_uploaded_file(temporary, formal): 画像がアップロードされたときに一時的な場所から正式な場所に移動する
               temporary: 現在の保存場所
               formal: 移動先の場所 */
            if(!move_uploaded_file($image['tmp_name'], '../member_picture/' . $filename)){
                die('ファイルのアップロードに失敗しました');
            }
            $_SESSION['form']['image'] = $filename;
        }else{
            $_SESSION['form']['image'] = '';
        }

        header('Location: check.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会員登録</title>

    <link rel="stylesheet" href="../style.css"/>
</head>

<body>
<div id="wrap">
    <div id="head">
        <h1>会員登録</h1>
    </div>

    <div id="content">
        <p>次のフォームに必要事項をご記入ください。</p>
        <form action="" method="post" enctype="multipart/form-data">
            <dl>
                <dt>ニックネーム<span class="required">必須</span></dt>
                <dd>
                    <input type="text" name="name" size="35" maxlength="255" value="<?php echo h($form['name']); ?>"/>
                    <?php if(isset($error['name']) && $error['name'] == 'blank'): ?>
                        <p class="error">* ニックネームを入力してください</p>
                    <?php endif; ?>
                </dd>
                <dt>メールアドレス<span class="required">必須</span></dt>
                <dd>
                    <input type="text" name="email" size="35" maxlength="255" value="<?php echo h($form['email']); ?>"/>
                    <?php if(isset($error['email']) && $error['email'] == 'blank'): ?>
                        <p class="error">* メールアドレスを入力してください</p>
                    <?php endif; ?>
                    <?php if(isset($error['email']) && $error['email'] == 'duplicate'): ?>
                        <p class="error">* 指定されたメールアドレスはすでに登録されています</p>
                    <?php endif; ?>
                <dt>パスワード<span class="required">必須</span></dt>
                <dd>
                    <input type="password" name="password" size="10" maxlength="20" value="<?php echo h($form['password']); ?>"/>
                    <?php if(isset($error['password']) && $error['password'] == 'blank'): ?>
                        <p class="error">* パスワードを入力してください</p>
                    <?php endif; ?>
                    <?php if(isset($error['password']) && $error['password'] == 'length'): ?>
                        <p class="error">* パスワードは4文字以上で入力してください</p>
                    <?php endif; ?>
                </dd>
                <dt>写真など</dt>
                <dd>
                    <input type="file" name="image" size="35" value=""/>
                    <?php if(isset($error['image']) && $error['image'] == 'type'): ?>
                        <p class="error">* 写真などは「.png」または「.jpg」の画像を指定してください</p>
                    <?php endif; ?>
                    <p class="error">* 恐れ入りますが、画像を改めて指定してください</p>
                </dd>
            </dl>
            <div><input type="submit" value="入力内容を確認する"/></div>
        </form>
    </div>
</body>

</html>