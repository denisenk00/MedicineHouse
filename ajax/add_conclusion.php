<?php
session_start();
@include("../dbaccess.php");
@include("../access_doctor.php");

$patient_id = $_POST["patient_id"];
$conclusion = $_POST["conclusion"];
$symptoms = $_POST["symptoms"];
$recommendations = $_POST["recommendations"];
$d_email = $_SESSION["login"];

@include("../connect.php");
$query = "SELECT d.doctor_id FROM doctors d JOIN humans h ON (h.human_id = d.human_id) WHERE h.email = '" . $d_email . "'";
@include("../check_query.php");
$row = mysqli_fetch_row($result);
$doctor_id = $row[0];

$query = "INSERT INTO conclusions (patient_id, doctor_id, name, conclusion_date, symptoms, recommendations)
            VALUES(" . $patient_id . ", " . $doctor_id . ", '" . $conclusion . "', NOW(), '" . $symptoms . "', '" . $recommendations . "')";
@include("../check_query.php");

?>


