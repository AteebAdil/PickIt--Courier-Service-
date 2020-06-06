<?php
session_start();
session_unset();
header("Location:mydashboard.php");
exit;
?>