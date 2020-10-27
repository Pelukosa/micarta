<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require  $_SERVER['DOCUMENT_ROOT'] . "/application/config.php";

$session = new Session();

session_start();
if (empty($_SESSION)) {
    header('Location: http://' .$_SERVER["HTTP_HOST"] . '/panel/login.php');
}