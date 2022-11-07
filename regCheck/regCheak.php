<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/regCheak.css">
</head>
<body>
<div class="background">
    <a class="logo">ごはんと</a>
    <div class="title_banner">
        <a class="title_page">ページ名</a>
    </div>
    <div class="store_confirm_content">
        <form>
            <a class="store_confirm_text">店舗名</a><br>
            <input type="text" class="store_namekana_box" value="まるまるらーめん" readonly><br>
            <input type="text" class="store_name_box" value="○○ラーメン" readonly><br>
            <a class="store_confirm_text">店舗画像</a><br>
            <img class="img" src="./img/sample.png"><br>
            <a class="store_confirm_text">住所</a><br>
            <input type="text" class="address_box" value="福岡県 福岡市 博多区 博多駅南2丁目" readonly>
            <div class="star">
                <a class="store_confirm_text">評価</a><br>
                <a class="evaluation_text">入りやすさ</a><br>
                <div class="evaluation">
                    <input id="easy_enter5" type="radio" name="" value="5">
                    <label for="easy_enter5">★</label>
                    <input id="easy_enter4" type="radio" name="" value="4">
                    <label for="easy_enter4">★</label>
                    <input id="easy_enter3" type="radio" name="" value="3">
                    <label for="easy_enter3">★</label>
                    <input id="easy_enter2" type="radio" name="" value="2">
                    <label for="easy_enter2">★</label>
                    <input id="easy_enter1" type="radio" name="" value="1">
                    <label for="easy_enter1">★</label>
                </div>
                <a class="evaluation_text">味</a><br>
                <div class="evaluation">
                    <input id="taste5" type="radio" name="" value="5">
                    <label for="taste5">★</label>
                    <input id="taste4" type="radio" name="" value="4">
                    <label for="taste4">★</label>
                    <input id="taste3" type="radio" name="" value="3">
                    <label for="taste3">★</label>
                    <input id="taste2" type="radio" name="" value="2">
                    <label for="taste2">★</label>
                    <input id="taste1" type="radio" name="" value="1">
                    <label for="taste1">★</label>
                </div>
                <a class="evaluation_text">雰囲気</a><br>
                <div class="evaluation">
                    <input id="ambience5" type="radio" name="" value="5">
                    <label for="ambience5">★</label>
                    <input id="ambience4" type="radio" name="" value="4">
                    <label for="ambience4">★</label>
                    <input id="ambience3" type="radio" name="" value="3">
                    <label for="ambience3">★</label>
                    <input id="ambience2" type="radio" name="" value="2">
                    <label for="ambience2">★</label>
                    <input id="ambience1" type="radio" name="" value="1">
                    <label for="ambience1">★</label>
                </div>
            </div>
            <a class="store_confirm_text">タグ</a>
            <div class="tag">
                <button type="submit" class="tag_button" formaction="(URL 一覧)" form="(フォームID)">タグ</button>
                <button type="submit" class="tag_button" formaction="(URL 一覧)" form="(フォームID)">タグ</button>
            </div>
            <a class="store_confirm_text">コメント</a><br>
            <textarea class="store_textarea"></textarea><br>
            <button type="submit"  class="post_button">投稿する</button>
        </form>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="./js/postconfirm.js"></script>
</body>
</html>