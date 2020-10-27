<?php
include("../../application/config.php");


$productId = $_POST["ID"];
if (is_numeric($productId)) {
  $product = new Product($productId);
  $productCode = $product->fields["CODE"];
} else {
  $newProduct = true;
  $product = new Product();
  $productCode = $product->generateNewCode($_POST["FAMILY_CODE"]);
}

$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION));
$target_dir = "../../assets/img/" . $user->id . "/";
$target_file = $target_dir . $productCode . ".png";
// Check if folder as been created
if (!is_dir($target_dir)) {
  mkdir($target_dir, 0777, true);
}

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
/*if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}*/

// Check file size
/*if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}*/

// Allow certain file formats
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

if (is_numeric($productId)) {
  $productToModificate = new Product($_POST["ID"]);
  $oldProductCode = $productToModificate->fields["CODE"];
  $productCode = $product->generateNewCode($_POST["FAMILY_CODE"]);
  $toInsert = "UPDATE product SET MODIFIED_TIME = NOW()";
  foreach ($_POST as $k => $v) {
    $toInsert .= ",`$k` = '$v'";
  }
  $toInsert .= ", `CODE` = '$productCode'";
  $toInsert .= " WHERE ID = " . $_POST["ID"];
  $rename = rename("../../assets/img/1/" . $oldProductCode . ".png", "../../assets/img/1/" . $productCode . ".png");
} else {
  $toInsert = "INSERT INTO product (";
  foreach ($_POST as $k => $v) {
    $toInsert .= "`$k`,";
  }
  $toInsert .= "`USER`, `CODE`, `HOST`)";
  $toInsert .= " VALUES (";
  foreach ($_POST as $v) {
    $toInsert .= "'$v',";
  }
  $toInsert .= "'$user->id', '$productCode', '$host')";
}
$product->conn()->query($toInsert);

header('Location: http://' . $_SERVER["HTTP_HOST"] . '/panel/product');
