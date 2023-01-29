<?php

//make sure user is logged in
if ( AUTHENTICATION::isLoggedIn() ){
    //only if user is logged in,then only trigger logout
    AUTHENTICATION::logout();
}


header('Location: /login');
exit;