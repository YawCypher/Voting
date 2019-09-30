<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    elseif(votingStart()===false)
{
	echo "<script>alert('Please Start this Voting First');</script>";
	echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
}elseif(votingStart()===true)
{

?>
<!DOCTYPE html>
<head>
<title>Current Elections</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="5;">
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
         <style>
#mainmain{
	text-decoration: none;
	padding-top:10px;
	padding-bottom:5px;
	padding-left:15px;
	padding-right:15px;
	border-radius:10px;
	margin:5px;
	box-shadow:0 5px 5px 2px #484848;
	-moz-box-shadow:0 5px 5px 2px #484848;
	-webkit-box-shadow:0 5px 5px 2px #484848;
	border:1px solid #000;
	background: #DEB7AE;
	color: #222222;
	font-size:10px;
	display: inline-block;
	width: 390px;
	height: 200px;
	text-align: auto;
	margin-bottom: 5px;
}
#main{
	text-decoration: none;
	padding-top:10px;
	padding-bottom:5px;
	padding-left:15px;
	padding-right:15px;
	border-radius:10px;
	margin:5px;
	box-shadow:0 5px 5px 2px #484848;
	-moz-box-shadow:0 5px 5px 2px #484848;
	-webkit-box-shadow:0 5px 5px 2px #484848;
	border:1px solid #000;
	background: #DEB7AE;
	color: #222222;
	font-size:10px;
	display: inline-block;
	width: 235px;
	height: 200px;
	text-align: auto;
	margin-bottom: 5px;
}
#mainmains{
	text-decoration: none;
	padding-top:10px;
	padding-bottom:5px;
	padding-left:15px;
	padding-right:15px;
	border-radius:10px;
	margin:5px;
	box-shadow:0 5px 5px 2px #484848;
	-moz-box-shadow:0 5px 5px 2px #484848;
	-webkit-box-shadow:0 5px 5px 2px #484848;
	border:1px solid #000;
	background: #DEB7AE;
	color: #222222;
	font-size:10px;
	display: inline-block;
	width: 485px;
	height: 200px;
	text-align: auto;
	margin-bottom: 5px;
}
#mains{
	text-decoration: none;
	padding-top:10px;
	padding-bottom:5px;
	padding-left:15px;
	padding-right:15px;
	border-radius:10px;
	margin:5px;
	box-shadow:0 5px 5px 2px #484848;
	-moz-box-shadow:0 5px 5px 2px #484848;
	-webkit-box-shadow:0 5px 5px 2px #484848;
	border:1px solid #000;
	background: #DEB7AE;
	color: #222222;
	font-size:10px;
	display: inline-block;
	width: 280px;
	height: 200px;
	text-align: auto;
	margin-bottom: 5px;
}
#mainmainss{
	text-decoration: none;
	padding-top:10px;
	padding-bottom:5px;
	padding-left:15px;
	padding-right:15px;
	border-radius:10px;
	margin:5px;
	box-shadow:0 5px 5px 2px #484848;
	-moz-box-shadow:0 5px 5px 2px #484848;
	-webkit-box-shadow:0 5px 5px 2px #484848;
	border:1px solid #000;
	background: #DEB7AE;
	color: #222222;
	font-size:10px;
	display: inline-block;
	width: 570px;
	height: 200px;
	text-align: auto;
	margin-bottom: 5px;
}
        </style>
</head>
<body>
            <div class="row">
			<div class ="col-lg-12 col-lg-offset-1">
            <a href="dashboard.php" class="btn btn-primary btn-labeled pull-left"> Back </a>
            </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
			  <?php
 $stmt = $dbh->prepare("SELECT DISTINCT PositionID FROM tblcandidate ORDER BY PositionID ASC");
 $stmt->execute();
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
	 $position = $row['PositionID'];
						$sum = canPerpos($position);
								if($sum==1){
 ?>
				<div id="main">
				<center><font style=" font:bold 15px 'Aleo'; color:#0581CD;"><?php echo htmlentities(posname($position)); ?></font></center>
						<?php  
									$results = $dbh->prepare("SELECT `Name`, ballotNo, photo, votes FROM tblcandidate WHERE PositionID = :userid LIMIT 1");
									$results->bindParam(':userid', $position);
									$results->execute();
									for($i=0; $result = $results->fetch(); $i++){											
						?>
						<center>
                         <div class="col-md-12">
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities($result['photo']); ?>" alt=" <?php echo htmlentities($result['Name']); ?>" class="img-circle profile-img" style="width: auto; height: 100px; border: 1%;">
                                <p><?php echo htmlentities($result['Name']); ?></p>
                                <p class="info"><font style=" font:bold 15px 'Aleo'; color:#000;"><?php echo htmlentities('Yes : '.$result['votes']);?></font> &nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style=" font:bold 15px 'Aleo'; color:#F52F0C;"><?php echo htmlentities('No : '.no($position));?></font></p>                     
							</div> 
                            </div> 
							</center>
							</div>
								<?php
								}} elseif($sum==2){
					?>
					<div id="mains">
					<center><font style=" font:bold 15px 'Aleo'; color:#0581CD;"><?php echo htmlentities(posname($position)); ?></font></center>
					<?php
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
                                <img src="can/<?php echo htmlentities($result['photo']); ?>" alt="Knight Rider" class="img-circle profile-img" style="width: auto; height: 90px; border: 1%;">
                                <p><?php echo htmlentities($result['Name']); ?></p>
                                <small class="info"><font style=" font:bold 15px 'Aleo'; color:#000;"><?php echo htmlentities('Votes : '.$result['votes']); ?></font></small>
                            </div> 
                            </div>
							<?php } ?>
							</div>
							</div>
							</center>
							</div>
							<?php }  elseif($sum==3){
					?>
					<div id="mainmain">
					<center><font style=" font:bold 15px 'Aleo'; color:#0581CD;"><?php echo htmlentities(posname($position)); ?></font></center>
					<?php
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
                                <img src="can/<?php echo htmlentities($result['photo']); ?>" alt="Knight Rider" class="img-circle profile-img" style="width: auto; height: 80px; border: 1%;">
                                <p><?php echo htmlentities($result['Name']); ?></p>
                                <small class="info"><font style=" font:bold 14px 'Aleo'; color:#000;"><?php echo htmlentities('Votes : '.$result['votes']); ?></font></small>
                            </div> 
                            </div>
							<?php } ?>
							</div>
							</div>
							</center>
							</div>
							<?php } elseif($sum==4){
					?>
					<div id="mainmains">
					<center><font style=" font:bold 15px 'Aleo'; color:#0581CD;"><?php echo htmlentities(posname($position)); ?></font></center>
					<?php
									$results = $dbh->prepare("SELECT `Name`, ballotNo, photo, votes FROM tblcandidate WHERE PositionID = :userid ORDER BY ballotNo ASC");
									$results->bindParam(':userid', $position);
									$results->execute();
									?>
									<center>
							<div class="form-group">
							<div class="form-row">
							<?php for($i=0; $result = $results->fetch(); $i++){ ?>
							<div class="col-md-3">
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities($result['photo']); ?>" alt="Knight Rider" class="img-circle profile-img" style="width: auto; height: 80px; border: 1%;">
                                <p><?php echo htmlentities($result['Name']); ?></p>
                                <small class="info"><font style=" font:bold 14px 'Aleo'; color:#000;"><?php echo htmlentities('Votes : '.$result['votes']); ?></font></small>
                            </div> 
                            </div>
							<?php } ?>
							</div>
							</div>
							</center>
							</div>
							<?php } elseif($sum==5){
					?>
				<div id="mainmainss">
				<center><font style=" font:bold 15px 'Aleo'; color:#0581CD;"><?php echo htmlentities(posname($position)); ?></font></center>
				<table>
					  <tr>
					    <td>
						<center>
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities(canphoto(canMatric($position)[0])); ?>" alt="Knight Rider" class="img-circle profile-img" style="width: 60px; height: 80px; border: 1%;">
                                <h6><?php echo htmlentities(canname(canMatric($position)[0])); ?></h6>
                                <small class="info"><font style=" font:bold 15px 'Aleo'; color:#000;"><?php echo htmlentities('Votes : '.canvotes(canMatric($position)[0])); ?></font></small>
                            </div>
							</center>
						</td>
					    <td>
						<center>
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities(canphoto(canMatric($position)[1])); ?>" alt="Knight Rider" class="img-circle profile-img" style="width: 60px; height: 80px; border: 1%;">
                                <h6><?php echo htmlentities(canname(canMatric($position)[1])); ?></h6>
                                <small class="info"><font style=" font:bold 15px 'Aleo'; color:#000;"><?php echo htmlentities('Votes : '.canvotes(canMatric($position)[1])); ?></font></small>
                            </div>
							</center>
						</td>
					    <td>
						<center>
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities(canphoto(canMatric($position)[2])); ?>" alt="Knight Rider" class="img-circle profile-img" style="width: 60px; height: 80px; border: 1%;">
                                <h6><?php echo htmlentities(canname(canMatric($position)[2])); ?></h6>
                                <small class="info"><font style=" font:bold 15px 'Aleo'; color:#000;"><?php echo htmlentities('Votes : '.canvotes(canMatric($position)[2])); ?></font></small>
                            </div>
						</center>
						</td>
					    <td>
						<center>
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities(canphoto(canMatric($position)[3])); ?>" alt="Knight Rider" class="img-circle profile-img" style="width: 60px; height: 80px; border: 1%;">
                                <h6><?php echo htmlentities(canname(canMatric($position)[3])); ?></h6>
                                <small class="info"><font style=" font:bold 15px 'Aleo'; color:#000;"><?php echo htmlentities('Votes : '.canvotes(canMatric($position)[3])); ?></font></small>
                            </div>
						</center>
						</td>
					    <td>
						<center>
                            <div class="user-info closed">
                                <img src="can/<?php echo htmlentities(canphoto(canMatric($position)[4])); ?>" alt="Knight Rider" class="img-circle profile-img" style="width: 60px; height: 80px; border: 1%;">
                                <h6><?php echo htmlentities(canname(canMatric($position)[4])); ?></h6>
                                <small class="info"><font style=" font:bold 15px 'Aleo'; color:#000;"><?php echo htmlentities('Votes : '.canvotes(canMatric($position)[4])); ?></font></small>
                            </div>
						</center>
						</td>
					  </tr>
					</table>
				</div>
							<?php } ?>

			<?php } ?>	
		</div>
    </div>
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
<?php  } ?>