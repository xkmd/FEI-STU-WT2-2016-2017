<?php
    session_start();

    //Include Google client library 
    include_once 'src/Google_Client.php';
    include_once 'src/contrib/Google_Oauth2Service.php';

    /*
     * Configuration and setup Google API
     */
    $clientId = '820378439965-idrcp0fe3pnvdsqdnn2frvm25h8a8gje.apps.googleusercontent.com'; //Google client ID
    $clientSecret = 'dgSQRTKvnUXfLogQjAuUYi6C'; //Google client secret
    $redirectURL = 'http://ivo.knet.sk/z2/server/login_with_google_using_php/'; //Callback URL

    //Call Google API
    $gClient = new Google_Client();
    $gClient->setApplicationName('Login to CodexWorld.com');
    $gClient->setClientId($clientId);
    $gClient->setClientSecret($clientSecret);
    $gClient->setRedirectUri($redirectURL);

    $google_oauthV2 = new Google_Oauth2Service($gClient);
?>