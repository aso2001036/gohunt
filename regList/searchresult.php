<?php
session_start();
require("../conect.php");
$word = '';
$resultcount = 0;
if (isset($_GET['keyword'])){
  //検索用処理
  $keyword = $_GET['keyword'];
  if ($keyword!=null){
  $sql = $pdo->prepare('select * from m_shop m INNER JOIN t_shopImage_id t ON (m.shop_name LIKE "%'.$keyword.'%" AND m.shop_id = t.shop_id)
  LEFT OUTER JOIN t_shopImage i ON t.shop_image_id = i.shop_image_id
  LEFT OUTER JOIN m_shopAddress a ON m.shop_id = a.shop_id');
  $sql->execute();
  $result = $sql->fetchALL(PDO::FETCH_ASSOC);
  } else{
    $sql = $pdo->prepare('select * from m_shop');
    $sql->execute();
    $result = $sql->fetchALL(PDO::FETCH_ASSOC);
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
  <link rel = "stylesheet" href = "./css/searchresults.css">
  <script src="script/searchresult.js"></script>
  <?php require("../header/menu.php"); ?>
<div class="background">
<?php
    $count = count($result);
    if ($count === 0){
        echo '<div class="not-find">該当する店舗がありません。</div>';
        echo '<div class="emptiness"></div>';    
    } else {
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
                require("../conect.php");
                $sql=$pdo->prepare('SELECT * from m_shopAddress WHERE shop_id = ?');
                $sql->bindValue(1,$result[$j+$i]['shop_id']);
                $sql->execute();
                $address = $sql->fetch();

                $average = ($Appearance_AVG + $atmosphere_AVG + $taste_AVG) / 3.0;
                $average = round($average,1);
                echo '<div class="store_list">';
                echo '<a class="index" href="../haruta/shopinfo.php?id='.$result[$j+$i]['shop_id'].'">';
                echo '<img src="image.php?id=',$result[$j+$i]['shop_id'],'" class="img">';
                
                echo '<div class="store_list_text_area">';
                echo '<span class="store_list_text">'.$address['shop_address'].'</span><br>';
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
	<a href="../top/top.php" class="re-topB">TOP</a>
</div>
</body>
</html>
