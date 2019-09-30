<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
	$stid = intval(icrypt($_GET['stid'],'d'));
if(isset($_POST['submit']))
{
	try
	{ 
	// new data
	$fullanme = clean($_POST['fullanme']);
	$indexno = clean($_POST['indexno']);
	$gender = clean($_POST['gender']);
	$posintion = clean($_POST['posintion']);
	$ballot = clean($_POST['ballot']);
	$phoneno = clean($_POST['phoneno']);
		$sql="update tblcandidate set Name=:fullanme,gender=:gender,PositionID=:posintion,ballotNo=:ballot,contactNo=:phoneno where indexNo=:stid ";
		$query = $dbh->prepare($sql);
		$query->bindParam(':fullanme',$fullanme,PDO::PARAM_STR);
		$query->bindParam(':gender',$gender,PDO::PARAM_STR);
		$query->bindParam(':posintion',$posintion,PDO::PARAM_STR);
		$query->bindParam(':ballot',$ballot,PDO::PARAM_STR);
		$query->bindParam(':phoneno',$phoneno,PDO::PARAM_STR);
		$query->bindParam(':stid',$stid,PDO::PARAM_STR);
		$query->execute();

$msg="Candidate info updated successfully";
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
<script type="text/javascript">
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#test').attr('src', e.target.result);
       }
        reader.readAsDataURL(input.files[0]);
       }
    }
</script>
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
                                                    <h5 align = "center">Edit User</h5>
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
												<?php 
$stid = intval(icrypt($_GET['stid'],'d'));
$sql = "SELECT id,username,`name`, contact, type, gender, `password`, email FROM `user` WHERE id =:stid";
$query = $dbh->prepare($sql);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{  ?>
												<div class="form-group">
												<label for="default" class="col-sm-3 control-label">Full Name</label>
												<div class="col-sm-7">
												<input type="text" name="fullanme" value="<?php echo htmlentities($row->name); ?>" class="form-control" id="fullanme" maxlength="45" required="required" autocomplete="off">
												</div>
												</div>												
												<div class="form-group">
												<label for="default" class="col-sm-3 control-label">User Name</label>
												<div class="col-sm-7">
												<input type="text" name="username" value="<?php echo htmlentities($row->username); ?>" class="form-control" id="indexno" maxlength="15" required="required" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" autocomplete="off" readonly>
												</div>
												</div>
												<div class="form-group">
													<label for="default" class="col-sm-3 control-label">Gender</label>
													   <div class="col-sm-7">
														 <select name="gender" class="form-control yearr" id="gender" required="required">
															<option value="<?php echo htmlentities($row->gender); ?>"><?php echo htmlentities($row->gender); ?></option>
															<option value= "Male">Male</option>
															<option value= "Female">Female</option>
														 </select>
														</div>	
												</div>
												
												
												 <div class="form-group">
												<label for="default" class="col-sm-3 control-label">Role</label>
												 <div class="col-sm-7">
												 <select name="role" class="form-control clid" id="role" required="required">
												<option value="<?php echo htmlentities($row->type); ?>"><?php echo htmlentities($row->type); ?></option>
												<option value="Super Admin">Super Admin</option>
												<option value="Admin">Admin</option>
												 </select>
												</div>
												</div>
												<div class="form-group">
												<label for="default" class="col-sm-3 control-label">Contact Number</label>
												<div class="col-sm-7">
												<input type="text" name="phoneno" value="<?php echo htmlentities($row->contact); ?>" class="form-control" id="phoneno" maxlength="10" required="required" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" autocomplete="off">
												</div>
												</div>
												<div class="form-group">
												<label for="default" class="col-sm-3 control-label">Password</label>
												<div class="col-sm-7">
												<input type="password" name="password" value="<?php echo htmlentities(icrypt($row->password,'d')); ?>" class="form-control" id="password" maxlength="30" required="required" autocomplete="off">
												</div>
												</div>	
												<div class="form-group">
												<label for="default" class="col-sm-3 control-label">Email</label>
												<div class="col-sm-7">
												<input type="text" name="email" value="<?php echo htmlentities($row->email); ?>" class="form-control" id="email" maxlength="30" required="required" autocomplete="off">
												</div>
												</div>
<?php }} ?>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-4 col-sm-4">
                                                          <button type="submit" name="submit" class="btn btn-primary btn-labeled pull-left" class="btn btn-primary btn-labeled">Submit<span class="btn-label btn-label-right"><i class="fa fa-save"></i></span></button>
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