<?php 
session_start();
?>
<?php

$shop_id=$_GET['id'];
if(!empty($_POST['tagId'])){
$max = count($_POST['tagId']);

for($i=0; $i<$max; $i++){ 
    require("../conect.php");
    $mei = $pdo->prepare("INSERT INTO `m_tag_id` (`shop_id`,`tag_id`) VALUES (:cnt, :tag)");
    $mei -> bindValue(':cnt',$shop_id);
    $mei -> bindValue(':tag',$_POST['tagId'][$i]);
    $mei -> execute();
}
}

require("../conect.php");
$exp = $pdo->prepare("UPDATE t_shopExplanation SET shop_explanation = :exp,user_id = :user WHERE shop_id = :cnt");
$exp -> bindValue(':exp',$_POST['reComment']);
$exp -> bindValue(':user',$_SESSION['user_id'],PDO::PARAM_INT);
$exp -> bindValue(':cnt',$shop_id);
$exp -> execute();

header("location: ../top/top.php");

?>
