<?php
session_start();
@include("../access_admin.php");
@include("../connect.php");

$h_id = $_POST["h_id"];
$specialization = $_POST["specialization"];

$query = "INSERT INTO doctors (specialization, human_id) VALUES('" . $specialization . "', " . $h_id . ")";

include("../check_query.php");
?>