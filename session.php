<?php

session_start();

if(!isset($_SESSION['usuarios'])){
    header("location:login.php");
    exit;
}