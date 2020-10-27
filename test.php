<?php
include 'application/config.php';

$product = Product::getList();
App::prePrint($product);
exit;