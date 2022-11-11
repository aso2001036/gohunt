<?php
require("./conect.php");
session_start();
if (!empty($_POST)) {
    /* 入力情報の不備を検知 */
    if ($_POST['mail'] === "") {
        $error['mail'] = "blank";
    }
    if ($_POST['password'] === "") {
        $error['password'] = "blank";
    }
    
    /* メールアドレスの重複を検知 */
    if (!isset($error)) {
        $member = $pdo->prepare('SELECT COUNT(*) as cnt FROM m_user WHERE mail=?');
        $member->execute(array(
            $_POST['mail']
        ));
        $record = $member->fetch();
        if ($record['cnt'] > 0) {
            $error['mail'] = 'duplicate';
        }
            
    if (!isset($error)) {
        $_SESSION['user'] = $_POST['mail'];   // フォームの内容をセッションで保存
        exit();
    }
 }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
    <link rel="stylesheet" href="css/mypage_edit.css">
    <meta name="viewport" content="width=device-width,initial-scale-1">
</head>
<body>
    <div class="gohant">
         <img src="img/cooltext421301192687833 1-1.png">
    </div>
    <div class="hamburger-menu">
        <input type="checkbox" id="menu-btn-check">
        <label for="menu-btn-check" class="menu-btn"><span></span></label>
    </div>
    <div style="background-color:#505050;">
        <div class="mypage">
           <img src="img/cooltext421486115691405 1.png">
        </div>
    </div>
    <form action="mypage_edit.php" method="post">
        <div class="box">
            <p>ユーザーID</p>
            <div class="margin"></div>
            <input type="text" id="id" class="example" >
            <p>ユーザー名</p>
            <div class="margin"></div>
            <input type="text" id="name" class="example">
            <p>メールアドレス</p>
            <div class="margin"></div>
            <input type="email" id="email" class="example">
            <?php if (!empty($error["mail"]) && $error['mail'] === 'blank'): ?>
                    <p class="error">＊メールアドレスを入力してください</p>
                <?php elseif (!empty($error["mail"]) && $error['mail'] === 'duplicate'): ?>
                    <p class="error">＊このメールアドレスはすでに登録済みです</p>
                <?php endif ?>
            <p>パスワード</p>
            <?php if (!empty($error["password"]) && $error['password'] === 'blank'): ?>
                    <p class="error">＊パスワードを入力してください</p>
                <?php endif ?>
            <div class="margin"></div>
            <input type="password" id="pass" class="example">
            <div class="hoge_button">
                <button type="submit" onclick="mypage.html" value="遷移">変更完了</button>
            </div>
        </div>
    </form>
</body>
</html>