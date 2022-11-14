<?php
require("./conect.php");
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
        $member = $pdo->prepare('SELECT COUNT(*) as cnt FROM m_user WHERE user_mail=?');
        $member->execute(array(
            $_POST['user_mail']
        ));
        $record = $member->fetch();
        if ($record['cnt'] > 0) {
            $error['user_mail'] = 'duplicate';
        }
            
    if (!isset($error)) {
        $_SESSION['join'] = $_POST;   // フォームの内容をセッションで保存
        exit();
    }
 }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
    <link rel="stylesheet" href="css/mypage.css">
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
        <form action="" method="post">
            <div class="box">
                <p>ユーザーID</p>
                <h3><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($_SESSION['join']['user_id'], ENT_QUOTES); ?></span></h3>
                <hr width="300px">
                <div class="margin">
                    <p>ユーザー名</p>
                    <h3><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($_SESSION['join']['user_name'], ENT_QUOTES); ?></span></h3>
                </div>
                <hr width="300px">
                <div class="margin">
                    <p>メールアドレス</p>
                    <h3><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($_SESSION['join']['user_mail'], ENT_QUOTES); ?></span></h3>
                </div>
                <hr width="300px">
                <div class="hoge_button">
                <button type="button" onclick="location.href='../userInfoChange/mypage_edit.html'" value="遷移">情報変更</button>
                </div>
            </div>
        </form>
    </body>
</html>