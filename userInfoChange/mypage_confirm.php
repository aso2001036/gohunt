<?php
session_start();
try {
  $pdo = new PDO('mysql:host=mysql207.phy.lolipop.lan;
  dbname=LAA1290570-gohunt;charaset=utf8',
  'LAA1290570',
  'gohunt');
    // パスワードを暗号化
    $_pass =':user_pass';
    $hash = password_hash($_pass, PASSWORD_BCRYPT);
      $statement = $pdo->prepare('UPDATE m_user SET user_name=:user_name, user_mail=:user_mail, user_pass=:user_pass WHERE user_id=:user_id');
  $statement->execute(array('user_name'=> $_POST['user_name'],':user_mail'=> $_POST['user_mail'],':user_pass'=> password_hash($_POST['user_pass'], PASSWORD_BCRYPT) ,':user_id'=> $_POST['user_id']));
}catch (PDOException $e) {
  echo "データベース接続エラー：".$e->getMessage();
}
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      header("location: ../userInfo/mypage.php");
       exit();
}
?>
