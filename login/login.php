<?php
//ファイルの読み込み
/* ①　データベースの接続情報を定数に格納する */
const DB_HOST = 'mysql:host=mysql207.phy.lolipop.lan;dbname=LAA1290570-gohunt;charaset=utf8';
const DB_USER = 'LAA1290570';
const DB_PASSWORD = 'gohunt';

//②　例外処理を使って、DBにPDO接続する
try {
    $pdo = new PDO(DB_HOST,DB_USER,DB_PASSWORD,[
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES =>false
    ]);
} catch (PDOException $e) {
    echo 'ERROR: Could not connect.'.$e->getMessage()."\n";
    exit();
}
//XSS対策
function h($s){
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

//セッションにトークンセット
function setToken(){
    $token = sha1(uniqid(mt_rand(), true));
    $_SESSION['token'] = $token;
}

//セッション変数のトークンとPOSTされたトークンをチェック
function checkToken(){
    if(empty($_SESSION['token'] || ($_SESSION['token'] != $_POST['token']))){
        echo 'Invalid POST';
        exit;
    }
}

//POSTされた値のバリデーション
function validations($datas,$confirm = true)
{
    $errors = [];

    //ユーザー名のチェック
    if(empty($datas['user_name'])) {
        $errors['user_name'] = 'Please enter username.';
    }else if(mb_strlen($datas['user_name']) > 20) {
        $errors['user_name'] = 'Please enter up to 20 characters.';
    }

    //パスワードのチェック（正規表現）
    if(empty($datas["user_pass"])){
        $errors['user_pass']  = "Please enter a password.";
    }else if(!preg_match('/\A[a-z\d]{1,100}+\z/i',$datas["user_pass"])){
        $errors['user_pass'] = "Please set a password with at least 8 characters.";
    }
    return $errors;
}
//セッション開始
session_start();

// セッション変数 $_SESSION["loggedin"]を確認。ログイン済だったらトップページへリダイレクト
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../top/top.php");
    exit;
}

//POSTされてきたデータを格納する変数の定義と初期化
$datas = [
    'user_name'  => '',
    'user_pass'  => '',
    'confirm_password'  => ''
];
$login_err = "";

//GET通信だった場合はセッション変数にトークンを追加
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    setToken();
}

//POST通信だった場合はログイン処理を開始
if($_SERVER["REQUEST_METHOD"] == "POST"){

    ////CSRF対策
    checkToken();
    // POSTされてきたデータを変数に格納
    foreach($datas as $key => $value) {
        if($value = filter_input(INPUT_POST, $key, FILTER_DEFAULT)) {
            $datas[$key] = $value;
        }
    }
    // バリデーション
    $errors = validations($datas,false);
    var_dump($errors);
    if(empty($errors)){
        //ユーザーネームから該当するユーザー情報を取得
        $sql = "SELECT user_id,user_name,user_pass FROM m_user WHERE user_name = :user_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('user_name',$datas['user_name'],PDO::PARAM_INT);
        $stmt->execute();
        //ユーザー情報があれば変数に格納
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //パスワードがあっているか確認
            if (password_verify($datas['user_pass'],$row['user_pass'])) {
                //セッションIDをふりなおす
                session_regenerate_id(true);
                //セッション変数にログイン情報を格納
                $_SESSION["loggedin"] = true;
                $_SESSION["user_id"] = $row['user_id'];
                $_SESSION["user_name"] =  $row['user_name'];
                //ウェルカムページへリダイレクト
                header("location:../top/top.php");
                exit();
            } else {
                var_dump($datas['user_pass']);
            var_dump($row['user_pass']);
            }
        }else {
            $login_err = 'Invalid user_name or user_pass.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" href = "./css/login.css">
</head>
<body>
<div class="back">
    <div class="title">
        <h2>ログイン</h2>
    </div>
    <div class = "IPhone">
        <form action = "<?php echo $_SERVER ['SCRIPT_NAME']; ?>" method = "post">
            <div class = "Form">
                <p>ユーザーネーム</p>
                <input type="text" name="user_name" class="form-control <?php echo (!empty(h($errors['user_name']))) ? 'is-invalid' : ''; ?>" value="<?php echo h($datas['user_name']); ?>">
                <p>パスワード</p>
                <input type='password' name="user_pass" class="form-control <?php echo (!empty(h($errors['user_pass']))) ? 'is-invalid' : ''; ?>" value='<?php echo h($datas['user_pass']); ?>'><br>
            </div>
            <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
            <button type="submit" class = "Login">ログイン</button><br>
        </form><br>
        <br>
        <a href = "" class ="newAco">新規登録の方はこちら</a>
    </div>
</div>
</body>
</html>
