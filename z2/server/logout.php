<?php
    include_once './login_with_google_using_php/gpConfig.php';
    session_start();
    if($_SESSION['loginType']=='googleLogin')
        $gClient->revokeToken(); 
    $_SESSION = array();
?>
   