<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Insert title here</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="page">

    <div class="backimg"></div>
    <div class="img">
        <a class="back"><<</a>
    <img class="img" src="./img/Frame%2089.png">
        <a class="img">〇〇ラーメン</a>
    </div>
    <div class="frame">
        <div class="info">
            <a class="day">投稿日:2022/10/11</a>
            <a class="fday">最終更新日:2022/10/15</a>
            <div class="address">
                <a class="jyuusyo">住所</a>
                <a class="add">福岡県福岡市...</a>
            </div>
            <div class="search">
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
            <div class="star">
                <a class="hyouka">評価</a>
                <div class="bigstar">
                    <a>☆</a>

                </div>
                <a class="hairi">入りやすさ</a>
                    ☆☆☆☆☆
                <a class="aji">味</a>
                    ☆☆☆☆☆
                <a class="huni">雰囲気</a>
                    ☆☆☆☆☆
            <input type="button" class="value" value="お店を評価する">
            </div>
                <a class="tag">タグ</a>
            <div class="tag">
                <button type="submit" class="tag" formaction="(URL 一覧)" form="(フォームID)">タグ</button>
                <button type="submit" class="tag" formaction="(URL 一覧)" form="(フォームID)">タグ</button>
            </div>
                <a class="com">コメント</a>
                    <textarea class="text"></textarea><br>
            <div class="btn">
                    <button type="submit"  class="edit" formaction="(URL 編集ページ)" form="(フォームID)">編集する</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="./js/shopinfo.js"></script>
</body>
</html>