<?php
    session_start();
    if ($_SESSION['login']){

    }
    else{
        header('location: login.php');
    }
?>