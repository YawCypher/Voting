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
		$indexno = clean($_POST['indexno']);
	if(voter_exist($indexno)===true)
		{
			$name = name($indexno);
			$activate = activate($indexno);
			if($activate==0){
			$password = 1;
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql2 = "UPDATE voters SET activate = :password WHERE indexNo = :indexno";
			$query = $dbh->prepare($sql2);
			$query->bindParam(':password',$password,PDO::PARAM_STR);
			$query->bindParam(':indexno',$indexno,PDO::PARAM_STR);
			$query->execute();
			$password = icrypt($password,'d');
			$voter = $name."'s Matric Number Activated";
			$msg = $voter;
			}elseif($activate==1){
			$voter = $name."'s Matric Number Activated";
			$msg = $voter;				
			}
		}else{
			$error = "Index Number Entered does not exist in the system";
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
					<h4 align = "center">..</h4>
					<h4 align = "center">Activate Matric Number</h4>
				</div>
			</div>
<?php if($msg){?>
<div class="alert alert-info left-icon-alert" role="alert">
<h2><center><?php echo htmlentities( $msg); ?></center>
</h2>
</div><?php } 
else if($error){?>
<div class="alert alert-danger left-icon-alert" role="alert">
<strong>Oh sorry ! </strong> <?php echo htmlentities($error); ?>
</div>
<?php } ?>

			<div class="panel-body">
				<form method="post">
						<div class="vali-form-group">
						<div class="col-md-10 control-label">
						  <label class="control-label">Matric Number*</label>
						  <div class="input-group">             
							  <span class="input-group-addon">
						  <i class="fa fa-user" aria-hidden="true"></i>
						  </span>
						  <input type="text" name="indexno" title="Matric Number" value="" autocomplete="off" class="form-control" placeholder="Matric Number" min="10" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="">
						  </div>
						</div>
						<div class="clearfix"> </div>
						</div>
					<div class="form-group has-success">
						<div class="col-sm-offset-3 col-sm-4">
						   <button type="submit" name="submit" class="btn btn-success btn-labeled btn-lg pull-right"><span class="btn-label btn-label-right"><i class="fa fa-unlock"></i></span> Activate</button>
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
	<script>
		function printre(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
	</script>
<script>
		(function (global) { 
    if(typeof (global) === "undefined") {
        throw new Error("window is undefined");
    }
    var _hash = "!";
    var noBackPlease = function () {
        global.location.href += "#";
        // making sure we have the fruit available for juice (^__^)
        global.setTimeout(function () {
            global.location.href += "!";
        }, 50);
    };
    global.onhashchange = function () {
        if (global.location.hash !== _hash) {
            global.location.hash = _hash;
        }
    };
    global.onload = function () {            
        noBackPlease();
        // disables backspace on page except on input fields and textarea..
        document.body.onkeydown = function (e) {
            var elm = e.target.nodeName.toLowerCase();
            if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                e.preventDefault();
            }
            // stopping event bubbling up the DOM tree..
            e.stopPropagation();
        };          
    }

})(window);		
</script>
</body>
</html>
<?PHP } ?>