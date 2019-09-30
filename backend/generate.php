<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
		   $GeneratedIndexno=array();
if(isset($_POST['submit']))
{
	try
	{
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$none = "none";
		$sql1 = "SELECT indexNo, Password FROM voters WHERE Password = :password";
		$stmt = $dbh->prepare($sql1);
		$stmt->bindParam(':password',$none,PDO::PARAM_STR);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($stmt->rowCount() > 0)
		{
		foreach($results as $result){
			array_push($GeneratedIndexno,$result->indexNo);
			$id = $result->indexNo;
			$password = pass();
			$password = icrypt($password,'e');
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql2 = "UPDATE voters SET Password = :password WHERE indexNo = :indexno";
			$query = $dbh->prepare($sql2);
			$query->bindParam(':password',$password,PDO::PARAM_STR);
			$query->bindParam(':indexno',$id,PDO::PARAM_STR);
			$query->execute();
		}
	}else{
		$msg = "All Voters Have Password";
	}
	}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E | VOTING</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
         <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php');?>   
          <!-----End Top bar>
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

<!-- ========== LEFT SIDEBAR ========== -->
<?php include('includes/leftbar.php');?>                   
 <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-7">
                                    <h2 class="title" align = "right">Generate Passwords</h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>
            							<li><a href="#">Passwords</a></li>
            							<li class="active">Generate Passwords</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h2 align = "center">Generate Passwords</h2>
                                                </div>
                                            </div>	
<?php if($msg){?>
<div class="alert alert-info left-icon-alert" role="alert">
 <strong>HeadsUp ! </strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
<strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
</div>
<?php } ?>											
                                            <div class="panel-body">
                                                <form method="post">
													<div class="form-group has-success">
                                                        <div class="col-sm-offset-4 col-sm-4">
                                                           <button type="submit" name="submit" class="btn btn-success btn-labeled btn-lg pull-right">Generate<span class="btn-label btn-label-right"><i class="fa fa-cogs"></i></span></button>
                                                    </div> 
                                                    </div> 
                                                </form>
												<br>
												<br>
<?php if($GeneratedIndexno){ ?>
<div class = "col-md-10">
<font style=" font:italic 25px 'Aleo';">...</font>
</div>
<div class = "col-md-10">
<font style=" font:italic 25px 'Aleo'; text-shadow:1px 1px 15px #000; color:#2AB24D;">Passwords Generated For :</font>
		<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
		  <thead>
				<tr>
					<th>Name</th>
					<th>Index Number</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Name</th>
					<th>Index Number</th>
				</tr>
			</tfoot>
			<tbody>
<?php
	for($i=0;$i<count($GeneratedIndexno);$i++){
		$indexn=$GeneratedIndexno[$i];
	?>
	<tr>
	<td><?php echo htmlentities(name($indexn));?></td>
	<td><?php echo htmlentities($indexn);?></td>
	</tr>
<?php } ?>
</tbody>
</table>
</div>
<?php } ?>	
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 col-md-offset-2 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>


        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
<?php  } ?>
