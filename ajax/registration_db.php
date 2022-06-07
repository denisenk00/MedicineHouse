<?php
@include("../dbaccess.php");
session_start();
header('Content-Type: application/json');

$pass = $_POST["pass"];
$s_name = $_POST["s_name"];
$f_name = $_POST["f_name"];
$phone = $_POST["phone"];
$email = $_POST["email"];

if (!thereIsEmailOrPhone($email, $phone)) {
    $pass = password_hash($pass, PASSWORD_BCRYPT);
    include("../connect.php");
    $query = "INSERT INTO humans (first_name, last_name, email, phone, password) VALUES('" . $f_name . "','" . $s_name . "', '" . $email . "', '" . $phone . "', '" . $pass . "')";
    include("../check_query.php");
    $_SESSION["login"] = $email;
    echo json_encode(array("success" => "1"));
} else {
    echo json_encode(array("success" => "0"));
}
exit();
?>