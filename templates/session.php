<?php 
session_start();
include('connection.php');
//error_reporting(0);
$admin= $_SESSION['admin'];
$role= $_SESSION['role'];
if($admin=="")
{
echo'<script>window.location.href="index.php";</script>';
//header('location:index.php');
}
?>