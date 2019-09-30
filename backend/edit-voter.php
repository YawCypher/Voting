<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/configpdo.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{ 	
	$stid = intval(icrypt($_GET['vid'],'d'));
if(isset($_POST['submit']))
{
		$indexNo = clean($_POST['indexno']);
		$Name = clean($_POST['votername']);
		$sql="update voters set indexNo=:indexno,Name=:votername where indexNo=:stid ";
		$query = $dbh->prepare($sql);
		$query->bindParam(':indexno',$indexNo,PDO::PARAM_STR);
		$query->bindParam(':votername',$Name,PDO::PARAM_STR);
		$query->bindParam(':stid',$stid,PDO::PARAM_STR);
		$query->execute();

$msg="Voter info updated successfully";
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
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Veiw the Voter Info</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
		<?php if($msg){?>
			<div class="alert alert-success left-icon-alert" role="alert">
				<strong>Well done!</strong><?php echo htmlentities($msg); ?>
			</div><?php } 
		else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
		<strong>Oh Sorry!</strong> <?php echo htmlentities($error); ?>
    </div>
                                        <?php } ?>
<form class="form-horizontal" method="post">
<?php 
$stid = intval(icrypt($_GET['vid'],'d'));
$sql = "SELECT indexNo,Name,`Password`, yearLvl, contactNo FROM `voters` WHERE indexNo =:stid";
$query = $dbh->prepare($sql);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{}}
?>
			<div class="vali-form-group">
			<div class="col-md-6 control-label">
              <label class="control-label">Voter Name*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <input type="text" name="votername" title="Voter Name" value="<?php echo htmlentities($row->Name); ?>" class="form-control" placeholder="voter Name" required="">
              </div>
            </div>
			<div class="clearfix"> </div>
            </div>
		<div class="vali-form-group">
            <div class="col-md-6 control-label">
              <label class="control-label">Index Number*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <input type="text" name="indexno" title="Index Number" value="<?php echo htmlentities($row->indexNo); ?>" class="form-control" placeholder="Index Number" min="10" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="">
              </div>
            </div>
			<div class="clearfix"> </div>
            </div>
			<div class="iput-group">
		  <button type="submit" name="submit" class="btn btn-primary btn-labeled" class="btn btn-primary btn-labeled"><span class="btn-label btn-label-right"><i class="fa fa-save"></i></span> Update</button>
		  <button type="reset" class="btn btn-default">Reset</button>
		</div>
            </div>
                                                </form>

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