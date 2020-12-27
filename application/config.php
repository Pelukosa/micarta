<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {
    $path = "classes/";
    $extension = ".class.php";
    $fullPath = $path . $className . $extension;

    include_once $fullPath;
}
$host = array_shift((explode('.', $_SERVER['HTTP_HOST'])));
$user = new User(1);
$account = new Account($user->fields["ACCOUNT_ID"]);
$template = new Template();