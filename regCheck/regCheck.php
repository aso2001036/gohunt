<?php
    session_start();
    // セッション情報の保存

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gohunt - Check</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/regCheck.css">
    </head>
<body>
<div class="background">
    <a class="logo">ごはんと</a>
    <div class="title_banner">
        <a class="title_page">ページ名</a>
    </div>
    <div class="store_confirm_content">
        <form action="./store_post_insert.php" method="post">
            <a class="store_confirm_text">店舗名</a><br>
            <?php
             echo '<input type="text" class="store_namekana_box" value="',$_POST['shopNameKana'],'" readonly name="kana"><br>';//valueを変数名に
             echo '<input type="text" class="store_name_box" value="',$_POST['shopName'],'" readonly name="name"><br>';
            ?>
            <a class="store_confirm_text">店舗画像</a><br>
            <?php
              echo '<img class="img" src="./img/',$_POST['shopImg'],'><br>';//srcのimg以降のアドレスを変更
            ?>
            <a class="store_confirm_text">住所</a><br>
            <?php
              echo '<input type="text" class="address_box" value="',$_POST['shopJusyo'],'" readonly name="address">';//valueを変数名に
            ?>
            <div class="star">
                <a class="store_confirm_text">評価</a><br>
                <a class="evaluation_text">入りやすさ</a><br>
                <div class="evaluation">
                    <?php
                    //echo '<p><span class="star5_rating" data-rate="',$_POST[''],'"></span></p>';//data-rateの中を変数に
                    //echo '<input type="hidden" name="appearance" value="',$_POST[''],'">';//valueを変数に
                    ?>
                </div>
                <a class="evaluation_text">味</a><br>
                <div class="evaluation">
                    <?php
                    //echo '<p><span class="star5_rating" data-rate="',$_POST[''],'"></span></p>';//data-rateの中を変数に
                    //echo '<input type="hidden" name="taste" value="',$_POST[''],'">';//valueを変数に
                    ?>
                </div>
                <a class="evaluation_text">雰囲気</a><br>
                <div class="evaluation">
                    <?php
                    //echo '<p><span class="star5_rating" data-rate="',$_POST[''],'"></span></p>';//data-rateの中を変数に
                    //echo '<input type="hidden" name="atmosphere" value="',$_POST[''],'">';//valueを変数に
                    ?>
                </div>
            </div>
            <a class="store_confirm_text">タグ</a>
            <div class="tag">
               <?php
		require("../conect.php");
        $max = count($_POST['tagId']);
                for($i=0; $i<$max; $i++){ 
                    $tagsid = $_POST['tagId'][$i];
            $tags = $pdo->prepare('SELECT * FROM m_tag WHERE tag_id = :tag');
            $tags -> bindValue(':tag',$_POST['tagId'][$i]);
            $tags -> execute();
            foreach($tags as $tag){
		if($i%3==0&&$i!=0){
            
			echo '<button type="button" class="tag_button" name="tagId[]" value="',$tagsid,'"><font size="5">',$tag['tag_name'],'</font></button><br>';
		}else{
			echo '<button type="button" class="tag_button" name="tagId[]" value="',$tagsid,'"><font size="5">',$tag['tag_name'],'</font></button>';
		}
    }
    }
    ?>
            </div>
            <a class="store_confirm_text">コメント</a><br>
            <?php
              echo'<textarea class="store_textarea" name="commemt">',$_POST['shopComment'],'</textarea><br>';
            ?>
            <button type="submit"  class="post_button" value="send">投稿する</button>
        </form>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="./js/postconfirm.js"></script>
</body>
</html></em>
