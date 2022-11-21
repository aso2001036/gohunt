<?php
//評価の処理
$now = new DateTime();

$pdo = new PDO(
    'mysql:host=mysql207.phy.lolipop.lan;
    dbname=LAA1290570-gohunt;charaset=utf8',
    'LAA1290570',
    'gohunt');

$sql='INSERT INTO m_shopEvaluation VALUES (:shop_evaluation_id,?,?,?,?,,)';//評価をINSERTするSQL文
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':shop_evaluation_id','');
$stmt->bindValue(':shop_id',$_GET['id']);
$stmt->bindValue('',$_POST['']);
$stmt->bindValue('',$_POST['']);
$stmt->bindValue('',$_POST['']);
$stmt->bindValue(':reg_date',date('y-m-d H:i:s'));
$stmt->bindValue(':upd_date',date('y-m-d H:i:s'));
?>