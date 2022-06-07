<?php
@include("../dbaccess.php");
@include("../access_doctor.php");
@include("../connect.php");
$conclusion_id = $_POST["conclusion_id"];

$query = "DELETE FROM conclusions WHERE conclusion_id = " . $conclusion_id;
@include("../check_query.php");
?>
