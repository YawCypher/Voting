<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['voter'])=="")
    {   
    header("Location: index.php"); 
    }
    else{
	$donevoting = sizeof(getpos());
	if(isset($_GET['kasuli']))
	{
		$indexno = icrypt($_GET['kasuli'],'d');
		$indexno = clean($indexno);
		$novoted = VOTEDNO($indexno);
		if($novoted < $donevoting){ ?>
	<script type="text/javascript">
	 if(!confirm("Sure you do not want to vote for All The Positions? There is NO undo!"))
		  {
		document.location = 'dashboard.php';
			}
   </script>
	<?php
	}else{
		$v = icrypt($_SESSION['voter'],'d');
		if($v == $indexno){
		$query = $dbh->prepare("select indexNo, cindexNo from voted where skipped = 0 and no = 0 and indexNo= :userid");
		$query->bindParam(':userid', $v);
		$query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		$cnt=1;
		if($query->rowCount() > 0)
		{
		foreach($results as $result)
		{
			$cindexno = $result->cindexNo;
		if($cindexno!=null)
	{	
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql="update  tblcandidate set `votes`= votes + 1 where indexNo = :sid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':sid',$cindexno,PDO::PARAM_STR);
		$query->execute();
		if(update_voter($indexno)===true){
		echo "<script type='text/javascript'> document.location = 'confirm.php'; </script>";
		}
	}else{
		echo "<script>alert('Please vote before you submit');</script>";
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
	}
			
		}
	}elseif(SKIPPEDNO($indexno)== $donevoting){ ?>
	<script type="text/javascript">
	 if(confirm("Sure you do not want to vote for any Position? There is NO undo!"))
		  {
		document.location = 'confirm.php';
			}
   </script>
	<?php
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
	}else{
		echo "<script>alert('Please vote before you submit');</script>";
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";		
	}
	}else{
		echo "<script>alert('Please the system can't validate your information, Login again');</script>";
		echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
	}
	}}else{
		echo "<script>alert('Please vote before you submit');</script>";
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
	}
	?>
<?php } ?>
