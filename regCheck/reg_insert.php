<?php

$pdo = new PDO('mysql:host=mysql209.phy.lolipop.lan;
          dbname=LAA1290586-karaage;charset=utf8',
    'LAA1290586',
    'sprd1903shun');

//ユーザID
$user_id=1;

//店の名前、ルビ
$shop_name=$_POST['shop_name'];
$shop_name_rubi=$_POST['shop_name_rubi'];
//店舗画像
$shop_image=$_POST['shop_image'];
//店住所,経度、緯度
$shop_address=$_POST['shop_address'];
$lat=$_POST['lat'];
$lon=$_POST['lon'];
//店評価
$app=$_POST['appearance'];
$atmo=$_POST['atmosphere'];
$taste=$_POST['taste'];
//タグ
$tag_id=$_POST['tag_id'];
//コメント
$shop_explanation=$_POST['shop_explanation'];




//店の名前、ルビ
$stmt =$pdo->prepare('INSERT INTO m_shop (shop_name,shop_name_rubi,user_id,reg_date) 
                    VALUES (:sname,:rubi,:userid,CURRENT_DATE())');
$stmt->bindValue(':sname',$shop_name);
$stmt->bindValue(':rubi',$shop_name_rubi);
$stmt->bindValue(':userid',$user_id);
$res=$stmt->execute();

//最後に挿入された店舗ID取得
$shop_id=$pdo->lastInsertId();

//画像ID
$stmt =$pdo->prepare('INSERT INTO t_shopImage (shop_image,user_id,reg_date) 
                    VALUES (:image,:userid,CURRENT_DATE())');
$stmt->bindValue(':image',$shop_image);
$stmt->bindValue(':userid',$user_id);
$res=$stmt->execute();

//最後に挿入された画像ID取得
$shop_image_id=$pdo->lastInsertId();

//t_shopImage_idテーブルへの登録
$stmt =$pdo->prepare('INSERT INTO t_shopImage_id (shop_image_ID,shop_id) 
                    VALUES ('.$shop_image_id.','.$shop_id.')');
$res=$stmt->execute();

//店の住所
$stmt =$pdo->prepare('INSERT INTO m_shopAddress (shop_id,shop_latitude,shop_longitude,shop_address,reg_date) 
                    VALUES ('.$shop_id.',:lat,:lon,:address,CURRENT_DATE())');
$stmt->bindValue(':lat',$lat);
$stmt->bindValue(':lon',$lon);
$stmt->bindValue(':address',$shop_address);
$res=$stmt->execute();

//最後に入力された住所IDの取得
$shop_address_id=$pdo->lastInsertId();

//店の評価
$stmt =$pdo->prepare('INSERT INTO m_shopEvaluation (shop_id,shop_Appearance_evaluation,shop_atmosphere_evaluation,shop_taste_evaluation,reg_date) 
                    VALUES ('.$shop_id.',:app,:atm,:taste,CURRENT_DATE())');
$stmt->bindValue(':app',$app);
$stmt->bindValue(':atm',$atmo);
$stmt->bindValue(':taste',$taste);
$res=$stmt->execute();

//店のタグ
//タグ配列の個数をカウント
$cnt=count($tag_id);

for($i=0;$i<$cnt;$i++) {

    $stmt = $pdo->prepare('INSERT INTO m_tag_id (shop_id,tag_id,reg_date) 
                    VALUES ('. $shop_id . ',' . $tag_id[$i] . ',CURRENT_DATE())');
    $res = $stmt->execute();

}
//店説明、全てのIDを挿入
    $stmt =$pdo->prepare('INSERT INTO t_shopExplanation (shop_id,shop_explanation,shop_image_id,shop_address_id,user_id,reg_date) 
        VALUES ('.$shop_id.',:text,'.$shop_image_id.','.$shop_address_id.','.$user_id.',CURRENT_DATE())');
    $stmt->bindValue(':text',$shop_explanation);
    $res=$stmt->execute();

$pdo = null;
?>