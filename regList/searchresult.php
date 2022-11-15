<?php
session_start();
require("./conect.php");
$pdo = getDb();
$word = '';
$resultcount = 0;
if (isset($_GET['keyword'])){
  //検索用処理
  $keyword = $_GET['keyword'];
  if ($keyword!=null){
  $sql = $pdo->prepare('select m.shop_id , m.shop_name, m.shop_name_rubi, from m_shop m where shop_name LIKE "%'.$keyword.'%"');
  $sql->execute();
  $result = $sql->fetchALL(PDO::FETCH_ASSOC);
  $sp = "OK";
  } else{
    $sql = $pdo->prepare('select m.shop_id , m.shop_name, m.shop_name_rubi, from m_shop m ');
    $sql->execute();
    $result = $sql->fetchALL(PDO::FETCH_ASSOC);
    $sp = "NG";
  }
}
$pdo= null;
?>
<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">
<head>
  <meta charset = "utf-8">
  <link rel = "stylesheet" href = "./css/searchresults.css">
  <script src="script/searchresult.js"></script>
</head>
<body>
<h2>検索結果</h2>
<div class="a">
<div class = "Room">
<?php
    echo '<div class="search-result">'.$sp.'の検索結果</div>';
    $count = count($result);
    if ($count === 0){
        echo '<div class="search-result">'.$keyword.'の検索結果</div>';
        echo '<div class="not-find">該当する店舗がありません。</div>';
    } else {
        echo '<div class="item-container">';
        for ($i=0; $i < $count; $i+=4){
            echo '<div class="item-row">';
            for ($j=0; $j < 4; $j++){
                echo '<div class="merchandises">';
                echo '<a href="item-detail.php?id='.$result[$j+$i]['shop_id'].'" class="item-link">';
                echo '<img src="./img/item-img/'.$result[$j+$i]['item_img_url'].'" class="item-img">';
                echo '<div class="info">';
                echo '<span>'.$result[$j+$i]['shop_name'].'</span><br>';
                echo '<div class="shop_name_rubi">';
                echo '<span>'.$result[$j+$i]['shop_name_rubi'].'</span>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
                if($j+$i == $count-1){
                    break;
                }
            }
            echo '</div>';
        }
        echo '</div>';
    }
    ?>
    </div>
  </div>
<!--<div class = "Room02">
  <div class = "deta02">

  </div>
</div>

<div class = "Room03">
  <div class = "deta03">

  </div>
</div>-->
</div>
</body>
</html>
