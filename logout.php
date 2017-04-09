<?php
error_reporting(E_WARNING);
session_start();
session_destroy();
header("Location: login.php");
?>