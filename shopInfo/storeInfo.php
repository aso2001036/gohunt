<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gohunt - Detail</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/shopInfo.css">
</head>
<body>
<div class="background">
    <a class="logo">logo</a><br>
    <?php
    $pdo = new PDO(
        'mysql:host=mysql207.phy.lolipop.lan;
    dbname=LAA1290570-gohunt;charaset=utf8',
        'LAA1290570',
        'gohunt');
    $shop_id = ($_GET['id']);


    $sql=$pdo->prepare('select * from m_shop where post_id=?');
    $sql->execute([$shop_id]);
    $sql=$pdo->prepare('select AVG(shop_Appearance_evaluation),AVG(shop_Appearance_evaluation),AVG(shop_Appearance_evaluation) from m_shopEvaluation GROUP BY shop_id=?');


    ?>
    <?php
    echo'<div class="detail_image" style="background-image: url(./img/',$img,')">';//./img/の部分に画像のファイル名の変数を入れる
    echo'<a href="#" onclick="history.back(-1);return false;" class="back"><<</a><br>';
    echo'<input type="text" value="" name="" class="store_detail_title" readonly>';//value内に店名の変数を入れる
    echo'</div>';
    ?>
        <div class="sub_background">
            <div class="detail_content">
            <?php
            echo'<input type="hidden" value="" name="">';
            echo'<a class="store_detail_text">投稿日:</a><a class="store_detail_date"></a><br>';//aタグ内に投稿日の変数を入れる
            echo'<a class="store_detail_text">最終更新日:</a><a class="store_detail_date"></a><br>';//aタグ内に最終更新日の変数を入れる
            echo'<a class="store_detail_list">住所</a><br>';
            echo'<a class="store_list_text"></a><br>';//aタグ内に住所の変数を入れる
            ?>
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
            <div class="star">
                <?php
                echo '<form action="evaluation-insert.php?id=',$shop_id,'" method="post">';
                    $sql=$pdo->prepare('select AVG(shop_Appearance_evaluation),AVG(shop_Appearance_evaluation),AVG(shop_Appearance_evaluation) from m_shopEvaluation GROUP BY shop_id=?');


                    echo'<a class="store_detail_list">評価</a><a class="average_star">★</a><a class="average">3.0</a><br>';
                    ?>
                    <a class="evaluation_text">入りやすさ</a><br>
                    <div class="evaluation">
                        <input id="easy_enter5" type="radio" name="appearance" value="5">
                        <label for="easy_enter5">★</label>
                        <input id="easy_enter4" type="radio" name="appearance" value="4">
                        <label for="easy_enter4">★</label>
                        <input id="easy_enter3" type="radio" name="appearance" value="3">
                        <label for="easy_enter3">★</label>
                        <input id="easy_enter2" type="radio" name="appearance" value="2">
                        <label for="easy_enter2">★</label>
                        <input id="easy_enter1" type="radio" name="appearance" value="1">
                        <label for="easy_enter1">★</label>
                    </div>
                    <a class="evaluation_text">味</a><br>
                    <div class="evaluation">
                        <input id="taste5" type="radio" name="taste" value="5">
                        <label for="taste5">★</label>
                        <input id="taste4" type="radio" name="taste" value="4">
                        <label for="taste4">★</label>
                        <input id="taste3" type="radio" name="taste" value="3">
                        <label for="taste3">★</label>
                        <input id="taste2" type="radio" name="taste" value="2">
                        <label for="taste2">★</label>
                        <input id="taste1" type="radio" name="taste" value="1">
                        <label for="taste1">★</label>
                    </div>
                    <a class="evaluation_text">雰囲気</a><br>
                    <div class="evaluation">
                        <input id="ambience5" type="radio" name="atmosphere" value="5">
                        <label for="ambience5">★</label>
                        <input id="ambience4" type="radio" name="atmosphere" value="4">
                        <label for="ambience4">★</label>
                        <input id="ambience3" type="radio" name="atmosphere" value="3">
                        <label for="ambience3">★</label>
                        <input id="ambience2" type="radio" name="atmosphere" value="2">
                        <label for="ambience2">★</label>
                        <input id="ambience1" type="radio" name="atmosphere" value="1">
                        <label for="ambience1">★</label>
                    </div>
                    <input type="button" class="evaluation_button" value="お店を評価する"><br>
                    <!-- タグ-->
                    <a class="store_detail_list">タグ</a><br>
                    <div class="tag">
                        <button type="submit" class="tag_button" formaction="(URL 一覧)" form="(フォームID)">タグ</button>
                        <button type="submit" class="tag_button" formaction="(URL 一覧)" form="(フォームID)">タグ</button>
                    </div>
                    <!-- コメント-->
                    <a class="store_detail_list">コメント</a><br>
                    <?php
                    echo'<textarea class="text_area"></textarea><br>';//textarea内にコメントの変数を入れる
                    ?>
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