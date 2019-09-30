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
	// new data
	$indexno = intval(icrypt($_GET['id'],'d'));
	$file=$_FILES['image']['tmp_name'];
	$v=0;
	$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
	$image_size= getimagesize($_FILES['image']['tmp_name']);
		if ($image_size==FALSE) {
		
			$error= "That's not an image!";
			
		}else{
			$filename = $_FILES["image"]["name"];
			$extension = getExtension($filename);
			$img_name=$indexno.'.'.$extension;
		move_uploaded_file($_FILES["image"]["tmp_name"],"can/" . $img_name);
		$sql="update tblcandidate set photo = :photo where indexNo=:stid ";
		$query = $dbh->prepare($sql);
		$query->bindParam(':photo',$img_name,PDO::PARAM_STR);
		$query->bindParam(':stid',$indexno,PDO::PARAM_STR);
		$query->execute();
		$msg = "Profile Picture Updated Successfully";
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
                                                    <h5 align = "center">Edit Photo</h5>
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
									<?php
									$id=intval(icrypt($_GET['id'],'d'));
									$results = $dbh->prepare("SELECT `Name`,indexNo,gender,PositionID,ballotNo,photo,positionName FROM tblcandidate INNER JOIN tblposition ON PositionID = id WHERE indexNo= :userid");
									$results->bindParam(':userid', $id);
									$results->execute();
									for($i=0; $result = $results->fetch(); $i++){
										$photo = $result['photo'];
									?>
  
                                            <div class="panel-body">

                                                <form class="form-horizontal" method="post" enctype="multipart/form-data">
												
									<table>
									<tr>
									<td rowspan="3">
									<div class="col-xs-4">
									  <img src="can/<?php echo htmlentities($photo);?>" alt="<?php echo htmlentities($result['Name']);?>" class="img-rounded" id="test" class="media-object" style="width: auto; height: 200px; border: 1%;">
									</div>
									</td>
									<td>
									<font style=" font:bold 22px 'Aleo'; color:green;">Full Name :</font>	
									</td>
									<td>
										<font style=" font:italic 25px 'Aleo'; text-shadow:1px 1px 15px #000; color:#2AB24D;"><?php echo htmlentities($result['Name']); ?></font>
									</td>
									</tr>
									<tr>
									<td>
									<font style=" font:bold 22px 'Aleo'; color:green;">Position :</font>
									</td>
									<td>
										<font style=" font:italic 25px 'Aleo'; text-shadow:1px 1px 15px #000; color:#2AB24D;"><?php echo htmlentities($result['positionName']); ?></font>
									</td>
									</tr>
									<tr>
									<td>
									<font style=" font:bold 22px 'Aleo'; color:green;">Ballot Number :</font>
									</td>
									<td>
										<div class="col-sm-2">
										<font style=" font:italic 25px 'Aleo'; text-shadow:1px 1px 15px #000; color:#2AB24D;"><?php echo htmlentities($result['ballotNo']); ?></font>
										</div>
									</td>
									</tr>	
									</table>
												<div class="form-group">
												<label for="cvs_file" class="col-sm-3 control-label ">Profile Image</label>
												<div class="col-sm-8">
												<input type="file" name="image" id="test" onchange="readURL(this);" title="Profile Image" class="file_input" required="required">
												</div>
												</div>
									<?php
									}
									?>
                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-4 col-sm-5">
                                                          <button type="submit" name="submit" class="btn btn-primary btn-labeled pull-right" class="btn btn-primary btn-labeled"><span class="btn-label btn-label-right"><i class="fa fa-save"></i></span> Submit</button>
														  <a href="manage-candidate.php" class="btn btn-warning btn-labeled pull-left"><span class="btn-label btn-label-right"><i class="fa fa-arrow-left"></i></span> Back </a>
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