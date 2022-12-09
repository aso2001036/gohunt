<?php
    session_start();
    // セッション情報の保存

?>
<html>
	<head>
		  <link rel="stylesheet" href="./css/style.css">
  		  <link rel="stylesheet" href="./css/Post.css">
		<link rel="stylesheet" href="../hyouka/css/evaluation.css">
		<meta charset="UTF-8">
		<title>投稿</title>
		<?php require("../header/menu.php"); ?>
	<div class="page">
		<div class="title"></div>
		<form action="../regCheck/regist.php" method="post" enctype="multipart/form-data">
			<div class="post">
				<a class="shop_name"><font size="10">店舗名</font></a>
					<div class="kana_box">
						<input type="text" class="kana" placeholder="かな入力*ひらがなで入力してください*" name="shopNameKana"></input>
					</div>
						<div class="name_input_box">
							<input type="text" class="name_input" placeholder="店舗名入力" name="shopName">
						</div> 
							<div class="shop_img">
							<p><font size="7">店舗の写真を選択</font><br></div>
                                    <label class="upload-label">
									<div id="preview"><input type="file" onChange="imgPreView(event)" name="shopImg"><br>
									<script src="./js/Post.js"></script></div>
                                    </label>

<div class="locate">
	<a class="juusyo"><font size="7">お店の場所</font></a><br>
		<input type="text" class="location" placeholder="住所入力" name="shopJusyo">
</div>
<div class="map">
	<script>
		function  msgdsp() {
	           alert("開発中");
	       }
	</script>
     <input type="button" class="B1"
     value="地図表示"
     onclick="msgdsp()">
</div>
<?php
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
<div class="tag">
	<a class="shop_tag"><font size="7">タグ</font></a><br>
		<?php
	require("../conect.php");
	$tags = $pdo->query('SELECT * FROM m_tag');
	foreach($tags as $tag){
		$tata = $tag['tag_id'];
		if($tag['tag_id']%3==0){
			echo '<input type="checkbox" class="tag_button" name="tagId[]" value="',$tata,'"><font size="6">',$tag['tag_name'],'</font></button><br>';
		}else{
			echo '<input type="checkbox" class="tag_button" name="tagId[]"value="',$tata,'"><font size="6">',$tag['tag_name'],'</font></button>';
		}
	}
		?>
	
</div>
<div><a class="come"><font size="7">コメント</font></a>
		<p><input type="text" class="comment" placeholder="店舗のコメントを入力" name="shopComment"></p>
		</div>
</div>
</div>
<button type="submit" class="reg">登録する</button><br>
		</form>
</div>
</body>
</html>