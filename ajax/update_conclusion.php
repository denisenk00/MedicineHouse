<?php
@include("../dbaccess.php");
@include("../access_doctor.php");
@include("../connect.php");
$conclusion_id = $_POST["conclusion_id"];
$conclusion = $_POST["conclusion"];
$symptoms = $_POST["symptoms"];
$recommendations = $_POST["recommendations"];

$d_email = $_SESSION["login"];

$query = "SELECT d.doctor_id FROM doctors d JOIN humans h ON (h.human_id = d.human_id) WHERE h.email = '" . $d_email . "'";
@include("../check_query.php");
$row = mysqli_fetch_row($result);
$doctor_id = $row[0];

$query = "UPDATE conclusions 
                SET doctor_id = " . $doctor_id . ", name = '" . $conclusion . "', conclusion_date = NOW(), symptoms = '" . $symptoms . "', recommendations = '" . $recommendations . "'
                WHERE conclusion_id = " . $conclusion_id;
@include("../check_query.php");
?>