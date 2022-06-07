<?php
function isDoctor($login): bool
{
    @include("connect.php");
    $query = "SELECT d.doctor_id 
                FROM doctors d
                        JOIN humans h ON (h.human_id = d.human_id)
                WHERE h.email = '" . $login . "'";
    @include("check_query.php");
    $row = mysqli_fetch_row($result);
    if ($row == null) return false;
    else return true;
}

function getHuman($login)
{
    @include("connect.php");
    $query = "SELECT first_name, last_name, email, phone FROM humans WHERE email = '" . $login . "'";
    include("check_query.php");
    return mysqli_fetch_row($result);
}

function getConclusion($id)
{
    @include("connect.php");
    $query = "SELECT * FROM conclusions WHERE conclusion_id = " . $id;
    @include("check_query.php");
    return mysqli_fetch_row($result);
}

function getHumanByPatientId($patient_id)
{
    @include("connect.php");
    $query = "SELECT h.* FROM humans h JOIN patients p ON(h.human_id = p.human_id AND p.patient_id = " . $patient_id . ")";
    @include("check_query.php");
    return mysqli_fetch_row($result);
}


function getConclusionsToMedcard($login)
{
    include("connect.php");
    $query = "SELECT c.name, c.conclusion_date, CONCAT(hd.last_name, ' ', hd.first_name) as doctor_name, c.symptoms, c.recommendations
                    FROM conclusions c
                        JOIN patients p ON(c.patient_id = p.patient_id)
                        JOIN humans hp ON(p.human_id = hp.human_id AND email = '$login')
                        JOIN doctors d ON(c.doctor_id = d.doctor_id)
                        JOIN humans hd ON(hd.human_id = d.human_id)";
    @include("check_query.php");
    return $result;
}

function getHumansNoDoctors($my_login)
{
    include("connect.php");
    $query = "SELECT CONCAT(h.first_name, ' ',  h.last_name , ' ', h.email), h.human_id
            FROM humans h
                LEFT JOIN doctors d ON(h.human_id = d.human_id)
            WHERE d.human_id IS NULL AND h.email != '" . $my_login . "'";
    include("check_query.php");
    return $result;
}

function getHumansNoPatients($my_login)
{
    include("connect.php");
    $query = "SELECT CONCAT(h.first_name, ' ', h.last_name, ' ', h.email), h.human_id
            FROM humans h
                LEFT JOIN patients d ON(h.human_id = d.human_id)
            WHERE d.human_id IS NULL AND h.email != '" . $my_login . "'";
    include("check_query.php");
    return $result;
}

function getPatientsCountWithoutMe($my_email): array
{
    @include("connect.php");
    $query = "SELECT COUNT(*) FROM humans h JOIN patients p ON (h.human_id = p.human_id) WHERE h.email != '" . $my_email . "'";
    @include("check_query.php");
    return mysqli_fetch_row($result);
}

function getPatientsInfoWithoutMe($my_email, $limit, $offset)
{
    @include("connect.php");
    $query = "SELECT * FROM (SELECT p.patient_id, h.last_name, h.first_name, h.phone, p.birth_date, p.sex  
                    FROM humans h JOIN patients p ON (h.human_id = p.human_id) 
                    WHERE h.email != '" . $my_email . "'
                    ORDER BY 2, 3, 5) a
                    LIMIT " . $limit . " OFFSET " . $offset;
    @include("check_query.php");
    return $result;
}

function getConclusionsCountByPatientId($patient_id)
{
    @include("connect.php");
    $query = "SELECT COUNT(*)
                    FROM conclusions c
                    WHERE c.patient_id = " . $patient_id;
    @include("check_query.php");
    return mysqli_fetch_row($result);
}

function getConclusionsByPatientId($patient_id, $limit, $offset)
{
    @include("connect.php");
    $query = "SELECT * FROM (SELECT c.conclusion_id, c.name, c.conclusion_date, CONCAT(h.first_name, ' ', h.last_name) doctor
                                FROM conclusions c
                                    JOIN doctors d ON(c.doctor_id = d.doctor_id)
                                    JOIN humans h ON(h.human_id = d.human_id)
                                WHERE c.patient_id = " . $patient_id . "
                                ORDER BY 3 DESC) a
                    LIMIT " . $limit . " OFFSET " . $offset;
    @include("check_query.php");
    return $result;
}

function thereIsEmailOrPhone($email, $phone): bool
{
    @include("connect.php");
    $query = "SELECT * FROM humans WHERE email = '" . $email . "' OR phone = '" . $phone . "'";
    @include("check_query.php");
    $row = mysqli_fetch_row($result);
    if ($row == null) return false;
    else return true;
}

function checkCredentials($email, $password): bool
{
    @include("connect.php");
    $query = "SELECT password FROM humans WHERE email = '" . $email . "'";
    @include("check_query.php");
    $row = mysqli_fetch_row($result);
    if ($row != null && password_verify($password, $row[0])) return true;
    else return false;
}

?>
