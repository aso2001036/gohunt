<?php
try {
    $db = new PDO('mysql:host=mysql207.phy.lolipop.lan;
    dbname=LAA1290570-gohunt;charaset=utf8',
        'LAA1290570',
        'gohunt');
}   catch (PDOException $e) {
    echo "データベース接続エラー　：".$e->getMessage();
}
session_start();

if (!empty($_POST)) {
    /* 入力情報の不備を検知 */
    if ($_POST['user_mail'] === "") {
        $error['user_mail'] = "blank";
    }
    if ($_POST['user_pass'] === "") {
        $error['user_pass'] = "blank";
    }


    /* メールアドレスの重複を検知 */
    if (!isset($error)) {
        $m_user = $db->prepare('SELECT COUNT(*) as cnt FROM m_user WHERE user_mail=?');
        $m_user->execute(array(
            $_POST['user_mail']
        ));
        $record = $m_user->fetch();
        if ($record['cnt'] > 0) {
            $error['user_mail'] = 'duplicate';
        }
    }

    /* エラーがなければ次のページへ */
    if (!isset($error)) {
        $_SESSION['join'] = $_POST;   // フォームの内容をセッションで保存
        header('Location: reg_confirm.php');   // check.phpへ移動
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" href = "./css/signup.css">
</head>
<body>
<h2>新規登録</h2>
<div class = "IPhone">
    <form action = "" method = "post">
        <div class = "Form">
            <p>ユーザーネーム</p>
            <input type = "text" name = "user_name">
            <p>メールアドレス</p>
            <input type = "text" name = "user_mail">
            <?php if (!empty($error["user_mail"]) && $error['user_mail'] === 'blank'): ?>
                <p class="error">＊メールアドレスを入力してください</p>
            <?php elseif (!empty($error["user_mail"]) && $error['user_mail'] === 'duplicate'): ?>
                <p class="error">＊このメールアドレスはすでに登録済みです</p>
            <?php endif ?>
            <p>パスワード</p>
            <input type = 'text' name = "user_pass">
            <?php if (!empty($error["user_pass"]) && $error['user_pass'] === 'blank'): ?>
                <p class="error">＊パスワードを入力してください</p>
            <?php endif ?>
            <p>パスワード（再）</p>
            <input type = 'text' name = "user_pass">
            <?php if (!empty($error["user_pass"]) && $error['user_pass'] === 'blank'): ?>
                <p class="error">＊パスワードを入力してください</p>
            <?php endif ?>
            <p>性別</p>
        </div>
        <div class = "ra">
            <label><input type = "radio" name = "sex_flag" style="transform: scale(4.0)" value = "0">　男　</label>
            <label><input type = "radio" name = "sex_flag" style="transform: scale(4.0)" value = "1">　女　</label>
            <label><input type = "radio" name = "sex_flag" style="transform: scale(4.0)" value = "2">　その他　</label>
        </div>
        <button type="submit" value="send" class = "SignUp">確認</button><br>
    </form><br>

</div>
</body>
</html>
