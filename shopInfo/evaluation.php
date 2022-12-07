<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>評価機能確認ページ</title>
    <link rel="stylesheet" href="./css/evaluation.css">
</head>
<body>
                <?php
                $shop_id = 1;//仮店舗＿実装時は変えて下さい
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
                     $sql=$pdo->prepare('SELECT AVG(shop_Appearance_evaluation) as AP_AVG,AVG(shop_atmosphere_evaluation) as AT_AVG,AVG(shop_taste_evaluation)as TE_AVG FROM m_shopEvaluation WHERE shop_id=?');
                     $sql->execute([$shop_id]);
                     foreach ($sql as $row){
                         $Appearance_AVG = $row['AP_AVG'];
                         $atmosphere_AVG = $row['AT_AVG'];
                         $taste_AVG = $row['TE_AVG'];
                     }
                    $average = ($Appearance_AVG + $atmosphere_AVG + $taste_AVG) / 3;
                     $average = round($average,1);
                     echo '<form action="evaluation-insert.php?id=',$shop_id,'" method="post" name="insert">';
                     echo'<a class="store_detail_list">評価</a><a class="average_star">★</a><a class="average" >',number_format($average, 1),'</a><br>';//第二引数を四捨五入
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
                    <input type="submit" class="evaluation_button" value="お店を評価する" onClick="return check();"><br>
                </form>
                <script type="text/javascript">
                    function check(){
                        if (insert.appearance.value == "") {
                            alert("評価項目を全て入力して下さい");    //エラーメッセージを出力
                            return false;    //送信ボタンの動作をキャンセル
                        }else if(insert.atmosphere.value == "") {
                            alert("評価項目を全て入力して下さい");    //エラーメッセージを出力
                            return false;    //送信ボタンの動作をキャンセル
                        }else if(insert.taste.value == "") {
                            alert("評価項目を全て入力して下さい");    //エラーメッセージを出力
                            return false;    //送信ボタンの動作をキャンセル
                        }else{
                            return true;    //送信ボタンの動作を実行
                        }
                    }
                </script>
</body>
</html>
