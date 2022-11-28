<link rel="stylesheet" href="../header/css/mstyle.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"
    charset="utf-8"></script>
<script type="text/javascript" src="../header/js/menu.js"></script>
</head>
<div class="nav-right visible-xs">
    <div class="button" id="btn">
        <div class="bar top"></div>
        <div class="bar middle"></div>
        <div class="bar bottom"></div>
    </div>
</div>
<!-- nav-right -->
<main>
    <a href="demo.html">
        <img src="../header/img/titlelogo.png" class="titlelogo">
    </a>
    <nav>
        <div class="nav-right hidden-xs">
            <div class="button" id="btn">
                <div class="bar top"></div>
                <div class="bar middle"></div>
                <div class="bar bottom"></div>
            </div>
        </div>
        <!-- nav-right -->
    </nav>

    <a href="https://codepen.io/tonkec/" class="ua" target="_blank">
        <i class="fa fa-user"></i>
    </a>
</main>

<div class="sidebar"　id="slide">
    <ul class="sidebar-list" id="slide-list">
        <li class="sidebar-item"><a href="../top/top.php" class="sidebar-anchor">メインページ</a></li>
        <li class="sidebar-item"><a href="../userInfo/mypage.php" class="sidebar-anchor">マイページ</a></li>
        <?php 
        if(empty($_SESSION["loggedin"])||$_SESSION["loggedin"]==false){
        echo '<li class="sidebar-item"><a href="../login/login.php" class="sidebar-anchor">ログイン</a></li>';
        }else{
        echo '<li class="sidebar-item"><a href="../logout/logout.php" class="sidebar-anchor">ログアウト</a></li>';
        }
        ?>
        <li class="sidebar-item"><a href="../reg/Post.html" class="sidebar-anchor">投稿する</a></li>
        <li class="sidebar-item"><a href="demo.html" class="sidebar-anchor">お問い合わせ</a></li>
        <li class="sidebar-item"><a href="demo.html" class="sidebar-anchor">ヘルプ</a></li>
    </ul>
</div>
<body>
