<?php require __DIR__.'/functions.php' ?>
<?php
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
 
    $dbh = connect_to_db();
    $user = fetchUser($dbh, $request->login);
    
    if($user['login']){
        if(password_verify ( $request->password , $user['password'] )){
            addRecord($dbh, $request->login, $request->type);
            session_start();
            $_SESSION['loginType'] = $request->type;
            $_SESSION['username'] = $request->login;
            echo "loginOK";
        }
        else{
            echo "wrongPass";
        }
    }
    else{
        echo "wrongLogin";
    }
?>
