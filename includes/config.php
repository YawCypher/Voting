<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','epiz_22026093_voting');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

//////////////////////////////////////////////////////////////////////////////////////
	function VOTEDNO($pid){
		global $msg, $dbh;
		$sql_select = "SELECT
				Count(voted.indexNo) AS SKIPPEDNO
				FROM
				voted
				WHERE
				voted.indexNo =" . $dbh->quote($pid);
		$stmt = $dbh->query($sql_select);
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
			foreach($r as $result)
		{
			$skipno = $result->SKIPPEDNO;
		}
			return $skipno;
		}else
			return null;
}
//////////////////////////////////////////////////////////////////////////////////////
	function SKIPPEDNO($pid){
		global $msg, $dbh;
		$sql_select = "SELECT
				Count(voted.indexNo) AS SKIPPEDNO
				FROM
				voted
				WHERE
				(voted.skipped = 1 OR
				voted.`no` = 1) AND
				voted.indexNo =" . $dbh->quote($pid);
		$stmt = $dbh->query($sql_select);
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
			foreach($r as $result)
		{
			$skipno = $result->SKIPPEDNO;
		}
			return $skipno;
		}else
			return null;
}	
//////////////////////////////////////////////////////////////////////////////////////	
	function voted($indexno){
	global $msg, $dbh, $error;
	$voted = 1;
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql_select = "SELECT voted FROM `voters` WHERE indexNo = " . $dbh->quote($indexno) . " AND voted = " . $dbh->quote($voted) . " LIMIT 1";
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false){
		return true;
	}else
		return false;
}	
	//////////////////////////////////////////////////////////////////////
	function validate($indexno){
		global $msg, $dbh, $error;
		$pass =1;
		$sql_select = "SELECT indexNo, activate
				   FROM voters
				   WHERE indexNo = :indexno AND activate = :password
				   LIMIT 1";
		$stmt = $dbh->prepare($sql_select);
		$stmt->bindParam(':indexno', $indexno);
		$stmt->bindParam(':password', $pass);
		$stmt->execute();
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetch(PDO::FETCH_ASSOC);
		if($r !== false){
			return true;
		}else
			return false;
}
	//////////////////////////////////////////////////////////////////////
	function name($indexno){
		global $msg, $dbh, $error;
		$sql_select = "SELECT Name
				   FROM voters
				   WHERE indexNo = " . $dbh->quote($indexno) . "
				   LIMIT 1";
		$stmt = $dbh->query($sql_select);
	 
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
						foreach($r as $result)
		{
			
			$name = $result->Name;
		}
			return $name;
		}else
			$name = 'Dear Voter';
			return $name;
}
/////////////////////////////////////////////////////////////////////////////////
function icrypt( $string, $action = 'e' ) {
    $secret_key = 'kasulana_latif';
    $secret_iv = 'knight_rider';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}
/////////////////////////////////////////////////////////////////////////////////
function cleanInput($input) {

  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );

    $output = preg_replace($search, '', $input);
    return $output;
  }
function clean($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = clean($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
		$output = filter_var($input,FILTER_SANITIZE_STRING);
    }
    return $output;
}
/////////////////////////////////////////////////////////////////////////////////
	function getpos(){
		global $msg, $dbh, $error;
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT DISTINCT PositionID FROM tblcandidate ORDER BY PositionID ASC";
		$query = $dbh->prepare($sql);
		$query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		$cnt=1;
		if($query->rowCount() > 0)
		{
			$pos = array();
		foreach($results as $result)
		{ 
		
			$pos[] = ($result->PositionID);
		
		}
			return $pos;
		}else
			return NULL;
}
/////////////////////////////////////////////////////////////////////////////////
	function canPerpos($pos){
		global $msg, $dbh, $error;
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql2 ="SELECT tblcandidate.PositionID FROM tblcandidate WHERE tblcandidate.PositionID =" . $dbh->quote($pos);
		$query2 = $dbh -> prepare($sql2);
		$query2->execute();
		$results2=$query2->fetchAll(PDO::FETCH_OBJ);
		$totalcans=$query2->rowCount();
			return $totalcans;
}
/////////////////////////////////////////////////////////////////////////////////
	function votingStart(){
	global $msg, $dbh, $error;
	$Start=1;
	$sql_select = "SELECT stvote
		       FROM startvote
		       WHERE stvote = " . $dbh->quote($Start) . "
		       LIMIT 1";
 
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		$error = 'Error in determine whether the voting has start or not';
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false){
		$error = "Voting is in Progress you cannot delete any candidate now.";
		return true;
	}else
		return false;
}
///////////////////////////////////////////////////////////////////////////////////////
	function voted_pos($indexno,$pid){
	global $msg, $dbh, $error;
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql_select = "SELECT voted.indexNo, voted.pid FROM voted WHERE indexNo = " . $dbh->quote($indexno) . " AND pid= ". $dbh->quote($pid) . "
					LIMIT 1";
 
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false){
		return true;
	}else
		return false;
}
/////////////////////////////////////////////////////////////////////////////////
	function checkTemp($indexno){
	global $msg, $dbh, $error;
	$voted = 1;
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql_select = "SELECT indexNo,pid FROM tempo WHERE indexNo = " . $dbh->quote($indexno) . " LIMIT 1";
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false){
		return true;
	}else
		return false;
}
////////////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function insert_temp($indexNo,$pid){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$insert = "INSERT INTO tempo(indexNo,pid) VALUES(" .$dbh->quote($indexNo) .", ". $dbh->quote($pid).")";
	if($dbh->exec($insert) === false){
		return false;
	}else{
		return true;
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_temp($indexNo,$pid){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$sql = "UPDATE `tempo` SET `pid`= ". $dbh->quote($pid) ." WHERE (`indexNo`=" . $dbh->quote($indexNo) .") LIMIT 1";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
/////////////////////////////////////////////////////////////////////////////////
	function currentpos($indexno){
		global $msg, $dbh, $error;
		$sql_select = "SELECT pid
				   FROM tempo
				   WHERE indexNo = " . $dbh->quote($indexno) . "
				   LIMIT 1";
		$stmt = $dbh->query($sql_select);
	 
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
			foreach($r as $result)
		{
			
			$current = $result->pid;
		}
			return $current;
		}else
			return null;
}
/////////////////////////////////////////////////////////////////////////////////
	function posname($pid){
		global $msg, $dbh;
		$sql_select = "SELECT positionName
				   FROM tblposition
				   WHERE id = " . $dbh->quote($pid) . "
				   LIMIT 1";
		$stmt = $dbh->query($sql_select);
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
			foreach($r as $result)
		{
			$posnam = $result->positionName;
		}
			return $posnam;
		}else
			return null;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function incre_temp($indexNo){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$sql = "UPDATE `tempo` SET `pid`= `pid`+1  WHERE (`indexNo`=" . $dbh->quote($indexNo) .") LIMIT 1";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function insert_voted($vindex,$cindex,$pid){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$insert = "INSERT INTO `voted` (`indexNo`, `cindexNo`, `pid`, `voted`) VALUES(" .$dbh->quote($vindex) .", ". $dbh->quote($cindex).", ". $dbh->quote($pid).",'1')";
	if($dbh->exec($insert) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function insert_yes($vindex,$cindex,$pid){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$insert = "INSERT INTO `voted` (`indexNo`, `cindexNo`, `pid`, `yes`) VALUES(" .$dbh->quote($vindex) .", ". $dbh->quote($cindex).", ". $dbh->quote($pid).",'1')";
	if($dbh->exec($insert) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function insert_no($vindex,$cindex,$pid){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$insert = "INSERT INTO `voted` (`indexNo`, `cindexNo`, `pid`, `no`) VALUES(" .$dbh->quote($vindex) .", ". $dbh->quote($cindex).", ". $dbh->quote($pid).",'1')";
	if($dbh->exec($insert) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function insert_skipped($vindex,$pid){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$insert = "INSERT INTO `voted` (`indexNo`, `pid`, `skipped`) VALUES(" .$dbh->quote($vindex) .",". $dbh->quote($pid).",'1')";
	if($dbh->exec($insert) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function update_voted($vindex,$cindex,$pid){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$sql = "UPDATE `voted` SET `cindexNo`=". $dbh->quote($cindex).", `voted`='1', `yes`='0', `no`='0', `skipped`='0' WHERE (`indexNo`=" .$dbh->quote($vindex) .") AND (`pid`=". $dbh->quote($pid).") LIMIT 1";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function update_yes($vindex,$cindex,$pid){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$sql = "UPDATE `voted` SET `cindexNo`=". $dbh->quote($cindex).", `voted`='0', `yes`='1', `no`='0', `skipped`='0' WHERE (`indexNo`=" .$dbh->quote($vindex) .") AND (`pid`=". $dbh->quote($pid).") LIMIT 1";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function update_no($vindex,$cindex,$pid){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$sql = "UPDATE `voted` SET `cindexNo`=". $dbh->quote($cindex).", `voted`='0', `yes`='0', `no`='1', `skipped`='0' WHERE (`indexNo`=" .$dbh->quote($vindex) .") AND (`pid`=". $dbh->quote($pid).") LIMIT 1";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function incre_votes($indexno){
	global $dbh, $msg, $error;
	// construct SQL insert statement
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE `tblcandidate` SET `votes`= votes + 1 WHERE (`indexNo`=" . $dbh->quote($indexno) . ") LIMIT 1";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function update_voter($indexno){
	global $dbh, $msg, $error;
	// construct SQL insert statement
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "UPDATE `voters` SET `voted`='1' WHERE (`indexNo`=" . $dbh->quote($indexno) . ") LIMIT 1";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function deleteTemp($indexno){
	global $dbh, $msg, $error;
	// construct SQL insert statement
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM `tempo` WHERE (`indexNo`=" . $dbh->quote($indexno) . ")";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function BeforeLogin($username, $password) 
{ 
// check if this IP address is currently blocked 
global $dbh; 
$sql_select = "SELECT Attempts, LastLogin FROM loginattempts WHERE IP = '" . $_SERVER["REMOTE_ADDR"]. "'";
		$stmt = $dbh->query($sql_select);
		if($stmt === false){
			return NULL;
		} 
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r)
		{
			foreach($r as $result)
		{
$time = strtotime($result->LastLogin); 
$diff = (time()-$time)/60;
if ($result->Attempts >=3) 
{ 
  if($diff<30) 
  { 
    return false; 
  } 
  else
  {
	$dbh->exec("UPDATE LoginAttempts SET Attempts=0 WHERE IP = '" . $_SERVER["REMOTE_ADDR"]. "'");
    return true; 
  } 
}		} 
		}else{
			return true;
		} 
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D
function AfterSuccessfulLogin() 
{ 
//********** Custom code ************ 
// clear previous attempts 
 
global $dbh; 
$dbh->exec("UPDATE LoginAttempts SET Attempts=0 WHERE IP = '" . $_SERVER["REMOTE_ADDR"]. "'");
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D
function AfterUnsuccessfulLogin() 
// increase number of attempts 
// set last login attempt timeif required 
{ 
global $dbh; 
$sql_select = "SELECT * FROM loginattempts WHERE IP = '" . $_SERVER["REMOTE_ADDR"]. "'";
		$stmt = $dbh->query($sql_select);
		if($stmt === false){
			return NULL;
		} 
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r)
		{
		$dbh->exec("UPDATE LoginAttempts SET Attempts=Attempts+1, LastLogin=now() WHERE IP = '" . $_SERVER["REMOTE_ADDR"]. "'");
		}else
		{
			  $dbh->exec("insert into LoginAttempts (Attempts,IP,LastLogin) 
			values (1, '".$_SERVER["REMOTE_ADDR"] . "',NOW())");
		}
} 
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D
	function votingEnd(){
	global $msg, $dbh, $error;
	$Start=1;
	$sql_select = "SELECT stvote
		       FROM startvote
		       WHERE endvote = " . $dbh->quote($Start) . "
		       LIMIT 1";
 
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false){
		return true;
	}else
		return false;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D
?>