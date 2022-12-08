<?php
    session_start();
    // セッション情報の保存

?>
<html>
	<head>
		  <link rel="stylesheet" href="./css/style.css">
  		  <link rel="stylesheet" href="./css/Post.css">
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
									<div id="preview"><input type="file" onChange="imgPreView(event)" name="shopImg"><br>
									<script src="./js/Post.js"></script></div>
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
	<div class="star">
		<a class="star1"><font size="7">入りやすさ</font></a><br>
		<div id="stars">
	        <span class="star" data-star="1">☆</span>
	        <span class="star" data-star="2">☆</span>
	        <span class="star" data-star="3">☆</span>
	        <span class="star" data-star="4">☆</span>
	        <span class="star" data-star="5">☆</span>
    	</div>
		<a class="star2"><font size="7">味</font></a><br>
		<div id="stars">
	        <span class="star" data-star="1">☆</span>
	        <span class="star" data-star="2">☆</span>
	        <span class="star" data-star="3">☆</span>
	        <span class="star" data-star="4">☆</span>
	        <span class="star" data-star="5">☆</span>
    	</div>
		<a class="star3"><font size="7">雰囲気</font></a><br>
		<div id="stars">
	        <span class="star" data-star="1">☆</span>
	        <span class="star" data-star="2">☆</span>
	        <span class="star" data-star="3">☆</span>
	        <span class="star" data-star="4">☆</span>
	        <span class="star" data-star="5">☆</span>
   	 	</div>
	</div>
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
			echo '<input type="checkbox" class="tag_button" name="tagId[]" value="',$tata,'"><font size="6">',$tag['tag_name'],'</font></button>';
		}
	}
		?>
	
</div>
<div><a class="come"><font size="7">コメント</font></a>
		<p><input type="text" class="comment" placeholder="店舗のコメントを入力" name="shopComment"></p>
		</div>
</div>
</div>
<button type="submit" class = "reg"><font size="6">登録する</font></button><br>
		</form>
</div>
</body>
</html>
