<?php
session_start();
require("./conect.php");
//DBの記述を原文から変更してます、不都合なら変えてください
$pdo = new PDO(
    'mysql:host=mysql207.phy.lolipop.lan;
    dbname=LAA1290570-gohunt;charaset=utf8',
    'LAA1290570',
    'gohunt');

$word = '';
$resultcount = 0;
//topでnama検索ボタンを押した時
if (isset($_GET['name_search'])) {
    echo 11111;//分岐到達の目印、消去OK
    if (isset($_GET['keyword'])) {

        //検索用処理
        $keyword = $_GET['keyword'];
        if ($keyword != null) {
            $sql = $pdo->prepare('select * from m_shop m INNER JOIN t_shopImage_ID t ON (m.shop_name LIKE "%'. $keyword .' %" AND m.shop_id = t.shop_id)
                        LEFT OUTER JOIN t_shopImage i ON t.shop_image_ID = i.shop_image_ID
                        LEFT OUTER JOIN m_shopAddres a ON m.shop_id = a.shop_id');
            $sql->execute();
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
        } else {
            $sql = $pdo->prepare('select * from m_shop m LEFT OUTER JOIN t_shopImage_ID t ON m.shop_id = t.shop_id
                          LEFT OUTER JOIN t_shopImage i ON t.shop_image_ID = i.shop_image_ID
                          LEFT OUTER JOIN m_shopAddres a ON m.shop_id = a.shop_id');
            $sql->execute();
            $result = $sql->fetchALL(PDO::FETCH_ASSOC);
        }
    }
    //topでtag検索ボタンを押した時
}else if(isset($_GET['tag_search'])) {
    echo 22222;//分岐到達の目印、消去OK
    //tagテーブルからタグの名前を取得
    $stmt=$pdo->prepare("SELECT tag_name FROM m_tag WHERE tag_id=:tag_id");
    $stmt->bindValue(':tag_id', $_GET['tag_id']);
    $stmt->execute();

    foreach ($stmt as $row){
        $tag_name=$row['tag_name'];
    }

    //指定されたタグが登録されている店IDの抽出
    $stmt = $pdo->prepare('select shop_id from m_tag_id WHERE tag_id=:tag_id');
    $stmt->bindValue(':tag_id', $_GET['tag_id']);
    $stmt->execute();
    foreach ($stmt as $row) {
        $shop_id = $row['shop_id'];
    }
//店IDを用いて検索する
    if (isset($shop_id)) {
        $stmt = $pdo->prepare('select * from m_shop m INNER JOIN t_shopImage_ID t ON (m.shop_id = :shop_id AND m.shop_id = t.shop_id)
                        LEFT OUTER JOIN t_shopImage i ON t.shop_image_ID = i.shop_image_ID
                        LEFT OUTER JOIN m_shopAddres a ON m.shop_id = a.shop_id');
        $stmt->bindValue(':shop_id', $shop_id);
        $stmt->execute();
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
    }else{
        $result=[];
    }
}

?>
<!--HTML部分-->
<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">
<head>
  <meta charset = "utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link rel = "stylesheet" href = "./css/style.css">
  <link rel = "stylesheet" href = "./css/searchresult.css">
  <script src="script/searchresult.js"></script>
</head>
<body>
<div class="background">
  <div class="title_banner">
    <img src="img/title_bar.png" class="title_bar">
  </div>
<?php
    $count = count($result);
    if ($count === 0){
        echo '<div class="not-find">該当する店舗がありません。</div>';
        echo '<div class="emptiness"></div>';
        //name検索の結果表示
    } else if(isset($_GET['name_search'])){
      if($keyword==null){
        echo '<div class="search-result">検索結果は'.$count.'件です。</div>';
      } else if($keyword!=null){
        echo '<div class="search-result">'.$keyword.'の検索結果は'.$count.'件です。</div>';
      }
        echo '<div class="container">';
        for ($i=0; $i < $count; $i+=4){
            echo '<div class="store_list_area">';
            for ($j=0; $j < 4; $j++){
                $sql=$pdo->prepare('SELECT AVG(shop_Appearance_evaluation) as AP_AVG,AVG(shop_atmosphere_evaluation) as AT_AVG,AVG(shop_taste_evaluation)as TE_AVG FROM m_shopEvaluation WHERE shop_id='.$result[$j+$i]['shop_id'].'');
                $sql->execute();
                foreach ($sql as $row){
                  $Appearance_AVG = $row['AP_AVG'];
                  $atmosphere_AVG = $row['AT_AVG'];
                  $taste_AVG = $row['TE_AVG'];
                }
                $average = ($Appearance_AVG + $atmosphere_AVG + $taste_AVG) / 3.0;
                $average = round($average,1);
                echo '<div class="store_list">';
                echo '<a class="index" href="shopinfo.php?id='.$result[$j+$i]['shop_id'].'">';
                echo '<img src="./img/'.$result[$j+$i]['shop_image'].'" class="store_image">';
                echo '<span class="store_list_title">'.$result[$j+$i]['shop_name'].'</span>';
                echo '<div class="store_list_text_area">';
                echo '<img src="img/pin.png">';
                echo '<span class="store_list_text">'.$result[$j+$i]['shop_address'].'</span><br>';
                echo '<span class="store_list_text">最終更新日:</span>';
                echo '<span class="store_list_text">'.$result[$j+$i]['upd_date'].'</span>';
                echo '<div class="store_list_rate_area">';
                echo '<span class="star">★</span>';
                echo '<span class="value">'.number_format($average, 1).'</span>';
                echo '</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                if($j+$i == $count-1){
                    break;
                }
            }
            echo '</div>';
        }
        echo '</div>';
        //tag検索の結果表示
    }else if(isset($_GET['tag_search'])){
            echo '<div class="search-result">'.$tag_name.'の検索結果は'.$count.'件です。</div>';
        echo '<div class="container">';
        for ($i=0; $i < $count; $i+=4){
            echo '<div class="store_list_area">';
            for ($j=0; $j < 4; $j++){
                $sql=$pdo->prepare('SELECT AVG(shop_Appearance_evaluation) as AP_AVG,AVG(shop_atmosphere_evaluation) as AT_AVG,AVG(shop_taste_evaluation)as TE_AVG FROM m_shopEvaluation WHERE shop_id='.$result[$j+$i]['shop_id'].'');
                $sql->execute();
                foreach ($sql as $row){
                    $Appearance_AVG = $row['AP_AVG'];
                    $atmosphere_AVG = $row['AT_AVG'];
                    $taste_AVG = $row['TE_AVG'];
                }
                $average = ($Appearance_AVG + $atmosphere_AVG + $taste_AVG) / 3.0;
                $average = round($average,1);
                echo '<div class="store_list">';
                echo '<a class="index" href="shopinfo.php?id='.$result[$j+$i]['shop_id'].'">';
                echo '<img src="./img/'.$result[$j+$i]['shop_image'].'" class="store_image">';
                echo '<span class="store_list_title">'.$result[$j+$i]['shop_name'].'</span>';
                echo '<div class="store_list_text_area">';
                echo '<img src="img/pin.png">';
                echo '<span class="store_list_text">'.$result[$j+$i]['shop_address'].'</span><br>';
                echo '<span class="store_list_text">最終更新日:</span>';
                echo '<span class="store_list_text">'.$result[$j+$i]['upd_date'].'</span>';
                echo '<div class="store_list_rate_area">';
                echo '<span class="star">★</span>';
                echo '<span class="value">'.number_format($average, 1).'</span>';
                echo '</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                if($j+$i == $count-1){
                    break;
                }
            }
            echo '</div>';
        }
        echo '</div>';
    }
    $pdo= null;
    ?>
</div>
<div id="re-top">
	<a href="#" class="re-topB">TOP</a>
</div>
</body>
</html>
