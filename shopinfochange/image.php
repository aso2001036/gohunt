<?php

$pdo = new PDO(
    'mysql:host=mysql207.phy.lolipop.lan;
           dbname=LAA1290570-gohunt;charaset=utf8',
    'LAA1290570',
    'gohunt');

    $stmt=$pdo->prepare("SELECT * FROM t_shopImage WHERE shop_id=:shop_image_id");
    $stmt->bindValue(':shop_image_id',(int)$_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    
    $image = $stmt->fetch();

header('Content-type: ' . $image['img_type']);
echo $image['img'];
exit();
?>