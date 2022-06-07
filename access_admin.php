<?php
session_start();
include("access.php");
$login = $_SESSION["login"];

if ($login != "SYSADM") {
    echo "<script>
            alert('Ви не маєте доступу до цієї опції!');
            document.location.href='index.php';
        </script>";
}
?>