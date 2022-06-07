<?php
@include("../dbaccess.php");
@include("../access_doctor.php");
@include("../connect.php");

$human_id = $_POST["h_id"];
$sex = $_POST["sex"];
$birth_date = $_POST["birth_date"];

$query = "INSERT INTO patients (human_id, sex, birth_date) VALUES(" . $human_id . ", '" . $sex . "', STR_TO_DATE('" . $birth_date . "', '%m/%d/%Y'))";
@include("../check_query.php");
?>
