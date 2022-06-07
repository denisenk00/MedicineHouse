<?php
@include("../dbaccess.php");
session_start();
header('Content-Type: application/json');

$login = $_POST["login"];
$pass = $_POST["pass"];

if(checkCredentials($login, $pass)) {
    $_SESSION["login"] = $login;
    echo json_encode(array("success" => "1"));
} else {
    echo json_encode(array("success" => "0"));
}
exit();
?>
