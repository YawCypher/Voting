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
		$indexNo = clean($_POST['indexno']);
		$Name = clean($_POST['votername']);
		$voted = 0;
		if(voter_exist($indexNo)===false)
		{
			insert_voter($indexNo,$Name,$voted);
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
                                    <div class="col-md-9 col-md-offset-1">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Fill the Voter Info</h5>
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
			<div class="vali-form-group">
			<div class="col-md-6 control-label">
              <label class="control-label">Voter Name*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <input type="text" name="votername" title="Voter Name" value="" class="form-control" autocomplete="off" placeholder="voter Name" required="">
              </div>
            </div>
			<div class="clearfix"> </div>
            </div>
		<div class="vali-form-group">
            <div class="col-md-6 control-label">
              <label class="control-label">Matric Number*</label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <input type="text" name="indexno" title="Matric Number" value="" autocomplete="off" class="form-control" placeholder="Index Number" min="10" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="">
              </div>
            </div>
			<div class="clearfix"> </div>
            </div>
			<div class="vali-form-group">

															<div class="iput-group">
														  <button type="submit" name="submit" class="btn btn-primary btn-labeled" class="btn btn-primary btn-labeled"><span class="btn-label btn-label-right"><i class="fa fa-save"></i></span> Submit</button>
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
			  <p>© 2019 Master 80. All rights reserved | Design by <a href="http://master80.com">Larbi'sConcept</a></p>
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