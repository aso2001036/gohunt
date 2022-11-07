<?php
function passCheck($pass,$checkpass){
    $error['password'] = true;
    if($pass === "" || $checkpass === "" ){
        $error['password'] = 'blank';

    }elseif(strlen($pass) < 5 || strlen($checkpass) < 5 || strlen($pass) > 15 || strlen($checkpass) > 15 ){
        $error['password'] = 'length';
    }elseif(strcmp($pass, $checkpass)){
        $error['password'] = 'notSame';
    }
    return $error;
}

function mailCheck($email,$pdo){
    $error['email'] = true;
    if($email === ""){
        $error['email'] = 'blank';
    }
    else if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
        $error['email'] = "notMatch";
    }
    if($error['email'] ===true){
        $member = $pdo->prepare('SELECT COUNT(*) as cnt FROM m_users WHERE user_mail=?');
        $member->execute(array(
            $email
        ));
        $record = $member->fetch();
        if ($record['cnt'] > 0) {
            $error['email'] = 'duplicate';
        }
    }
    return $error;
}

function nameCheck($name){
    $error['name'] = true;
    if($name === ""){
        $error['name'] = 'blank';
    }
    else if(strlen($name)>20){
        $error['name'] = 'length';
    }
    return $error;
}

function sexCheck($sex){
    $error['sex'] = true;
    if($sex != '1' && $sex !='2' && $sex != '3' ){
        $error['sex'] = 'notMatch';
    }
    return $error;
}

function tokenCheck($token,$pdo){
    $error['token'] = true;
    $sql = "SELECT pre_user_mail FROM m_pre_users WHERE pre_user_token=(:pre_user_token) AND flag =0 AND reg_date > now() - interval 24 hour";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':pre_user_token', htmlspecialchars($token), PDO::PARAM_STR);
    $stm->execute();


    //レコード件数取得
    $row_count = $stm->rowCount();


    //24時間以内に仮登録され、本登録されていないトークンの場合
    if( $row_count != 1){
        $error['token'] = "urltoken_timeover";
    }
    return $error;
}

function mailCountCheck($token,$pdo){
    $error['email'] = true;
    if($error['email'] ===true){
        $sql = "SELECT pre_user_mail FROM m_pre_users WHERE pre_user_token=(:pre_user_token) AND flag =0 AND reg_date > now() - interval 24 hour";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':pre_user_token', htmlspecialchars($token), PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $member = $pdo->prepare('SELECT COUNT(*) as cnt FROM m_users WHERE user_mail=?');
        $member->execute(array(
            htmlspecialchars($result['pre_user_mail'])
        ));
        $record = $member->fetch();
        if ($record['cnt'] > 0) {
            $error['email'] = 'duplicate';
        }
    }
    return $error;
}

function loginCheck($mail,$pass,$pdo){
    $idFlag = false;
    $passFlag = false;
    $flag = false;
    print_r($passFlag);

    $statement = $pdo->prepare("select user_pass from m_users where user_mail=(:user_mail)");
    $statement->bindValue(':user_mail', htmlspecialchars($mail), PDO::PARAM_STR);
//    echo 'test';
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $count = $statement ->rowCount();
//    print_r($result);
//    print_r($count);
    if($count == 1){
        foreach ($result as $row) {
//            print_r($row);
            $hash = $row;
            $idFlag = true;
            $passFlag = password_verify($pass,$hash);
//            var_dump($passFlag);
        }
    }

    if($idFlag && $passFlag){
        $flag = true;
    }
    return $flag;
}

function mailExistCheck($mail,$pdo){
    $error['email'] = false;
    $statement = $pdo->prepare("select user_pass from m_users where user_mail=(:user_mail)");
    $statement->bindValue(':user_mail', htmlspecialchars($mail), PDO::PARAM_STR);
//    echo 'test';
    $statement->execute();
//    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $count = $statement ->rowCount();
//    print_r($result);
//    print_r($count);
    if($count == 1){
        $error['email']  = true;
    }
    return $error;
}

?>