<?php
include("../../application/config.php");

$id = $_GET["ID"];

$product = new Product($id);
$product->deleteObject();

header('Location: ' . "../product/");