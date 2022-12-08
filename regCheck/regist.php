<?php
    session_start();
    // セッション情報の保存

  //店テーブルの主キーの作成
  require("../conect.php");
  $count = $pdo->query('SELECT * FROM m_shop');
$cnt = $count -> rowCount();
$cnt = $cnt + 1;

    //店テーブルのid、名前、ふりがな、登録者idの登録
   require("../conect.php");
    $mei = $pdo->prepare("INSERT INTO `m_shop` (`shop_id`,`shop_name`,`shop_name_rubi`,`user_id`) VALUES (:cnt,:name, :rubi, :user)");
    $mei -> bindValue(':cnt',$cnt,PDO::PARAM_INT);
    $mei -> bindValue(':name',$_POST['shopName']);
    $mei -> bindValue(':rubi',$_POST['shopNameKana']);
    $mei -> bindValue(':user',$_SESSION['user_id'],PDO::PARAM_INT);
    $mei -> execute();

//お店についているタグの登録
$max = count($_POST['tagId']);
require("../conect.php");
for($i=0; $i<$max; $i++){ 
    $tagsid = $_POST['tagId'][$i];
    $tags = $pdo->prepare("INSERT INTO `m_tag_id` (`shop_id`, `tag_id`) VALUES (:cnt, :tag)");
$tags -> bindValue(':cnt',$cnt,PDO::PARAM_INT);
$tags -> bindValue(':tag',$tagsid);
$tags -> execute();
}

    //画像保存
    $img_data = file_get_contents($_FILES['shopImg']['tmp_name']);
    $img_name = $_FILES['shopImg']['name'];
    require("../conect.php");
    $img = $pdo->prepare("INSERT INTO `t_shopImage` (`shop_id`,`shop_image`,`img`,`user_id`) VALUE (:cnt,:imgname,:img,:user)");
    $img -> bindValue(':cnt',$cnt,PDO::PARAM_INT);
    $img -> bindValue(':imgname',$img_name);
    $img -> bindValue(':img',$img_data);
    $img -> bindValue(':user',$_SESSION['user_id'],PDO::PARAM_INT);
    $img -> execute();
    

    //店舗説明登録
    require("../conect.php");
    $exp = $pdo->prepare("INSERT INTO `t_shopExplanation` (`shop_id`,`shop_explanation`,`user_id`) VALUE (:cnt,:exp,:user)");
    $exp -> bindValue(':cnt',$cnt,PDO::PARAM_INT);
    $exp -> bindValue(':exp',$_POST['shopComment']);
    $exp -> bindValue(':user',$_SESSION['user_id'],PDO::PARAM_INT);
    $exp -> execute();

    //住所登録
    require("../conect.php");
    $adr = $pdo->prepare("INSERT INTO `m_shopAddress` (`shop_id`,`shop_address`) VALUE (:cnt,:addres)");
    $adr -> bindValue(':cnt',$cnt,PDO::PARAM_INT);
    $adr -> bindValue(':addres',$_POST['shopJusyo']);
    $adr -> execute();

//評価
require("../conect.php");
$sql='INSERT INTO m_shopEvaluation(shop_evaluation_id,shop_id,shop_Appearance_evaluation,shop_atmosphere_evaluation,shop_taste_evaluation,reg_date,upd_date)
 VALUES (:shop_evaluation_id,:shop_id,:shop_Appearance_evaluation,:shop_atmosphere_evaluation,:shop_taste_evaluation,:reg_date,:upd_date)';//評価をINSERTするSQL文
$stmt = $pdo -> prepare($sql);

$stmt->bindValue(':shop_evaluation_id','');
$stmt->bindValue(':shop_id',$cnt,PDO::PARAM_INT);
$stmt->bindValue(':shop_Appearance_evaluation',$_POST['appearance']);
$stmt->bindValue(':shop_atmosphere_evaluation',$_POST['atmosphere']);
$stmt->bindValue(':shop_taste_evaluation',$_POST['taste']);
$stmt->bindValue(':reg_date',date('y-m-d H:i:s'));
$stmt->bindValue(':upd_date',date('y-m-d H:i:s'));
$stmt->execute();

    header("location: ../login/login.php");
    ?>