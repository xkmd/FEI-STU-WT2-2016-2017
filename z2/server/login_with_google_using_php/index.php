<?php require '/home/xkmotorkai/public_html/z2/server/functions.php' ?>
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //define('MYDIR','/home/xkmotorkai/public_html/z2/server/login_with_google_using_php/');
    //Include GP config file 
    include_once("gpConfig.php"); 

    if(isset($_GET['code'])){
        $goog = $gClient->authenticate($_GET['code']);
        $_SESSION['token'] = $gClient->getAccessToken();
    }

    if (isset($_SESSION['token'])) {
        $gClient->setAccessToken($_SESSION['token']); 
    }

    if ($gClient->getAccessToken()) { 
        //Get user profile data from google
        $gpUserProfile = $google_oauthV2->userinfo->get();

        if(!empty($gpUserProfile)){ 
            if(!$dbh = connect_to_db())
                die("error connectiong to kokot");

            addRecord($dbh, $gpUserProfile['email'], 'googleLogin'); 
            $_SESSION['loginType'] = 'googleLogin';
            $_SESSION['username'] = $gpUserProfile['email'];
            echo "loginOK";

            header('Location: http://ivo.knet.sk/z2/client');

        }else{
            echo "wrongLogin";
        }   
      } 
    else {
        $authUrl = $gClient->createAuthUrl();
        $output = filter_var($authUrl, FILTER_SANITIZE_URL);
        echo $output; 
    }
?>

