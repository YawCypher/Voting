<?php
session_start();
include('includes/config.php');
$v = icrypt($_SESSION['voter'],'d');
if(isset($_POST['yes']))
{
		$indexno= clean($_POST['indexno']);
		$yespos= clean($_POST['sinpid']);
		update_yes($v,$indexno,$yespos);
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
}elseif(isset($_POST['no']))
{
		$indexno= clean($_POST['indexno']);
		$nopos= clean($_POST['sinpid']);
		update_no($v,$indexno,$nopos);
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";		
}elseif(isset($_GET['xlm']) && isset($_GET['pid']))
{
		$indexno = intval(icrypt($_GET['xlm'],'d'));
		$pid = intval(icrypt($_GET['pid'],'d'));
		update_voted($v,$indexno,$pid);
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
}
?>
