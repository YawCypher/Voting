<?php
include('includes/config.php');
$fullname = 0;	
		$sql="update voters set activate=:fullanme,voted=:gender";
		$query = $dbh->prepare($sql);
		$query->bindParam(':fullanme',$fullanme,PDO::PARAM_STR);
		$query->bindParam(':gender',$fullname,PDO::PARAM_STR);
		$query->execute();
?>