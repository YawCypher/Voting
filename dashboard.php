<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['voter'])=="")
    {   
    header("Location: index.php"); 
    }
    elseif(voted(icrypt($_SESSION['voter'],'d'))===true){
		echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
	}else{
		$v = icrypt($_SESSION['voter'],'d');
		$donevoting = sizeof(getpos());
		$c_pos = currentpos($v);
		$poiden = getpos()[$c_pos];
		$sum = canPerpos($poiden);
		$name=name($v);
?>
<!DOCTYPE html>
<head>
<title>E | VOTING</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php  
	if($c_pos==$donevoting)
	{?>
<meta http-equiv="refresh" content="5;url=submitvote.php?kasuli=<?php echo htmlentities(icrypt($v,'e'));?>">
<?php
	}
	?>
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



<?php include('topbar.php');?> 
<!--main content start-->

	<section class="wrapper">
            <!-- page start-->
            <div class="row">
				<div class="col-md-6">
					<section class="panel panel-primary">
						<div class="panel-heading">
							<div class="panel-title">
							<h6 align = "center">..</h6>
								<h5 align = "center"><font style=" font:bold 22px 'Aleo'; text-shadow:1px 1px 15px #000; color:#fff;"><?php echo htmlentities(posname($poiden)); ?></font></h5>
							</div>
						</div> 
						<div class="panel-body">
							<?php  
							if($c_pos==$donevoting)
							{
								$msg = "Please submit your voting now";
							?>
						<?php if($msg){?>
						<div class="alert alert-info left-icon-alert" role="alert">
						<strong>Well done! </strong><?php echo htmlentities($msg); ?>
						</div><?php } 
						else if($error){?>
						<div class="alert alert-danger left-icon-alert" role="alert">
						<strong>Oh Sorry!</strong> <?php echo htmlentities($error); ?>
						</div>
						<?php } 
							}else{
								if($sum==1){
									$results = $dbh->prepare("SELECT `Name`,indexNo,ballotNo,photo,positionName FROM tblcandidate INNER JOIN tblposition ON PositionID = id WHERE PositionID= :userid");
									$results->bindParam(':userid', $poiden);
									$results->execute();
									for($i=0; $result = $results->fetch(); $i++){											
						?>
				
				<form method="post" action = "submit.php"> 
				<div class="form-group">
					<div class="col-md-offset-4 col-md-6">

				  <img src="backend/can/<?php echo htmlentities($result['photo']); ?>" alt="<?php echo htmlentities($result['Name']);?>" class="img-rounded" class="media-object" style="width: auto; height: 250px; border: 10%;">
				

				</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-7">
					<font style=" font:bold 20px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities($result['Name']); ?></center></font>
					</div>
					<input type="hidden" name="indexno" value="<?php echo htmlentities($result['indexNo']); ?>" />
					<input type="hidden" name="sinpid" value="<?php echo htmlentities($poiden); ?>" />
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-5">
				<button type="submit" name="yes" class="btn btn-success btn-labeled pull-left" class="btn btn-success btn-labeled"><span class="btn-label btn-label-right"><i class="fa fa-thumbs-up"></i></span> Yes</i></span></button>
				<button type="submit" name="no" class="btn btn-danger btn-labeled pull-right" class="btn btn-danger btn-labeled"><span class="btn-label btn-label-right"><i class="fa fa-thumbs-down"></i></span> No</button>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" name="Sskip" class="btn btn-info btn-labeled pull-right" class="btn btn-success btn-labeled">Skip<span class="btn-label btn-label-right"><i class="	fa fa-sign-out"></i></span></button>
					</div>
				</div>
				</form>
						<?php
							}
							}elseif($sum==2){
									$results = $dbh->prepare("SELECT `Name`,indexNo,ballotNo,photo,positionName FROM tblcandidate INNER JOIN tblposition ON PositionID = id WHERE PositionID= :userid ORDER BY ballotNo ASC");
									$results->bindParam(':userid', $poiden);
									$results->execute();
									for($i=0; $result = $results->fetch(); $i++){
						?> 
				<form method="post" action = "submit.php"> 
				<center>
				<div class="form-group">
				<div class="form-row">
				<div class="col-md-6">
				<table>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					<font style=" font:bold 15px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities("Ballot No."." ".$result['ballotNo']); ?></center></font>
					</div>
				</div>
				</th>
				</tr>
				<tr>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-6">
				<td align = "center">
				  <img src="backend/can/<?php echo htmlentities($result['photo']); ?>" alt="<?php echo htmlentities($result['Name']);?>" class="img-rounded" class="media-object" style="width: 150px; height: 200px; border: 1%;">
				
				</td>
				</div>
				</div>
				</tr>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class=" col-sm-12">
					<font style=" font:bold 15px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities($result['Name']); ?></center></font>
					</div>
				</div>
				</th>
				</tr>
					<input type="hidden" name="fullname" value="<?php echo htmlentities($result['Name']); ?>" />
					<input type="hidden" name="indexno" value="<?php echo htmlentities($result['indexNo']); ?>" />
					<input type="hidden" name="posidon" value="<?php echo htmlentities($poiden); ?>" />
				<tr>
				<td>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-6">
				<a href="submit.php?xlm=<?php echo htmlentities(icrypt($result['indexNo'],'e'));?>&pid=<?php echo htmlentities(icrypt($poiden,'e'));?>" class="btn btn-success btn-labeled pull-right"> Vote <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span> </a>
					</div>
				</div>
				</td>
				</tr>	
				</table>
				</div>
				</div>
				</div>
				</center>
						<?php	
							}
							?>
				<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" name="skipped" class="btn btn-info btn-labeled pull-right" class="btn btn-success btn-labeled">Skip<span class="btn-label btn-label-right"><i class="	fa fa-sign-out"></i></span></button>
					</div>
				</div>
				</form>
				<?php
							}elseif($sum==3){
									$results = $dbh->prepare("SELECT `Name`,indexNo,ballotNo,photo,positionName FROM tblcandidate INNER JOIN tblposition ON PositionID = id WHERE PositionID= :userid ORDER BY ballotNo ASC");
									$results->bindParam(':userid', $poiden);
									$results->execute();
									for($i=0; $result = $results->fetch(); $i++){
						?> 
				<form method="post" action = "submit.php"> 
				<center>
				<div class="form-group">
				<div class="form-row">
				<div class="col-md-4">
				<table>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class=" col-sm-12">
					<font style=" font:bold 15px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities("Ballot No."." ".$result['ballotNo']); ?></center></font>
					</div>
				</div>
				</th>
				</tr>
				<tr>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-6">
				<td align = "center">
				  <img src="backend/can/<?php echo htmlentities($result['photo']); ?>" alt="<?php echo htmlentities($result['Name']);?>" class="img-rounded" class="media-object" style="width: 150px; height: 200px; border: 1%;">
				
				</td>
				</div>
				</div>
				</tr>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-11">
					<font style=" font:bold 12px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities($result['Name']); ?></center></font>
					</div>
				</div>
				</th>
				</tr>
					<input type="hidden" name="fullname" value="<?php echo htmlentities($result['Name']); ?>" />
					<input type="hidden" name="indexno" value="<?php echo htmlentities($result['indexNo']); ?>" />
					<input type="hidden" name="posidon" value="<?php echo htmlentities($poiden); ?>" />
				<tr>
				<td>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-6">
				<a href="submit.php?xlm=<?php echo htmlentities(icrypt($result['indexNo'],'e'));?>&pid=<?php echo htmlentities(icrypt($poiden,'e'));?>" class="btn btn-success btn-labeled pull-right"> Vote <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span> </a>
					</div>
				</div>
				</td>
				</tr>	
				</table>
				</div>
				</div>
				</div>
				</center>
						<?php	
							}
							?>
				<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" name="skipped" class="btn btn-info btn-labeled pull-right" class="btn btn-success btn-labeled">Skip<span class="btn-label btn-label-right"><i class="	fa fa-sign-out"></i></span></button>
					</div>
				</div>
				</form>
				<?php
							}elseif($sum>=4){
									$results = $dbh->prepare("SELECT `Name`,indexNo,ballotNo,photo,positionName FROM tblcandidate INNER JOIN tblposition ON PositionID = id WHERE PositionID= :userid ORDER BY ballotNo ASC");
									$results->bindParam(':userid', $poiden);
									$results->execute();
									for($i=0; $result = $results->fetch(); $i++){
						?> 
				<form method="post" action = "submit.php"> 
				<center>
				<div class="form-group">
				<div class="form-row">
				<div class="col-md-3">
				<table>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-10">
					<font style=" font:bold 10px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities("Ballot No."." ".$result['ballotNo']); ?></center></font>
					</div>
				</div>
				</th>
				</tr>
				<tr>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-6">
				<td align = "center">
				  <img src="backend/can/<?php echo htmlentities($result['photo']); ?>" alt="<?php echo htmlentities($result['Name']);?>" class="img-rounded" class="media-object" style="width: 90px; height: 150px; border: 1%;">
				
				</td>
				</div>
				</div>
				</tr>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class="col-sm-11">
					<font style=" font:bold 10px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities($result['Name']); ?></center></font>
					</div>
				</div>
				</th>
				</tr>
					<input type="hidden" name="fullname" value="<?php echo htmlentities($result['Name']); ?>" />
					<input type="hidden" name="indexno" value="<?php echo htmlentities($result['indexNo']); ?>" />
					<input type="hidden" name="posidon" value="<?php echo htmlentities($poiden); ?>" />
				<tr>
				<td>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-6">
				<a href="submit.php?xlm=<?php echo htmlentities(icrypt($result['indexNo'],'e'));?>&pid=<?php echo htmlentities(icrypt($poiden,'e'));?>" class="btn btn-success btn-labeled pull-right"> Vote <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span> </a>
					</div>
				</div>
				</td>
				</tr>	
				</table>
				</div>
				</div>
				</div>
				</center>
						<?php	
							}
							?>
				<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
				<button type="submit" name="skipped" class="btn btn-info btn-labeled pull-right" class="btn btn-success btn-labeled">Skip <span class="btn-label btn-label-right"><i class="	fa fa-sign-out"></i></span></button>
					</div>
				</div>
				</form>
				<?php
							}
							}
							?>
					</div>
				</section>
				</div>
				<div class="col-md-6">
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="panel-title">
								
							<font style=" font:bold 20px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities('Aspirants Voted'); ?></center></font>
							</div>
							<?php
							if($c_pos==$donevoting)
							{?>
								  <a href="submitvote.php?kasuli=<?php echo htmlentities(icrypt($v,'e'));?>" class="btn btn-info btn-labeled pull-left"><span class="btn-label btn-label-right"><i class="fa fa-save"></i></span> Submit Vote </a>											
							<?php
							}
							?>
						</div>
						<div class="panel-body">
						<form method="post" action = "submitvote.php">
					<input type="hidden" name="indexno" value="<?php echo htmlentities($v); ?>"/>
							<?php
							$results = $dbh->prepare("SELECT DISTINCT cindexNo,pid,voted,yes,`no`,skipped,indexNo FROM voted WHERE indexNo= :userid");
							$results->bindParam(':userid', $v);
							$results->execute();
							for($i=0; $result = $results->fetch(); $i++){
								$skipp = $result['skipped'];
								$posin = $result['pid'];
								$sayno = $result['no'];
								$cind = $result['cindexNo'];
								if($skipp==1){
							?>
				<div class="form-group">
				<div class="form-row">
				<div class="col-md-4">
				<table>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-11">
					<font style=" font:bold 10px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities((posname($posin))); ?></center></font>
					</div>
				</div>
				</th>
				</tr>
				<tr>
				<div class="form-group">
					<div class="col-sm-7">
				<td align = "center">
				  <img src="backend/can/default.jpg" alt="Skipped" class="img-rounded" class="media-object" style="width: 60px; height: 75px; border: 1%;">
				
				</td>
				</div>
				</div>
				</tr>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class="col-sm-12">
					<font style=" font:bold 10px 'Aleo'; color:#1e90ff;"><center>Skipped This Position</center></font>
					</div>
				</div>
				</th>
				</tr>
				<tr>
				<td>
				<div class="form-group">
					<div class="col-sm-10">
				<a href="change-vote.php?votedpid=<?php echo htmlentities(icrypt($posin,'e'));?>" class="btn btn-info btn-labeled btn-sm pull-right"> Change </a>
					</div>
				</div>
				</td>
				</tr>	
				</table>
				</div>
				</div>
				</div>
				<hr>
				<?php
							}elseif($sayno==1){
				?>
				<div class="form-group">
				<div class="form-row">
				<div class="col-md-4">
				<table>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class="col-sm-offset-1 col-sm-6">
					<font style=" font:bold 10px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities((posname($posin))); ?></center></font>
					</div>
				</div>
				</th>
				</tr>
				<tr>
				<div class="form-group">
					<div class="col-sm-7">
				<td align = "center">
				  <img src="backend/can/default.jpg" alt=" You Said NO" class="img-rounded" class="media-object" style="width: 60px; height: 75px; border: 1%;">
				
				</td>
				</div>
				</div>
				</tr>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class="col-sm-12">
					<font style=" font:bold 10px 'Aleo'; color:#1e90ff;"><center>You said NO to this candidate</center></font>
					</div>
				</div>
				</th>
				</tr>
				<tr>
				<td>
				<div class="form-group">
					<div class="col-sm-10">
				<a href="change-vote.php?votedpid=<?php echo htmlentities(icrypt($posin,'e'));?>" class="btn btn-info btn-labeled btn-sm pull-right"> Change </a>
					</div>
				</div>
				</td>
				</tr>	
				</table>
				</div>
				</div>
				</div>
				
				<?php
							}elseif($cind!=0)
							{
				$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$query = $dbh->prepare("SELECT DISTINCT `Name`, indexNo, photo FROM tblcandidate WHERE indexNo= :userid");
				$query->bindParam(':userid', $cind);
				$query->execute();
				for($i=0; $row = $query->fetch(); $i++){
				?>
				<div class="form-group">
				<div class="form-row">
				<div class="col-md-4">
				<table>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class=" col-sm-12">
					<font style=" font:bold 10px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities((posname($posin))); ?></center></font>
					</div>
				</div>
				</th>
				</tr>
				<tr>
				<div class="form-group">
					<div class="col-sm-7">
				<td align = "center">
				  <img src="backend/can/<?php echo htmlentities($row['photo']); ?>" alt="<?php echo htmlentities($row['Name']); ?>" class="img-rounded" class="media-object" style="width: 60px; height: 75px; border: 1%;">
				
				</td>
				</div>
				</div>
				</tr>
				<tr>
				<th  align = "center">
				<div class="form-group">
					<div class="col-sm-12">
					<font style=" font:bold 10px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities($row['Name']); ?></center></font>
					</div>
				</div>
				</th>
				</tr>
				<tr>
				<td>
				<div class="form-group">
					<div class="col-sm-10">
				<a href="change-vote.php?votedpid=<?php echo htmlentities(icrypt($posin,'e'));?>" class="btn btn-info btn-labeled btn-sm pull-right"> Change </a>
					</div>
				</div>
				</td>
				</tr>	
				</table>
				</div>
				</div>
				</div>
				<?php
					}
					}
					}						
				?>
						</form>
						</div>
					</div>
				</div>
            </div>
            <!-- page end-->
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
<?php } ?>