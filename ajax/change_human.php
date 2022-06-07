<?php
@include("../access.php");
@include("../dbaccess.php");
$login = $_SESSION["login"];

$f_name = $_POST["f_name"];
$s_name = $_POST["s_name"];
$phone = $_POST["phone"];
$email = $_POST["email"];

if ($login != $email && thereIsEmailOrPhone($email, '')) {
    echo json_encode(array("success" => "0"));
    exit();
}

@include("../connect.php");
$query = "UPDATE humans SET first_name = '" . $f_name . "', last_name = '" . $s_name . "', phone = '" . $phone . "', email = '" . $email . "' WHERE email = '" . $login . "'";
@include("../check_query.php");
if ($login != $email) $_SESSION["login"] = $email;
echo json_encode(array("success" => "1"));
exit();
?>
