<?php
session_start();
include('includes/config.php');
$v = icrypt($_SESSION['voter'],'d');
if(isset($_POST['yes']))
{
		$indexno= clean($_POST['indexno']);
		$yespos= clean($_POST['sinpid']);
		insert_yes($v,$indexno,$yespos);
		incre_temp($v);
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
}elseif(isset($_POST['no']))
{
		$indexno= clean($_POST['indexno']);
		$nopos= clean($_POST['sinpid']);
		insert_no($v,$indexno,$nopos);
		incre_temp($v);
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";	
}elseif(isset($_POST['Sskip']))
{
		$skippos= clean($_POST['sinpid']);
		insert_skipped($v,$skippos);
		incre_temp($v);
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";	
}elseif(isset($_GET['xlm']) && isset($_GET['pid']))
{
		$indexno = intval(icrypt($_GET['xlm'],'d'));
		$pid = intval(icrypt($_GET['pid'],'d'));
		insert_voted($v,$indexno,$pid);
		incre_temp($v);
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
}elseif(isset($_POST['skipped']))
{
		$posidon= clean($_POST['posidon']);
		insert_skipped($v,$posidon);
		incre_temp($v);
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";	
}
?>
