<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    elseif(votingEnd()===false)
{
	echo "<script>alert('Please Close the Voting First');</script>";
	echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
}elseif(votingEnd()===true)
{
		$positionID=intval($_GET['c']);
		$TotalPositions = sizeof(getpos());

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
<?php include('topbar.php');?>
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
			  <?php
	 $position = getfinalpos()[$positionID];
 ?>
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <center><font style=" font:bold 22px 'Aleo'; color:#0581CD;"><?php echo htmlentities(posname($position)); ?></font></center>
                        </div>
					<div class="panel-body">
						<?php  
						$sum = canPerpos($position);
								if($sum==1){
									$results = $dbh->prepare("SELECT `Name`, ballotNo, photo, votes FROM tblcandidate WHERE PositionID = :userid LIMIT 1");
									$results->bindParam(':userid', $position);
									$results->execute();
									for($i=0; $result = $results->fetch(); $i++){											
						?>
						<center>
                         <div class="col-md-12">
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities($result['photo']); ?>" alt=" <?php echo htmlentities($result['Name']); ?>" class="img-rounded" class="media-object" style="width: auto; height: 180px; border: 1%;">
                                <h4 class="title"><?php echo htmlentities($result['Name']); ?></h4>
							<div class="col-md-9 col-md-offset-2">
							<table>
							<tr>
							<td>
							<font style=" font:bold 20px 'Aleo'; color:#000000;"><?php echo htmlentities('Yes : '.$result['votes']);?></font>
							</td>
							<td>
							<font style=" font:bold 20px 'Aleo'; color:red;"><?php echo htmlentities('No : '.no($position));?></font>
							</td>
							</tr>
							<tr>
							<td>
							<font style=" font:bold 20px 'Aleo'; color:#000000;"><?php echo htmlentities("Percentage : ".YesNoPercent($result['votes'],$position)."%");?></font>
							
							</td>
							<td>
							<font style=" font:bold 20px 'Aleo'; color:red;"><?php echo htmlentities("Percentage : ".YesNoPercent(no($position),$position)."%");?></font>
							</td>
							</tr>
							</table>
							</div> 
							</div> 
                            </div> 
							</center>
								<?php
								}
								}elseif($sum==2){
									$results = $dbh->prepare("SELECT `Name`, ballotNo, photo, votes FROM tblcandidate WHERE PositionID = :userid ORDER BY ballotNo ASC");
									$results->bindParam(':userid', $position);
									$results->execute();
									?>
									<center>
							<div class="form-group">
							<div class="form-row">
							<?php for($i=0; $result = $results->fetch(); $i++){ ?>
							<div class="col-md-6">
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities($result['photo']); ?>" alt="<?php echo htmlentities($result['Name']); ?>" class="img-rounded profile-img" style="width: auto; height: 200px; border: 1%;">
                                <h4 class="title"><?php echo htmlentities($result['Name']); ?></h4>
                                <small class="info"><font style=" font:bold 20px 'Aleo'; color:#000000;"><?php echo htmlentities('Votes : '.$result['votes']); ?></font></small><br>
                                <small class="info"><font style=" font:bold 20px 'Aleo'; color:#000000;"><?php echo htmlentities('Percentage : '.VotesPercent($result['votes'],$position)."%"); ?></font></small>
                            </div> 
                            </div>
							<?php } ?>
							</div>
							</div>
							</center>
							<?php }elseif($sum==3){
									$results = $dbh->prepare("SELECT `Name`, ballotNo, photo, votes FROM tblcandidate WHERE PositionID = :userid ORDER BY ballotNo ASC");
									$results->bindParam(':userid', $position);
									$results->execute();
									?>
									<center>
							<div class="form-group">
							<div class="form-row">
							<?php for($i=0; $result = $results->fetch(); $i++){ ?>
							<div class="col-md-4">
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities($result['photo']); ?>" alt="<?php echo htmlentities($result['Name']); ?>" class="img-rounded profile-img" style="width: 150px; height: 200px; border: 1%;">
                                <h5 class="title"><?php echo htmlentities($result['Name']); ?></h5>
                                <small class="info"><font style=" font:bold 20px 'Aleo'; color:#000000;"><?php echo htmlentities('Votes : '.$result['votes']); ?></font></small><br>
                                <small class="info"><font style=" font:bold 20px 'Aleo'; color:#000000;"><?php echo htmlentities('Percentage : '.VotesPercent($result['votes'],$position)."%"); ?></font></small>
                            </div> 
                            </div>
							<?php } ?>
							</div>
							</div>
							</center>
							<?php }elseif($sum>=4){
									$results = $dbh->prepare("SELECT `Name`, ballotNo, photo, votes FROM tblcandidate WHERE PositionID = :userid ORDER BY ballotNo ASC");
									$results->bindParam(':userid', $position);
									$results->execute();
									?>
							<div class="form-group">
							<div class="form-row">
							<?php for($i=0; $result = $results->fetch(); $i++){ ?>
							<div class="col-md-3">
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities($result['photo']); ?>" alt="<?php echo htmlentities($result['Name']); ?>" class="img-rounded profile-img" style="width: 90px; height: 100px; border: 1%;">
                                <h5 class="title"><?php echo htmlentities($result['Name']); ?></h5>
                                <small class="info"><font style=" font:bold 17px 'Aleo'; color:#000000;"><?php echo htmlentities('Votes : '.$result['votes']); ?></font></small><br>
                                <small class="info"><font style=" font:bold 17px 'Aleo'; color:#000000;"><?php echo htmlentities('Percentage : '.VotesPercent($result['votes'],$position)."%"); ?></font></small>
                            </div> 
                            </div>
							<?php } ?>
							</div>
							</div>
							<?php } ?>
                    </div>
                        <div class="panel-footer">
					<?php if($positionID != 0)
					{
					?>
					<a href="result.php?c=<?php echo htmlentities($positionID - 1); ?>" class="btn btn-sm btn-danger btn-labeled pull-left"><span class="btn-label btn-label-left"><i class="fa fa-arrow-left"></i></span> Previous </a>
					<?php } ?>
					<?php if($positionID != ($TotalPositions - 1))
					{
					?>
					<a href="result.php?c=<?php echo htmlentities($positionID + 1); ?>" class="btn btn-sm btn-info btn-labeled pull-right"> Next <span class="btn-label btn-label-right"><i class="fa fa-arrow-right"></i></span> </a>
					<?php } ?>
						<font style=" font:bold 25px 'Aleo'; color:#ED8019;"><center><?php echo htmlentities('No. of skipped Votes : '.skipped($position)); ?></center></font>
						</div>
                    </div>
                </div>
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