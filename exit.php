<?php
session_start();
session_destroy();
echo '<META HTTP-EQUIV="Refresh" CONTENT="0.1; URL=' . '../index.php' . '">';
exit;
?>