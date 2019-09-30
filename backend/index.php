<?php
session_start();
include('includes/config.php');
$year=date('Y');
if(isset($_POST['login']))
{
// To check if details provided are valid.
$uname=$_POST['username'];
$password= icrypt($_POST['password'],'e');
$sql ="SELECT username,password FROM user WHERE username=:uname and password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']= icrypt($_POST['username'],'e');
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
    // message in response to invalid details provided
    echo "<script>alert('Invalid Details');</script>";

}

}

?>
<!DOCTYPE html>
<head>
<title>E | VOTING</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style1.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<div class="log-w3">
<center><font style=" font:bold 50px 'Aleo'; text-shadow:1px 1px 15px #000; color:#fff;"><?php echo htmlentities('ONLINE VOTING SYSTEM'); ?></font></center>
<div class="w3layouts-main">
	<h2></h2>
	<h2>Admin Login</h2>
		<form action="" method="post">
			<input type="text" autofocus class="ggg" name="username" placeholder="Username" required="">
			<input type="password" class="ggg" name="password" placeholder="Password" required="">

				<div class="clearfix"></div>
				<input type="submit" value="Login" name="login">
		</form>
</div>
</div>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
