<?php
session_start();
error_reporting(0);
include('templates/connection.php');
include('templates/functions.php');

if($_SESSION['admin']!="")
{
echo'<script>window.location.href="dashboard.php";</script>';
exit();
}


extract($_POST);
if(isset($email) && ($email != '') && isset($password) && ($password != '')&& ($role != '')){
	$sql= mysqli_query($conn,"SELECT * FROM admin WHERE username = '".make_safe($email)."' and password = '".encryptIt(make_safe($password))."' and role = '".make_safe($role)."'");
	$row=mysqli_num_rows($sql);
	$row1= mysqli_fetch_array($sql);
	if($row)
	{	
		$_SESSION['admin']=$email;
		$_SESSION['role']=$role;
		date_default_timezone_set('Asia/Calcutta');
		$ldate = date('Y-m-d');
		$ltime = date('h:i sa');
		echo'<script>window.location.href="dashboard.php";</script>';
		die();
	}
	else
	{
		echo'<script>alert("Wrong Email or Password!");window.location.href="index.php";</script>';
	}
}
?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2019-04-04 16:55:45 +0200 -->
    <title>Cloudcoco</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
    <!-- Datatables Plugin -->
    <script src="./assets/plugins/datatables/plugin.js"></script>
  </head>
  <body class="" style="background-image: url('assets/images/coconut.jpg');background-repeat: no-repeat;">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
               Cloudcoco
              </div>
              <form class="card" method="post">
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <div class="form-group">
                    <label class="form-label">User Name</label>
                    <input type="text" name="email" class="form-control"  placeholder="Enter Username" required>
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                   </label>
                    <input type="password" class="form-control" name="password"  placeholder="Password">
                  </div>
                  <input type="hidden" name="role" value="Admin" class="form-control"  required>
                  <div class="form-footer">
                    <button type="submit"  name="login" class="btn btn-primary btn-block">Sign in</button>
                  </div>
                </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>