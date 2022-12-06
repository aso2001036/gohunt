<?php session_start() ?>
<?php

$pdo = new PDO(
    'mysql:host=mysql207.phy.lolipop.lan;
    dbname=LAA1290570-gohunt;charaset=utf8',
    'LAA1290570',
    'gohunt');

//前ページからshop_idを受け取る
//仮$shop_id=$_POST[''];
$shop_id=1;

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
$stmt=$pdo->prepare("SELECT * FROM t_shopImage WHERE shop_image_ID=:shop_image_id");
$stmt->bindValue(':shop_image_id',$shop_image_id);
$stmt->execute();

foreach ($stmt as $row){
    $shop_image=base64_encode($row['shop_image']);
}


//店住所を取得
$stmt=$pdo->prepare("SELECT * FROM m_shopAddress WHERE shop_address_id=:shop_address_id");
$stmt->bindValue(':shop_address_id',$shop_address_id);
$stmt->execute();

foreach ($stmt as $row){
    $shop_latitude=$row['shop_latitude'];
    $shop_longitude=$row['shop_longitude'];
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

$pdo=null;//DBを閉じる



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gohunt - Detail</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="./css/shopInfo.css">
</head>
<body>
<div class="background">
    <a class="logo">logo</a><br>
     <div class="detail_image" style="background-image: url(./img/sample.png)">
    <!-- <img src="data:<?php echo $row['ext'] ?>;base64,<?php echo $shop_image; ?>">-->
        <a href="#" onclick="history.back(-1);return false;" class="back"><<</a><br>
        <input type="text" value=<?php echo $shop_name; ?> name="" class="store_detail_title" readonly>
    </div>
    <div class="sub_background">
        <div class="detail_content">
            <input type="hidden" value="" name="">
            <a class="store_detail_text">投稿日:</a><a class="store_detail_date"><?php echo $reg_date ?></a><br>
            <a class="store_detail_text">最終更新日:</a><a class="store_detail_date"><?php echo $reg_date ?></a><br>
            <a class="store_detail_list">住所</a><br>
            <a class="store_list_text"><?php echo $shop_address ?> </a><br>
            <!-- MAP検索-->
            <div class="map_area">
                <a class="map">地図を開く</a>
                <div class="accordion-box column">
                    <a class="accordion"></a>
                    <div class="box">
                        <form>
                            <input type="text" placeholder="地図"><br>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 評価-->
            <?php
            $shop_id = 1;//仮店舗＿実装時は変えて下さい
            $Appearance_AVG = $atmosphere_AVG = $taste_AVG = '';
            //このページを投稿詳細ページの評価部分に入れ
            $pdo = new PDO(
                'mysql:host=mysql207.phy.lolipop.lan;
                       dbname=LAA1290570-gohunt;charaset=utf8',
                'LAA1290570',
                'gohunt');
            /*$pdo = new PDO(
             'mysql:host=mysql154.phy.lolipop.lan;
             dbname=LAA1290579-sd2a;charaset=utf8',
             'LAA1290579',
             'IZUken0626');*/
            $sql=$pdo->prepare('SELECT AVG(shop_Appearance_evaluation) as AP_AVG,AVG(shop_atmosphere_evaluation) as AT_AVG,AVG(shop_taste_evaluation)as TE_AVG FROM m_shopEvaluation WHERE shop_id=?');
            $sql->execute([$shop_id]);
            foreach ($sql as $row){
                $Appearance_AVG = $row['AP_AVG'];
                $atmosphere_AVG = $row['AT_AVG'];
                $taste_AVG = $row['TE_AVG'];
            }
            $average = ($Appearance_AVG + $atmosphere_AVG + $taste_AVG) / 3;
            $average = round($average,1);
            echo '<form action="evaluation-insert.php?id=',$shop_id,'" method="post" name="insert">';
            echo'<a class="store_detail_list">評価</a><a class="average_star">★</a><a class="average" >',number_format($average, 1),'</a><br>';//第二引数を四捨五入
            ?>
            <a class="evaluation_text">入りやすさ</a><br>
            <div class="evaluation">
                <input id="easy_enter5" type="radio" name="appearance" value="5" required>
                <label for="easy_enter5">★</label>
                <input id="easy_enter4" type="radio" name="appearance" value="4" required>
                <label for="easy_enter4">★</label>
                <input id="easy_enter3" type="radio" name="appearance" value="3" required>
                <label for="easy_enter3">★</label>
                <input id="easy_enter2" type="radio" name="appearance" value="2" required>
                <label for="easy_enter2">★</label>
                <input id="easy_enter1" type="radio" name="appearance" value="1" required>
                <label for="easy_enter1">★</label>
            </div>
            <a class="evaluation_text">味</a><br>
            <div class="evaluation">
                <input id="taste5" type="radio" name="taste" value="5" required>
                <label for="taste5">★</label>
                <input id="taste4" type="radio" name="taste" value="4" required>
                <label for="taste4">★</label>
                <input id="taste3" type="radio" name="taste" value="3" required>
                <label for="taste3">★</label>
                <input id="taste2" type="radio" name="taste" value="2" required>
                <label for="taste2">★</label>
                <input id="taste1" type="radio" name="taste" value="1" required>
                <label for="taste1">★</label>
            </div>
            <a class="evaluation_text">雰囲気</a><br>
            <div class="evaluation">
                <input id="ambience5" type="radio" name="atmosphere" value="5" required>
                <label for="ambience5">★</label>
                <input id="ambience4" type="radio" name="atmosphere" value="4" required>
                <label for="ambience4">★</label>
                <input id="ambience3" type="radio" name="atmosphere" value="3" required>
                <label for="ambience3">★</label>
                <input id="ambience2" type="radio" name="atmosphere" value="2" required>
                <label for="ambience2">★</label>
                <input id="ambience1" type="radio" name="atmosphere" value="1" required>
                <label for="ambience1">★</label>
            </div>
            <input type="submit" class="evaluation_button" value="お店を評価する" onClick="return check();"><br>
            </form>
            <script type="text/javascript">
                function check(){
                    if (insert.appearance.value == "") {
                        alert("評価項目を全て入力して下さい");    //エラーメッセージを出力
                        return false;    //送信ボタン本来の動作をキャンセルします
                    }else if(insert.atmosphere.value == "") {
                        alert("評価項目を全て入力して下さい");    //エラーメッセージを出力
                        return false;    //送信ボタン本来の動作をキャンセルします
                    }else if(insert.taste.value == "") {
                        alert("評価項目を全て入力して下さい");    //エラーメッセージを出力
                        return false;    //送信ボタン本来の動作をキャンセルします
                    }else{
                        return true;    //送信ボタン本来の動作を実行します
                    }
                }
            </script>

            <!-- タグ-->
            <a class="store_detail_list">タグ</a><br>
            <div class="tag">
                <?php for($i=0;$i<$cnt;$i++){?>
                <button type="submit" class="tag_button" formaction="(URL 一覧)" form="(フォームID)"><?php  echo $tag_name[$i]; ?></button>
                <?php } ?>
            </div>
            <!-- コメント-->
            <a class="store_detail_list">コメント</a><br>
            <textarea class="text_area"><?php echo $shop_explanation; ?></textarea><br>
            <!-- 編集ボタン-->
            <div class="btn">
                <button type="submit"  class="edit_button" formaction="(URL 編集ページ)" form="(フォームID)">編集する</button>
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