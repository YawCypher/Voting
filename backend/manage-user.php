<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
		
		
				if(isset($_GET['sid']))
		{
		if(votingStart()===false)
		{
			$sid=intval(icrypt($_GET['sid'],'d'));
			$sql="delete from tblcandidate where indexNo=:sid ";
			$query = $dbh->prepare($sql);
			$query->bindParam(':sid',$sid,PDO::PARAM_STR);
			$query->execute();
			$msg="Candidate Info Deleted successfully";
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
<link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
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
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<div class="panel-title">
						<h5>View User Info</h5>
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
	<div class="panel-body p-20">

		<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
		  <thead>
				<tr>
					<th>#</th>
					<th>Profile Picture</th>
					<th>User Name</th>
					<th>Full Name</th>
					<th>Role</th>
					<th>Contact</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>#</th>
					<th>Profile Picture</th>
					<th>User Name</th>
					<th>Full Name</th>
					<th>Role</th>
					<th>Contact</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</tfoot>
			<tbody>
				<?php $sql = "SELECT id, username, `name`, contact, type, photo FROM `user`";
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
<td><a href="#?id=<?php echo htmlentities (icrypt($result->id,'e')); ?>"><img src="user/<?php echo htmlentities($result->photo); ?>" alt="<?php echo htmlentities($result->name);?>" class="img-rounded" style="width: auto; height: 100px; border: 1%;" title="Change User Image"></a></td>
					<td><?php echo htmlentities($result->username);?></td>
					<td><?php echo htmlentities($result->name);?></td>
					<td><?php echo htmlentities($result->type);?></td>
					<td><?php echo htmlentities($result->contact);?></td>
<td>
<a href="edit-user?stid=<?php echo htmlentities(icrypt($result->id,'e'));?>"><i class="fa fa-edit" style="font-size:20px;color:green" title="Edit Record"></i> </a> 

</td>

<td>
<a href="manage-user?sid=<?php echo htmlentities(icrypt($result->id,'e'));?>" onclick="confirm('do you really want to delete this User');"><i class="fa fa-trash" style="font-size:20px;color:red" title="Delete User"></i> </a> 

</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
			</tbody>
		</table>

                                         
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->
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
<script src="js/DataTables/datatables.min.js"></script>
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
</body>
</html>
<?php } ?>