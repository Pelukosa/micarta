<?php
include("../../../panel/config/config.php");

$productFamily = new ProductFamily();
$families = $productFamily->getAccountFamilies();

$familyCodesByUser = array();
foreach ($families as $family) {
    $familyCodesByUser[$family["CODE"]] = $family["CODE"];
}

if ($_POST["check"] == 0) {
    if (in_array($_POST["code"], $familyCodesByUser)) {
        unset($familyCodesByUser[$_POST["code"]]);
    }
}
else {
    if (!in_array($_POST["code"], $familyCodesByUser)) {
        $familyCodesByUser[$_POST["code"]] = $_POST["code"];
    }
}
echo count($familyCodesByUser);
$query = "UPDATE user_config SET PRODUCT_FAMILIES_CODE = '".implode("|", $familyCodesByUser)."'";
echo $query;
$productFamily->conn()->query($query);