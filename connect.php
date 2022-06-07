<?php
session_start();
$mysqli = new mysqli("localhost", "root", "root", "medhouse");
if (!$mysqli) {
    echo "Error connection!";
    return;
}

?>