<?php
@include("../access.php");
$login = $_SESSION["login"];
$pass = password_hash($_POST["new_pass"], PASSWORD_BCRYPT);

@include("../connect.php");
$query = "UPDATE humans SET password = '" . $pass . "' WHERE email = '" . $login . "'";
@include("../check_query.php");
?>
