<?php
    error_reporting(E_ALL ^ E_NOTICE);
    require_once('Connect.php');
    require 'master.php';

    session_start();
    unset($_SESSION['username']);  
    header("Location: index.php");
?>