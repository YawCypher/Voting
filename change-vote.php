<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['voter'])=="")
    {   
    header("Location: index.php"); 
    }
    else{

	if(isset($_GET['votedpid']))
	{
		$v = icrypt($_SESSION['voter'],'d');
		$position = icrypt($_GET['votedpid'],'d');
		$sum = canPerpos($position);
		$name=name($v);
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
                    <div class="col-md-7 col-md-offset-3">
                        <div class="panel login-box panel-info">
                            <div class="panel-heading">
                                <div class="panel-title text-center">
                                    <h4><?php echo htmlentities(posname($position)); ?></h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form action="result.php" method="post">    
                                    <div class="form-group mt-20">
												<?php  
													if($sum==1){
														$results = $dbh->prepare("SELECT `Name`,indexNo,ballotNo,photo,positionName FROM tblcandidate INNER JOIN tblposition ON PositionID = id WHERE PositionID= :userid");
														$results->bindParam(':userid', $position);
														$results->execute();
														for($i=0; $result = $results->fetch(); $i++){											
											?>
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-6">
									  <img src="backend/can/<?php echo htmlentities($result['photo']); ?>" alt="<?php echo htmlentities($result['Name']);?>" class="img-rounded" class="media-object" style="width: auto; height: 250px; border: 10%;">
									</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-6">
										<font style=" font:bold 20px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities($result['Name']); ?></center></font>
										</div>
										<input type="hidden" name="indexno" value="<?php echo htmlentities($result['indexNo']); ?>" />
										<input type="hidden" name="sinpid" value="<?php echo htmlentities($position); ?>" />
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-6">
									<button type="submit" name="yes" class="btn btn-success btn-labeled pull-left" class="btn btn-success btn-labeled"><span class="btn-label btn-label-right"><i class="fa fa-thumbs-up"></i></span> Yes</button>
									<button type="submit" name="no" class="btn btn-danger btn-labeled pull-right" class="btn btn-danger btn-labeled"><span class="btn-label btn-label-right"><i class="fa fa-thumbs-down"></i></span> No</button>
										</div>
									</div>
									<?php
													}
													}elseif($sum==2){
														$results = $dbh->prepare("SELECT `Name`,indexNo,ballotNo,photo,positionName FROM tblcandidate INNER JOIN tblposition ON PositionID = id WHERE PositionID= :userid ORDER BY ballotNo ASC");
														$results->bindParam(':userid', $position);
														$results->execute();
														for($i=0; $result = $results->fetch(); $i++){
									?>
									<div class="form-group">
									<div class="form-row">
									<div class="col-md-6">
									<table>
									<tr>
									<th  align = "center">
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-9">
										<font style=" font:bold 20px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities("Ballot No."." ".$result['ballotNo']); ?></center></font>
										</div>
									</div>
									</th>
									</tr>
									<tr>
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-6">
									<td align = "center">
									  <img src="backend/can/<?php echo htmlentities($result['photo']); ?>" alt="<?php echo htmlentities($result['Name']);?>" class="img-rounded" class="media-object" style="width: auto; height: 250px; border: 1%;">
									
									</td>
									</div>
									</div>
									</tr>
									<tr>
									<th  align = "center">
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-7">
										<font style=" font:bold 20px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities($result['Name']); ?></center></font>
										</div>
									</div>
									</th>
									</tr>
									<tr>
									<td>
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-6">
									<a href="result.php?xlm=<?php echo htmlentities(icrypt($result['indexNo'],'e'));?>&pid=<?php echo htmlentities(icrypt($position,'e'));?>" class="btn btn-success btn-labeled pull-right"> Vote <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span> </a>
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
										}elseif($sum==3){
														$results = $dbh->prepare("SELECT `Name`,indexNo,ballotNo,photo,positionName FROM tblcandidate INNER JOIN tblposition ON PositionID = id WHERE PositionID= :userid ORDER BY ballotNo ASC");
														$results->bindParam(':userid', $position);
														$results->execute();
														for($i=0; $result = $results->fetch(); $i++){
									?>
									<div class="form-group">
									<div class="form-row">
									<div class="col-md-4">
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
									<tr>
									<td>
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-6">
									<a href="result.php?xlm=<?php echo htmlentities(icrypt($result['indexNo'],'e'));?>&pid=<?php echo htmlentities(icrypt($position,'e'));?>" class="btn btn-success btn-labeled pull-right"> Vote <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span> </a>
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
										}elseif($sum>=4){
														$results = $dbh->prepare("SELECT `Name`,indexNo,ballotNo,photo,positionName FROM tblcandidate INNER JOIN tblposition ON PositionID = id WHERE PositionID= :userid ORDER BY ballotNo ASC");
														$results->bindParam(':userid', $position);
														$results->execute();
														for($i=0; $result = $results->fetch(); $i++){
									?>
									<div class="form-group">
									<div class="form-row">
									<div class="col-md-3">
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
										<div class="col-sm-offset-3 col-sm-7">
										<font style=" font:bold 15px 'Aleo'; color:#1e90ff;"><center><?php echo htmlentities($result['Name']); ?></center></font>
										</div>
									</div>
									</th>
									</tr>
									<tr>
									<td>
									<div class="form-group">
										<div class="col-sm-offset-4 col-sm-6">
									<a href="result.php?xlm=<?php echo htmlentities(icrypt($result['indexNo'],'e'));?>&pid=<?php echo htmlentities(icrypt($position,'e'));?>" class="btn btn-success btn-labeled pull-right"> Vote <span class="btn-label btn-label-right"><i class="fa fa-check"></i></span> </a>
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
									?>
                                        <div class="">
                                            <a href="dashboard.php" class="btn btn-danger btn-labeled pull-right"> Back <span class="btn-label btn-label-right"><i class="fa fa-arrow-right"></i></span> </a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                            </div>
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-md-6 col-md-offset-3 -->
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