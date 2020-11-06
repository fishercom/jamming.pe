<?php
//require 'vendor/autoload.php';
//use GuzzleHttp\Psr7\Request;
//use GuzzleHttp\Client;

session_start();

if(isset($_SESSION['token'])){

  $_SESSION['token'] = null;
  unset($_SESSION['token']);
  header('location: login.php');

}

?>