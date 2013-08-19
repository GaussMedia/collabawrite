<?php

if (array_key_exists("logout", $_GET)) {
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['oauth_provider']);
    session_unset();
    header("location: http://reportedly.pnf-sites.info/developer/");
}
?>
