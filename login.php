<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
// To check if details provided are valid.
$uname= clean($_POST['username']);
if(voted($uname) === NULL )
{
	    // message in response to system having technical issues
    echo "<script>alert(' Sorry we have a technical challenge now. Try again later');</script>";
	echo "<script type='text/javascript'> document.location = 'index.php'; </script>";

}elseif(voted($uname)===true)
{
	    $name=name($uname);
		// message in response to multiple voting attempt
		echo "<script>alert('Sorry $name you can only vote once(1)!');</script>";
		echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}else{
	if(validate($uname)===false){
		    // message in response to invalid details provided
    echo "<script>alert('Please see one of the verification officers to activate your matric number');</script>";
	echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
	}elseif(validate($uname)===true){
		$v = icrypt($_POST['username'],'e');
		$_SESSION['voter']=$v;
		$x = 0;
		if(checkTemp($uname,$x)===false)
		{
			insert_temp($uname,$x);
		}
	echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
	}
}
}
?>
