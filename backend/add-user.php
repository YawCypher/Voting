<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
if(isset($_POST['submit']))
{
	try
	{ 
	// new data
	$fullname = clean($_POST['fullname']);
	$username = clean($_POST['username']);
	$gender = clean($_POST['gender']);
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	$password = icrypt($password,'e');
	$phoneno = clean($_POST['phoneno']);
	$role = clean($_POST['role']);
	$file=$_FILES['image']['tmp_name'];
if(uname_exist($username)===false && sadmin_exist($role)===false)
	{
	$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
	$image_size= getimagesize($_FILES['image']['tmp_name']);
		if ($image_size==FALSE) {
		
			$error= "That's not an image!";
			
		}else{
			$filename = $_FILES["image"]["name"];
			$extension = getExtension($filename);
			$img_name=$username.'.'.$extension;
		move_uploaded_file($_FILES["image"]["tmp_name"],"user/" . $img_name);
		$sql="INSERT INTO  user(username,name,gender,password,contact,type,email,photo) VALUES(:username,:name,:gender,:password,:contact,:type,:email,:photo)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':username',$username,PDO::PARAM_STR);
		$query->bindParam(':name',$fullname,PDO::PARAM_INT);
		$query->bindParam(':gender',$gender,PDO::PARAM_STR);
		$query->bindParam(':password',$password,PDO::PARAM_STR);
		$query->bindParam(':contact',$phoneno,PDO::PARAM_STR);
		$query->bindParam(':type',$role,PDO::PARAM_STR);
		$query->bindParam(':email',$email,PDO::PARAM_STR);
		$query->bindParam(':photo',$img_name,PDO::PARAM_STR);
		$query->execute();
		$msg = "New User Added Successfully";
	}
	}
	}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
}
?>
<!DOCTYPE html>
<head>
<title>Current Elections</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
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
<section id="container">
<!--header start-->
<?php include('includes/topbar.php');?>
<!--header end-->
<!--sidebar start-->
<?php include('includes/sidebar.php');?>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
	<div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5 align = "center">Add user</h5>
                                                </div>
                                            </div>
												   <?php if($msg){?>
										<div class="alert alert-success left-icon-alert" role="alert">
										 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
										 </div><?php } 
										else if($error){?>
											<div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
  
                                            <div class="panel-body">

                                                <form class="form-horizontal" method="post" enctype="multipart/form-data">
												<div class="form-group">
												<label for="default" class="col-sm-3 control-label">User Name</label>
												<div class="col-sm-7">
												<input type="text" name="username" class="form-control" id="username" maxlength="45" required="required" autocomplete="off">
												</div>
												</div>												
												<div class="form-group">
												<label for="default" class="col-sm-3 control-label">Full Name</label>
												<div class="col-sm-7">
												<input type="text" name="fullname" class="form-control" id="fullname" maxlength="45" required="required" autocomplete="off">
												</div>
												</div>												
												<div class="form-group">
												<label for="default" class="col-sm-3 control-label">Email</label>
												<div class="col-sm-7">
												<input type="text" name="email" class="form-control" id="email" maxlength="60" required="required" autocomplete="off">
												</div>
												</div>	
												<div class="form-group">
												<label for="default" class="col-sm-3 control-label">Password</label>
												<div class="col-sm-7">
												<input type="password" id="Psw" title="Password" value="" name="password" placeholder="Password " class="form-control" required="">
												</div>
												</div>
												<div class="form-group">
													<label for="default" class="col-sm-3 control-label">Gender</label>
													   <div class="col-sm-7">
														 <select name="gender" class="form-control yearr" id="gender" required="required">
															<option value="">--Select Gender--</option>
															<option value= "Male">Male</option>
															<option value= "Female">Female</option>
														 </select>
														</div>	
												</div>
												<div class="form-group">
													<label for="default" class="col-sm-3 control-label">Role</label>
													   <div class="col-sm-7">
														 <select name="role" title = "User Role" class="form-control term" id="role" required="required" >
															<option value="">-- Select Role --</option>
															  <option value="Super Admin">Super Admin</option>
															  <option value="Admin">Admin</option>
														 </select>
														</div>	
												</div>
												<div class="form-group">
												<label for="default" class="col-sm-3 control-label">Contact Number</label>
												<div class="col-sm-7">
												<input type="text" name="phoneno" class="form-control" id="phoneno" maxlength="10" required="required" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" autocomplete="off">
												</div>
												</div>


												<div class="form-group">
												<label for="cvs_file" class="col-sm-3 control-label ">Profile Image</label>
												<div class="col-sm-7">
												<input type="file" name="image" id="image" title="Profile Image" class="file_input" required="required">
												</div>
												</div>

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-4 col-sm-4">
                                                          <button type="submit" name="submit" class="btn btn-primary btn-labeled pull-left" class="btn btn-primary btn-labeled"><span class="btn-label btn-label-right"><i class="fa fa-save"></i></span> Submit</button>
														  <span><button type="reset" class="btn btn-warning pull-right">Reset</button></span>
                                                        </div>
                                                    </div>
                                                </form>

                                              
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 col-md-offset-2 -->
        <!-- page end-->
        </div>
</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2019 Master80. All rights reserved | Design by <a href="http://Master80.com">Larbi'sConcept</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>

<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<script>
function passwordeyes() {
    var x = document.getElementById("Psw").type;
    if(x=="password")
      document.getElementById("Psw").type="text";
    else
      document.getElementById("Psw").type="password";
}

</script>
</body>
</html>
<?PHP } ?>