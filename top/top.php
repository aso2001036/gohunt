<?php
    session_start();
    // セッション情報の保存

$pdo = new PDO(
    'mysql:host=mysql207.phy.lolipop.lan;
    dbname=LAA1290570-gohunt;charaset=utf8',
    'LAA1290570',
    'gohunt');

$stmt=$pdo->prepare("SELECT * FROM m_tag");
$stmt->execute();

foreach ($stmt as $row){
    $tag_name[]=$row['tag_name'];
    $tag_id[]=$row['tag_id'];
}
$cnt=count($tag_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>GOHUNT-Top</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <link rel="stylesheet" type="text/css" href="./css/top.css">
  <?php require("../header/menu.php"); ?>
</head>
<div class="ttop">
  <div class="title_banner_top">
  <a class="top-title">～お店の検索～</a>
  </div>

  <div class="top-content">
    <!-- 店名検索 -->
    <div class="accordion-space"></div>
    <div class="search">
      <div class="search_navi-name">
        <a class="search-pin">●</a>
        <a class="search-img">
        <img src="./img/store_name.png" >
        </a>
      </div>
      <div class="search_navi2">
      <a class="search-name">店名</a><a class="search-text">で探す</a>
      </div>
    </div>
    <div class="accordion-box column">
      <a class="accordion"></a>
      <div class="box">
        <form action="../regList/searchresult.php" method="get" id="name">
          <input type="text" name="keyword" placeholder="”店舗名”を入力"><br>
          <button type="submit" name="name_search" form="name" >検索</button>
        </form>
      </div>
    </div>
    <div class="accordion-space"></div>
    <!-- タグ検索 -->
    <div class="search">
      <div class="search_navi-tag">
        <a class="search-pin">●</a>
        <a class="search-img">
        <img src="./img/store_tag.png">
        </a>
      </div>
      <div class="search_navi2">
      <a class="search-tag">タグ</a><a class="search-text">で探す</a>
      </div>
    </div>
    <div class="accordion-box column">
      <a class="accordion"></a>
      <div class="box">
          <form action="../regList/searchresult.php" method="get" id="tag">
              <?php for($i=0;$i<$cnt;$i++){?>
                  <input type="radio" class="tag_button" name="tag_id" value="<?php echo $tag_id[$i]; ?>"><?php  echo $tag_name[$i]; ?></input>
              <?php } ?>
              <button type="submit" name="tag_search" form="tag">検索</button>
          </form>
      </div>
    </div>
    <!-- 地図検索 -->
    <div class="accordion-space"></div>
    <div class="search">
      <div class="search_navi-map">
        <a class="search-pin">●</a>
        <a class="search-img">
        <img src="./img/store_map.png">
        </a>
      </div>
      <div class="search_navi2">
      <a class="search-map">地図</a><a class="search-text">で探す</a>
      </div>
    </div>
    <div class="accordion-box column">
      <a class="accordion"></a>
      <div class="box">
        機能はここに
      </div>
    </div>
    <div class="accordion-space"></div>
  </div>
  <button type="button" class="Top-Store-Button" onclick="location.href='../reg/Post.php'">お店を投稿する</button>
  <div class="footer"></div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="./js/top-script.js"></script>
</div>
</body>
</html>
