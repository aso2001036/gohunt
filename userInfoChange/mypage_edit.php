<?php 
session_start();
try {
    $pdo = new PDO('mysql:host=mysql207.phy.lolipop.lan;
  dbname=LAA1290570-gohunt;charaset=utf8',
  'LAA1290570',
  'gohunt');
}   catch (PDOException $e) {
    echo "データベース接続エラー：".$e->getMessage();
}
$sql = $pdo->prepare('SELECT * FROM m_user WHERE user_id='.$_SESSION['user_id'].'');
$sql->execute();
$result = $sql->fetch(PDO::FETCH_ASSOC);
$pdo=null;

if (!empty($_POST)) {
    /* 入力情報の不備を検知 */
    if ($_POST['user_name'] === ""){
        $error['user_name'] = "blank";
    }

    if ($_POST['user_mail'] === "") {
        $error['user_mail'] = "blank";
    }
    
    if ($_POST['user_pass'] === "") {
        $error['user_pass'] = "blank";
    }
    /* エラーがなければ次のページへ */
    if (!isset($error)) {
        $_SESSION['join'] = $_POST;   // フォームの内容をセッションで保存
        header('Location: mypage_confirm.php');   // check.phpへ移動
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
<?php require("../header/menu.php"); ?>
    <div style="background-color:#505050;">
        <div class="mypage">
           <img src="img/cooltext421486115691405 1.png">
        </div>
    </div>
    <form action="mypage_confirm.php" method="post">
    <input type="hidden" name="check" value="checked">
        <div class="box">
            <p>ユーザーID</p>
            <div class="margin"></div>
            <input type="text" id="id" class="example" name="user_id" value="<?php if (!empty($result['user_id'])) echo(htmlspecialchars($result['user_id'], ENT_QUOTES, 'UTF-8'));?>" readonly>
            <p>ユーザー名</p>
            <div class="margin"></div>
            <input type="text" id="name" class="example" name="user_name"value="<?php if (!empty($result['user_name'])) echo(htmlspecialchars($result['user_name'], ENT_QUOTES, 'UTF-8'));?>" required>
            <?php if (!empty($error["user_name"]) && $error['user_name'] === 'blank'): ?>
                <p class="error">＊ユーザー名を入力してください</p>
            <?php endif ?>
            <p>メールアドレス</p>
            <div class="margin"></div>
            <input type="email" id="email" class="example" name="user_mail" value="<?php if (!empty($result['user_mail'])) echo(htmlspecialchars($result['user_mail'], ENT_QUOTES, 'UTF-8'));?>" required>
            <?php if (!empty($error["user_mail"]) && $error['user_mail'] === 'blank'): ?>
                <p class="error">＊メールアドレスを入力してください</p>
            <?php elseif (!empty($error["user_mail"]) && $error['user_mail'] === 'duplicate'): ?>
                <p class="error">＊このメールアドレスはすでに登録済みです</p>
            <?php endif ?>
            <p>パスワード</p>
            <div class="margin"></div>
            <input type="password" id="pass" class="example" name="user_pass" required>
            <?php if (!empty($error["user_pass"]) && $error['user_pass'] === 'blank'): ?>
                <p class="error">＊パスワードを入力してください</p>
            <?php endif ?>
            <div class="hoge_button">
                <button type="submit" value="遷移">変更完了</button>
            </div>
        </div>
    </form>
</body>
</html>
