<?php
try {
    $db = new PDO('mysql:host=mysql207.phy.lolipop.lan;
dbname=LAA1290637-aso2001028;charaset=utf8',
        'LAA1290637',
        'syun0612');
}   catch (PDOException $e) {
    echo "データベース接続エラー :".$e->getMessage();
}
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
    <link rel="stylesheet" href="css/mypage.css">
    <meta name="viewport" content="width=device-width,initial-scale-1">
<?php require("../header/menu.php"); ?>
    <div style="background-color:#505050;">
        <div class="mypage">
           <img src="img/cooltext421486115691405 1.png">
           </div>
        </div>
        <form action="" method="post">
            <div class="box">
                <p>ユーザーID</p>
                <?php echo htmlspecialchars($_POST['user_id']);?>
                <hr width="300px">
                <div class="margin">
                    <p>ユーザー名</p>
                    <?php echo htmlspecialchars($_SESSION['user_name']);?>
                </div>
                <hr width="300px">
                <div class="margin">
                    <p>メールアドレス</p>
                    <?php echo htmlspecialchars($_SESSION['user_mail']);?>
                </div>
                <hr width="300px">
                <div class="hoge_button">
                <button type="button" onclick="location.href='../userInfoChange/mypage_edit.php'" value="遷移">情報変更</button>
                </div>
            </div>
        </form>
    </body>
</html>
