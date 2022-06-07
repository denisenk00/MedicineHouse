<?php
session_start();
$result = $mysqli->query($query);
if (!$result) {
    echo "Error query!";
    return;
}
?>