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
	$position = $_POST['pname']; 
	clean($position);
	if(pos_exist($position)===false)
	{
		insert_pos($position);
	}
	}
	catch (PDOException $e)
	{
	exit($error = $e->getMessage());
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
    <div class="col-md-5">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Create Position</h5>
                                                </div>
                                            </div>
											<?php if($msg){?>
											<div class="alert alert-success left-icon-alert" role="alert">
											<strong>Well done!</strong><?php echo htmlentities($msg); ?>
											</div><?php } 
											else if($error){?>
											<div class="alert alert-danger left-icon-alert" role="alert">
											<strong>Oh Sorry!</strong> <?php echo htmlentities($error); ?>
											</div>
											<?php } ?>
  
                                            <div class="panel-body">

                                                <form method="post">
												        <div class="col-md-12 control-label">
														  <label class="control-label">Position Name*</label>
														  <div class="input-group">             
															  <span class="input-group-addon">
														  <i class="fa fa-user" aria-hidden="true"></i>
														  </span>
														  <input type="text" name="pname" autocomplete="off" title="Position Name" value="" class="form-control" placeholder="Position Name" required="">
														  </div>
														</div>
														   <div class="col-md-12 form-group">
														  <button type="submit" name="submit" class="btn btn-primary btn-labeled" class="btn btn-primary btn-labeled"><span class="btn-label btn-label-right"><i class="fa fa-save"></i></span> Submit</button>
														  <button type="reset" class="btn btn-default">Reset</button>
														</div>
													<div class="clearfix"> </div>


                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 col-md-offset-2 -->
									
									<div class="col-md-7">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Position List</h5>
                                                </div>
                                            </div>
											<div class="panel-body">
											<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
												<thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Position Name</th>
                                                            <th>Edit</th>
															<th>Delete</th>
                                                        </tr>
                                                </thead>
                                                <tfoot>
                                                        <tr>
                                                          <th>#</th>
                                                            <th>Position Name</th>
                                                            <th>Edit</th>
															<th>Delete</th>
														</tr>
                                                </tfoot>
						                            <tbody>
															<?php 
															$sql = "SELECT id,positionName FROM tblposition";
															$query = $dbh->prepare($sql);
															$query->execute();
															$results=$query->fetchAll(PDO::FETCH_OBJ);
															$cnt=1;
															if($query->rowCount() > 0)
															{
															foreach($results as $result)
															{   ?>
															<tr>
															<td><?php echo htmlentities($cnt);?></td>
                                                            <td><?php echo htmlentities($result->positionName);?></td>
<td>
<a href="edit-position.php?poid=<?php echo htmlentities (icrypt($result->id,'e'));?>"><i class="fa fa-pencil" style="font-size:20px;color:green" title="View Position Details"></i> </a> 

</td>

<td>
<a href="edit-position.php?pid=<?php echo htmlentities (icrypt($result->id,'e'));?>" onclick="confirm('do you really want to delete this Position ?');"><i class="fa fa-trash" style="font-size:20px;color:red" title="Delete user"></i> </a> 

</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
                                                       
                                                    
                                                    </tbody>
											</table>
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