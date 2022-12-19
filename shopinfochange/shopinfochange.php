<?php session_start() ?>
<?php

$pdo = new PDO(
    'mysql:host=mysql207.phy.lolipop.lan;
    dbname=LAA1290570-gohunt;charaset=utf8',
    'LAA1290570',
    'gohunt');

//前ページからshop_idを受け取る
$shop_id=$_GET['id'];

//shop_idを参照して店説明テーブルから各idを取得する
$stmt=$pdo->prepare("SELECT * FROM t_shopExplanation where shop_id=:shop_id");
$stmt->bindValue(':shop_id',$shop_id);
$stmt->execute();

foreach ($stmt as $row){
    $shop_explanation=$row['shop_explanation'];
    $shop_image_id=$row['shop_image_id'];
    $shop_address_id=$row['shop_address_id'];
//登録されてなければエラー    $up_date=$row['up_date'];
    $reg_date=$row['reg_date'];
}

//店の名前
$stmt=$pdo->prepare("SELECT * FROM m_shop WHERE shop_id=:shop_id");
$stmt->bindValue(':shop_id',$shop_id);
$stmt->execute();

foreach ($stmt as $row){
    $shop_name=$row['shop_name'];
    $shop_name_rubi=$row['shop_name_rubi'];
}

//店画像を取得
/*$stmt=$pdo->prepare("SELECT * FROM t_shopImage WHERE shop_id=:shop_image_id");
$stmt->bindValue(':shop_image_id',$shop_id);
$stmt->execute();

foreach ($stmt as $row){
    $img=$row['img'];
    $img_type=$row['img_type'];
}*/

//店住所を取得
$stmt=$pdo->prepare("SELECT * FROM m_shopAddress WHERE shop_id=:shop_address_id");
$stmt->bindValue(':shop_address_id',$shop_id);
$stmt->execute();

foreach ($stmt as $row){
    $shop_address=$row['shop_address'];
}

//shop_idを参照してtag_idを受け取る
$stmt=$pdo->prepare("SELECT tag_id FROM m_tag_id WHERE shop_id=:shop_id");
$stmt->bindValue(':shop_id',$shop_id);
$stmt->execute();

foreach ($stmt as $row){
    $tag_id[]=$row['tag_id'];
}

//取得したtag_idをカウント、ループ処理でtag_nameの値を取得
$cnt=count($tag_id);

for($i=0;$i<$cnt;$i++) {
$stmt=$pdo->prepare("SELECT tag_name FROM m_tag WHERE tag_id=:tag_id");
$stmt->bindValue(':tag_id',$tag_id[$i]);
$stmt->execute();

    foreach ($stmt as $row){
        $tag_name[$i]=$row['tag_name'];
    }
}

//未追加の取得したtag_idをカウント、ループ処理でtag_nameの値を取得
$cnts=9-$cnt;
$tagsid = array(1,2,3,4,5,6,7,8,9);

$tags_id =  array_values(array_diff($tagsid, $tag_id));


for($i=0;$i<$cnts;$i++) {
$stmt=$pdo->prepare("SELECT tag_name FROM m_tag WHERE tag_id=:tag_id");
$stmt->bindValue(':tag_id',$tags_id[$i]);
$stmt->execute();

    foreach ($stmt as $row){
        $tags_name[$i]=$row['tag_name'];
    }
}


$pdo=null;//DBを閉じる


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gohunt - Detail</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="./css/shopinfochange.css">
    <?php require("../header/menu.php"); ?>
<div class="background">
<img src="image.php?id=<?=$shop_id; ?>"
        <a href="#" onclick="history.back(-1);return false;" class="back"><<</a><br>
        <input type="text" value=<?php echo $shop_name; ?> name="" class="store_detail_title" readonly>
    </div>
    <div class="sub_background">
        <div class="detail_content">
            <input type="hidden" value="" name="">
            <a class="store_detail_list">住所</a><br>
            <a class="store_list_text"><?php echo $shop_address ?> </a><br>
           
        <form action="./reReg.php?id=<?=$shop_id; ?>" method="post">
            <!-- タグ-->
            <p class="store_detail_list">現在つけられているタグ</p><br>
            <div class="tag">
                <?php for($i=0;$i<$cnt;$i++){?>
                <button type="submit" class="tag_button"><?php  echo $tag_name[$i]; ?></button>
                <?php } ?>
            </div>
            <!-- タグの追加-->
            <p>追加するタグ</p><br>
            <div class="tag">
                <?php for($i=0;$i<$cnts;$i++){?>
                    <?php if($i%3==0){?>
                       <?php echo '<input type="checkbox" name="tagId[]" value="',$tags_id[$i],'">',$tags_name[$i]; ?>
                    <?php }else{ ?>
                        <?php echo '<input type="checkbox" name="tagId[]" value="',$tags_id[$i],'">',$tags_name[$i],'<br>'; ?>
                    <?php } ?>
                <?php } ?>
            </div>
            <!-- コメント-->
            <a class="store_detail_list">コメント</a><br>
            <textarea class="text_area" name="reComment"><?php echo $shop_explanation; ?></textarea><br>
            <!-- 編集ボタン-->
                <button type="submit" class="edit_button">編集確定</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="./js/shopInfo.js"></script>
</body>
</html>
