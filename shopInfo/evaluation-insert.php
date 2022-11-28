<?php
//評価の処理
//エラーメッセージ(評価がnullの場合)
$alert = "<script type='text/javascript'>alert('入力項目が不十分です。');</script>";

//評価項目が抜けてた場合エラーメッセージを表示し前ページに戻る
if($_POST['appearance'] == null){
    echo $alert;
}elseif ($_POST['atmosphere'] == null){
    echo $alert;
}elseif ($_POST['taste'] == null){
    echo $alert;
}
$pdo = new PDO(
    'mysql:host=mysql207.phy.lolipop.lan;
    dbname=LAA1290570-gohunt;charaset=utf8',
    'LAA1290570',
    'gohunt');
//DB接続(実装時は上記のデータベースに変更してください)
/*$pdo = new PDO(
    'mysql:host=mysql154.phy.lolipop.lan;
    dbname=LAA1290579-sd2a;charaset=utf8',
    'LAA1290579',
    'IZUken0626');*/

//INSERT処理
$sql='INSERT INTO m_shopEvaluation(shop_evaluation_id,shop_id,shop_Appearance_evaluation,shop_atmosphere_evaluation,shop_taste_evaluation,reg_date,upd_date)
 VALUES (:shop_evaluation_id,:shop_id,:shop_Appearance_evaluation,:shop_atmosphere_evaluation,:shop_taste_evaluation,:reg_date,:upd_date)';//評価をINSERTするSQL文
$stmt = $pdo -> prepare($sql);

$stmt->bindValue(':shop_evaluation_id','');
$stmt->bindValue(':shop_id',$_GET['id']);
$stmt->bindValue(':shop_Appearance_evaluation',$_POST['appearance']);
$stmt->bindValue(':shop_atmosphere_evaluation',$_POST['atmosphere']);
$stmt->bindValue(':shop_taste_evaluation',$_POST['taste']);
$stmt->bindValue(':reg_date',date('y-m-d H:i:s'));
$stmt->bindValue(':upd_date',date('y-m-d H:i:s'));
$stmt->execute();
$pdo = null;//DB接続解除

?>
<?php
http_response_code(301);
header("location:https://aso2001031.perma.jp/front/evaluation.php");
exit();
?>

