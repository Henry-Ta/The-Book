<?php
    session_start();
    if(isset($_SESSION['thebook_userid'])){
        unset($_SESSION['thebook_userid']);
    }
    
    header("Location: login.php");
    die;
?>