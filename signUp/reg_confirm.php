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
/* 会員登録の手続き以外のアクセスを飛ばす */
if (!isset($_SESSION['join'])) {
    header('Location: signup.php');
    exit();
}

if (!empty($_POST['check'])) {
    // パスワードを暗号化
    $hash = password_hash($_SESSION['join']['user_pass'], PASSWORD_BCRYPT);

    // 入力情報をデータベースに登録
    $statement = $db->prepare("INSERT INTO m_user SET user_name=?, user_mail=?, user_pass=?,sex_flag=?");
    $statement->execute(array(
        $_SESSION['join']['user_name'],
        $_SESSION['join']['user_mail'],
        $hash,
        $_SESSION['join']['sex_flag']
    ));

    unset($_SESSION['join']);   // セッションを破棄
    header('Location: reg_completion.php');   // .phpへ移動
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" href = "./css/reg_confirm.css">
</head>
<body>
<h2>登録内容確認</h2>
// echo htmlspecialchars($_SESSION['join']['sex_flag'], ENT_QUOTES); ?>
<div class = "IPhone">
    <form action = "" method = "POST">
        <input type="hidden" name="check" value="checked">
        <div class = "Form">
            <p>ユーザーネーム</p>
            <h3><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($_SESSION['join']['user_name'], ENT_QUOTES); ?></span></h3>
            <p>メールアドレス</p>
            <h3><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($_SESSION['join']['user_mail'], ENT_QUOTES); ?></span></h3>
            <p>パスワード</p>
            <h3><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($_SESSION['join']['user_pass'], ENT_QUOTES); ?></h3>
            <p>性別</p>
            <?php if($_SESSION['join']['sex_flag']==0){
            echo '<h3><span class="fas fa-angle-double-right"></span> <span class="check-info">男</h3>';
            }else if($_SESSION['join']['sex_flag']==1){
                echo '<h3><span class="fas fa-angle-double-right"></span> <span class="check-info">女</h3>';
            }else {
                echo '<h3><span class="fas fa-angle-double-right"></span> <span class="check-info">その他</h3>';
            } ?>
        </div><br>
        <button type="submit" class = "SignUp">登録</button><br>
    </form>
    <br>
</div>
</body>
</html>
