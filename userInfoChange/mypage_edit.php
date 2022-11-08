<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja"></html>
<head>
    <meta charset="UTF-8">
    <title>マイページ</title>
    <link rel="stylesheet" href="css/mypage_edit.css">
    <meta name="viewport" content="width=device-width,initial-scale-1">
</head>
<body>
    <div class="gohant">
         <img src="img/cooltext421301192687833 1-1.png">
    </div>
    <div class="hamburger-menu">
        <input type="checkbox" id="menu-btn-check">
        <label for="menu-btn-check" class="menu-btn"><span></span></label>
    </div>
    <div style="background-color:#505050;">
        <div class="mypage">
           <img src="img/cooltext421486115691405 1.png">
           </div>
        </div>
        <form>
    <div class="box">
        <p>ユーザーID</p>
        <div class="margin"></div>
        <input type="text" id="id" class="example" size="40px">
        <p>ユーザー名</p>
        <div class="margin"></div>
        <input type="text" id="name" class="example" size="40px">
        <p>メールアドレス</p>
        <div class="margin"></div>
        <input type="email" id="email" class="example" size="40px">
        <p>パスワード</p>
        <div class="margin"></div>
        <input type="password" id="pass" class="example" size="40px">
        <div class="hoge_button">
        <button type="submit" onclick="mypage.html" value="遷移">変更完了</button>
        </div>
    </div>
    </form>
</body>