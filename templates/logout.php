<?php 
session_start();
include('connection.php');

date_default_timezone_set('Asia/Calcutta');
$ldate = date('Y-m-d');
$ltime = date('h:i sa');

unset($_SESSION['admin']);
unset($_SESSION['role']);

session_unset();
session_destroy();

echo'<script>window.location.href="../index.php";</script>';
//header('location:../index.php');
?>