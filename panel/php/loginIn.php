<?php
include_once("../../application/config/database.php");

session_start();
if ($_POST["user"] && $_POST["psswd"]) {

    $user = $_POST["user"];
    $psswd = $_POST["psswd"];

    $sql = "SELECT * FROM user WHERE `LOGIN` = '$user'";
    $data = $conn->query($sql);

    foreach ($data as $row) {
        $userId = $row["ID"];
        $sqlUser = $row["LOGIN"];
        $sqlPsswd = $row["PSSWD"];
    }

    if ($data->num_rows > 0 && $user == $sqlUser && password_verify($psswd, trim($sqlPsswd))) {
        $_SESSION['user_id'] = $userId;
        header('Location: ' . "../");
    } else {
        header('Location: ' . "../login.php?error=login");
    }
}