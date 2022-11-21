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
  $sql = $pdo->prepare('select * from m_shop m INNER JOIN t_shopImage_ID t ON (m.shop_name LIKE "%'.$keyword.'%" AND m.shop_id = t.shop_id)
                        LEFT OUTER JOIN t_shopImage i ON t.shop_image_ID = i.shop_image_ID
                        LEFT OUTER JOIN m_shopAddres a ON m.shop_id = a.shop_id');
  $sql->execute();
  $result = $sql->fetchALL(PDO::FETCH_ASSOC);
  } else{
    $sql = $pdo->prepare('select * from m_shop m LEFT OUTER JOIN t_shopImage_ID t ON m.shop_id = t.shop_id
                          LEFT OUTER JOIN t_shopImage i ON t.shop_image_ID = i.shop_image_ID
                          LEFT OUTER JOIN m_shopAddres a ON m.shop_id = a.shop_id');
    $sql->execute();
    $result = $sql->fetchALL(PDO::FETCH_ASSOC);
  }
}
$pdo= null;
?>
<!--HTML部分-->
<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org">
<head>
  <meta charset = "utf-8">
  <link rel = "stylesheet" href = "./css/style.css">
  <link rel = "stylesheet" href = "./css/searchresult.css">
  <script src="script/searchresult.js"></script>
</head>
<body>
<div class="background">
<h2>検索結果</h2><!--検索結果表示-->
<!--store_listをfor文で出力(最大4件)、画像はurl内に-->
<?php
    $count = count($result);
    if ($count === 0){
        echo '<div class="not-find">該当する店舗がありません。</div>';
    } else {
        echo '<div class="search-result">'.$keyword.'の検索結果</div>';
        echo '<div class="item-container">';
        for ($i=0; $i < $count; $i+=4){
            echo '<div class="store_list_area">';
            for ($j=0; $j < 4; $j++){
                echo '<div class="store_list" style="background-image: url(./img/'.$result[$j+$i]['shop_image'].')">';
                echo '<a href="shopinfo.php?id='.$result[$j+$i]['shop_name'].'" class="store_list_title">';
                echo '<div class="store_list_text_area">';
                echo '<span class="store_list_text">'.$result[$j+$i]['shop_address'].'</span>';
                echo '<span class="store_list_text">'.$result[$j+$i]['upd_date'].'</span>';
                echo '<div class="store_list_rate_area">';
                echo '<span class="star">★</span>';
                echo '<span class="value">5.0</span>';
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
  <div class="pagination">
      <ul class="paging"><!--ページネーションのエリア-->
        <li><a href=""><</a></li><!--a内にページ移動のアドレスを-->
        <li><a href="">1</a></li>
        <li><a href="">2</a></li>
        <li><a href="">3</a></li>
        <li><a href="">4</a></li>
        <li><a href="">5</a></li>
        <li><a href="">></a></li>
      </ul>
    </div>
</div>
</body>
</html>
