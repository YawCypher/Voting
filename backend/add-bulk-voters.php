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
	$data=array();
$csv_file =  $_FILES['csv_file']['tmp_name'];
$type=$_FILES['csv_file']['type'];
$filename = $_FILES["csv_file"]["name"];
$extension = getExtension($filename);
if($extension != "xlsx" )
{
	echo "<script>alert('Invalid excel file (xlsx).');</script>";
}else{
			move_uploaded_file($_FILES['csv_file']['tmp_name'], 'uploads/voter_import.xlsx');
			// Importing excel sheet for bulk student uploads

			include 'simplexlsx.class.php';
			
			$xlsx = new SimpleXLSX('uploads/voter_import.xlsx');
			
			list($num_cols, $num_rows) = $xlsx->dimension();
			$f = 1;
			foreach( $xlsx->rows() as $r ) 
			{
				// Ignore the inital name row of excel file
				if ($f == 1)
				{
					$f++;
					continue;
				}
				for( $i=0; $i < $num_cols; $i++ )
				{
					if ($i == 0)	    $data['Name']			=	$r[$i];
					else if ($i == 1)	$data['indexNo']		=	$r[$i];
				}
		if(voter_exist($data['indexNo'])===false)
		{
		// insert into the database
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql="INSERT INTO  voters(Name,indexNo) VALUES(:Name,:indexNo)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':Name',$data['Name'],PDO::PARAM_STR);
		$query->bindParam(':indexNo',$data['indexNo'],PDO::PARAM_STR);
		$query->execute();
		$no=$query->rowCount();
		$msg = " voters has been uploaded successfully";
		}
			}
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
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="panel">
                                         <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5 align = "center">Add Voters</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">											
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Well done!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
										
										
										
<div class="form-group">
<div class="form-row">
<div class="col-md-6">										
<form class="form-horizontal" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="cvs_file" class="col-sm-5 control-label " title = "Choose Excel File ">Choose Excel File</label>
<div class="col-sm-5">
<input type="file" name="csv_file" id="csv_file" title = "Choose Excel File " class="file_input" required="required">
</div>
</div>
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" id="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Import Voters</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
											<div class="col-md-6">
												<div class="form-group">
												<div class="col-sm-12">
												 <a href="uploads/blank_excel_file.xlsx" target="_blank" 
												class="btn btn-info pull-right"><i class="fa fa-download"></i> Download Blank Excel File</a>
												</div>
											</div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
											<div class="panel-footer">
											
											</div>
											</div>
                                    </div>
                                    <!-- /.col-md-12 -->
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