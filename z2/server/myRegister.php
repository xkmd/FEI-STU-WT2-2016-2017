<?php require __DIR__.'/functions.php' ?>
<?php
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $dbh = connect_to_db();
    $user = fetchUser($dbh, $request->login);
    
    if($user['login'])
      echo $user['login'];
    else{
        addUser($dbh, $request->login, password_hash($request->password, PASSWORD_DEFAULT), $request->email, $request->firstName, $request->lastName);
        addRecord($dbh, $request->login, $request->type);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($user, JSON_UNESCAPED_UNICODE);
    }
?>
