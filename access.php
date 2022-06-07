<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Ви не маєте доступу! Увійдіть або зареєструйтеся!');
            document.location.href='index.php';
        </script>";
}
?>