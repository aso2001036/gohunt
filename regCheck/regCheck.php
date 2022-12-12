<?php session_start() ?>
<?php

$pdo = new PDO(
    'mysql:host=mysql207.phy.lolipop.lan;
    dbname=LAA1290570-gohunt;charaset=utf8',
    'LAA1290570',
    'gohunt');

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
$app=$_POST['app'];
$atmo=$_POST['atmo'];
$taste=$_POST['taste'];
//タグ
$tag_id=$_POST['tag_id'];
//コメント
$shop_explanation=$_POST['shop_explanation'];

$cnt=count($tag_id);

for($i=0;$i<$cnt;$i++) {
    $stmt=$pdo->prepare("SELECT tag_name FROM m_tag WHERE tag_id=:tag_id");
    $stmt->bindValue(':tag_id',$tag_id[$i]);
    $stmt->execute();

    foreach ($stmt as $row){
        $tag_name[$i]=$row['tag_name'];
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="page">
<!-- 背景-->
    <div class="black"></div>
    <div class="backimg"></div>
    <!-- タイトル-->
    <div class="title">
        <div class="titleimg"></div>
    </div>

    <div class="sub_background">
        <div class="frame">
            <!-- 店舗名,画像-->
            <a class="tenpomei">店舗名</a>
            <div class="name">
                <a class="namekana"><?php echo $shop_name_rubi ?></a>
                <a class="name"><?php echo $shop_name ?></a>
            </div>
            <a class="img">店舗画像</a>
            <img class="img" src="./img/Frame%2089.png">
            <!-- <img src="data:<?php echo $row['ext'] ?>;base64,<?php echo $shop_image; ?>">-->
            <!-- 住所-->
            <a class="jyuusyo">住所</a>
            <a class="add"><?php echo $shop_address ?></a>
            <!--　評価-->
            <form action="reg_insert.php" method="post" id="reg">
                <div class="evaluation_group">
                <div class="star">
                    <a class="list">評価</a><br>
                    <a class="evaluation_text_1">入りやすさ</a><br>
                    <div class="evaluation">
                        <?php
                        echo '<p><span class="star5_rating" data-rate="',$_POST['app'],'"></span></p>';//data-rateの中を変数に
                        echo '<input type="hidden" name="appearance" value="',$_POST['app'],'">';//valueを変数に
                        ?>
                    </div>
                    <a class="evaluation_text_2">味</a><br>
                    <div class="evaluation">
                        <?php
                        echo '<p><span class="star5_rating" data-rate="',$_POST['taste'],'"></span></p>';//data-rateの中を変数に
                        echo '<input type="hidden" name="taste" value="',$_POST['taste'],'">';//valueを変数に
                        ?>
                    </div>
                    <a class="evaluation_text_3">雰囲気</a><br>
                    <div class="evaluation">
                        <?php
                        echo '<p><span class="star5_rating" data-rate="',$_POST['atmo'],'"></span></p>';//data-rateの中を変数に
                        echo '<input type="hidden" name="atmosphere" value="',$_POST['atmo'],'">';//valueを変数に
                        ?>
                    </div>
                </div>
                </div>
                <input type="hidden" name="shop_name" value="<?php  echo $shop_name; ?>">
                <input type="hidden" name="shop_name_rubi" value="<?php  echo $shop_name_rubi; ?>">
                <input type="hidden" name="shop_image" value="<?php  echo $shop_image; ?>">
                <input type="hidden" name="lat" value="<?php  echo $lat; ?>">
                <input type="hidden" name="lon" value="<?php  echo $lon; ?>">
                <input type="hidden" name="shop_address" value="<?php  echo $shop_address; ?>">
                <?php for($i=0;$i<$cnt;$i++){?>
                <input type="hidden" name="tag_id[]" value="<?php  echo $tag_id[$i]; ?>">
                <?php } ?>
                <input type="hidden" name="shop_explanation" value="<?php  echo $shop_explanation; ?>">


            </form>
            <!-- タグ-->
                <a class="tag">タグ</a>
            <div class="tag">
                <?php for($i=0;$i<$cnt;$i++){?>
                    <button type="submit" class="tag_button" formaction="(URL 一覧)" form="(フォームID)"><?php  echo $tag_name[$i]; ?></button>
                <?php } ?>
            </div>
            <!-- コメント-->
            <a class="com">コメント</a>
            <textarea class="text"><?php echo $shop_explanation?></textarea><br>
            <!-- 確認ボタン-->
            <div class="btn">
                <button type="submit" class="confirm" form="reg">投稿する</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>