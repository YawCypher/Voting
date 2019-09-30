<?php 
include('includes/configpdo.php');
// DB credentials.
/**/
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
/////////////////////////////////////////////////////////////////////////////////////
function StartVoting(){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$sql = "UPDATE `startvote` SET `stvote`= 1, `endvote`='0'";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
/////////////////////////////////////////////////////////////////////////////////////
function StopVoting(){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$sql = "UPDATE `startvote` SET `stvote`= 0, `endvote`='1'";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
/////////////////////////////////////////////////////////////////////////////////////
function CloseVoting(){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$sql = "UPDATE `startvote` SET `stvote`= 0, `endvote`='0'";
	if($dbh->exec($sql) === false){
		return false;
	}else{
		return true;
	}
}
/////////////////////////////////////////////////////////////////////////////////////
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
//////////////////////////////////////////////////////////////////////////////////////////////
function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}
////////////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function insert_can($Name,$indexNo,$contactNo,$gender,$PositionID,$ballotNo,$photo,$votes){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$insert = "INSERT INTO tblcandidate(Name,indexNo,contactNo,gender,PositionID,ballotNo,photo,votes) VALUES(" . $dbh->quote($Name) .", ". $dbh->quote($indexNo) .", ". $dbh->quote($contactNo) .", ". $dbh->quote($gender) .", ". $dbh->quote($PositionID) .", ". $dbh->quote($ballotNo).",'$photo', ". $dbh->quote($votes).")";
 
	if($dbh->exec($insert) === false){
		$error = 'Error inserting the Candidate.';
		return false;
	}else{
		$msg = "The new Candidate $Name is Inserted";
		return true;
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////
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
/////////////////////////////////////////////////////////////////////////////////////////////////
	
	function pos_exist($position){
	global $msg, $dbh, $error;
 
	$sql_select = "SELECT positionName
		       FROM tblposition
		       WHERE positionName = " . $dbh->quote($position) . "
		       LIMIT 1";
 
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		$error = 'Error querying Position table';
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false){
		$error = "Position with name $position already exists.";
		return true;
	}else
		return false;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	function can_exist($indexno){
	global $msg, $dbh, $error;
 
	$sql_select = "SELECT indexNo
		       FROM tblcandidate
		       WHERE indexNo = " . $dbh->quote($indexno) . "
		       LIMIT 1";
 
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		$error = 'Error querying Candidate table';
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false){
		$error = "Candidate with INDEX NUMBER $indexno already exists.";
		return true;
	}else
		return false;
}
////////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
 function checkimg($img) {
	 global $error;
	$check = getimagesize($img);
    if($check !== false){
			addslashes(file_get_contents($img));
			return true;
	}else{
		$error = "Please select an Image ";
		return false;
	}
	} 
///////////////////////////////////////////////////////////////////////////////////////////////////////////
function insert_pos($position){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$sql_insert = "INSERT INTO tblposition(positionName)
				   VALUES(" . $dbh->quote($position) .")";
 
	if($dbh->exec($sql_insert) === false){
		$error = 'Error inserting the Position.';
		return false;
	}else{
		$msg = "The new position $position is created";
		return true;
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
function update_pos($id,$position){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$sql = "UPDATE `tblposition` SET `positionName`=" . $dbh->quote($position) ." WHERE (`id`=".$dbh->quote($id).") LIMIT 1";
	if($dbh->exec($sql) === false){
		$error = 'Error Updating the Position.';
		return false;
	}else{
		$msg = "The position $position is Updated";
		return true;
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////
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
/////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	function ballot_exist($pid,$ballot){
	global $msg, $dbh, $error;
 
	$sql_select = "SELECT ballotNo
		       FROM tblcandidate
		       WHERE PositionID = " . $dbh->quote($pid) . " AND ballotNo =  " . $dbh->quote($ballot) . "
		       LIMIT 1";
 
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		$error = 'Error querying Candidate table';
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false){
		$error = "The ballot number $ballot is already assigned to a candidate.";
		return true;
	}else
		return false;
}
///////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function pass() {
    $alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}
///////////////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	function voter_exist($indexno){
	global $msg, $dbh, $error;
 
	$sql_select = "SELECT indexNo
		       FROM voters
		       WHERE indexNo = " . $dbh->quote($indexno) . "
		       LIMIT 1";
 
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		$error = 'Error querying Voters table';
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false){
		$error = "Voter with INDEX NUMBER $indexno already exists.";
		return true;
	}else
		return false;
}
///////////////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
function insert_voter($indexNo,$Name,$voted){
	global $dbh, $msg, $error;
	// construct SQL insert statement
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$inserti = "INSERT INTO voters(indexNo,Name,voted) VALUES(" . $dbh->quote($indexNo) .", ". $dbh->quote($Name) .", ". $dbh->quote($voted).")";
 
	if($dbh->exec($inserti) === false){
		$error = 'Error inserting the voter.';
		return false;
	}else{
		$msg = "The new Voter $Name is Inserted";
		return true;
	}
}
///////////////////////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
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
/////////////////////////////////////////////////////////////////////////////////
	function canvotes($pid){
		global $msg, $dbh;
		$sql_select = "SELECT votes
				   FROM tblcandidate
				   WHERE indexNo = " . $dbh->quote($pid) . "
				   LIMIT 1";
		$stmt = $dbh->query($sql_select);
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
			foreach($r as $result)
		{
			$posnam = $result->votes;
		}
			return $posnam;
		}else
			return null;
}
/////////////////////////////////////////////////////////////////////////////////
	function canphoto($pid){
		global $msg, $dbh;
		$sql_select = "SELECT photo
				   FROM tblcandidate
				   WHERE indexNo = " . $dbh->quote($pid) . "
				   LIMIT 1";
		$stmt = $dbh->query($sql_select);
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
			foreach($r as $result)
		{
			$posnam = $result->photo;
		}
			return $posnam;
		}else
			return null;
}
/////////////////////////////////////////////////////////////////////////////////
	function canname($pid){
		global $msg, $dbh;
		$sql_select = "SELECT Name
				   FROM tblcandidate
				   WHERE indexNo = " . $dbh->quote($pid) . "
				   LIMIT 1";
		$stmt = $dbh->query($sql_select);
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
			foreach($r as $result)
		{
			$posnam = $result->Name;
		}
			return $posnam;
		}else
			return null;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	function sadmin_exist($role){
	global $msg, $dbh, $error;
 
	$sql_select = "SELECT type
		       FROM user
		       WHERE type = 'Super Admin'
		       LIMIT 1";
 
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		$error = 'Error querying table';
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false && $role == "Super Admin"){
		$error = "Super Admin already exists.";
		return true;
	}else
		return false;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	function uname_exist($username){
	global $msg, $dbh, $error;
 
	$sql_select = "SELECT username
		       FROM user
		       WHERE username = " . $dbh->quote($username) . "
		       LIMIT 1";
 
	$stmt = $dbh->query($sql_select);
 
	if($stmt === false){
		$error = 'Error querying table';
		return NULL;
	}
	$r = $stmt->fetch(PDO::FETCH_ASSOC);
	if($r !== false){
		$error = "Username $username already exists.";
		return true;
	}else
		return false;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
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
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	function activate($indexno){
		global $msg, $dbh, $error;
		$sql_select = "SELECT activate
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
			
			$Password = $result->Password;
		}
			return $Password;
		}else
			return false;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	function no($pid){
		global $msg, $dbh, $error;
		$sql_select = "SELECT Count(`no`) AS `NO`
FROM
voted
INNER JOIN voters ON voted.indexNo = voters.indexNo
WHERE
voters.voted = 1 AND
voted.pid = ". $dbh->quote($pid) ." AND
voted.`no` = 1";
		$stmt = $dbh->query($sql_select);
	 
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
		foreach($r as $result)
		{
			
			$not = $result->NO;
		}
			return $not;
		}else
			return false;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D
	function skipped($pid){
		global $msg, $dbh, $error;
		$no = 1;
		$sql_select = "SELECT
Count(voted.skipped) AS SKIP
FROM
voted
INNER JOIN voters ON voted.indexNo = voters.indexNo
WHERE
voters.voted = 1 AND
voted.pid = ". $dbh->quote($pid) ." AND
voted.skipped = 1";
		$stmt = $dbh->query($sql_select);
	 
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
		foreach($r as $result)
		{
			
			$not = $result->SKIP;
		}
			return $not;
		}else
			return false;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D	
function YesNoPercent($num,$no){
		global $dbh;
		$sql_select = "SELECT
Count(*) AS SKIP
FROM
voted
INNER JOIN voters ON voted.indexNo = voters.indexNo
WHERE
(voted.yes = 1 OR
voted.`no` = 1) AND
voted.pid = ". $dbh->quote($no)." AND
voters.voted = 1";
		$stmt = $dbh->query($sql_select);
	 
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
		foreach($r as $result)
		{
			$skipped = $result->SKIP;
			$per = $num/$skipped * 100;
			$per = round($per,2);
		}
			return $per;
		}else
			return false;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D	
function UnderVotes(){
		global $msg, $dbh, $error;
		$no = 0;
		$sql_select = "SELECT Count(voted) AS UNDERVOTES FROM voters WHERE voted = " . $dbh->quote($no);
		$stmt = $dbh->query($sql_select);
	 
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
		foreach($r as $result)
		{
			
			$UNDERVOTES = $result->UNDERVOTES;
		}
			return $UNDERVOTES;
		}else
			return false;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D	
function VVOTED(){
		global $msg, $dbh, $error;
		$no = 1;
		$sql_select = "SELECT Count(voted) AS VOTED FROM voters WHERE voted = " . $dbh->quote($no);
		$stmt = $dbh->query($sql_select);
	 
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
		foreach($r as $result)
		{
			
			$VOTED = $result->VOTED;
		}
			return $VOTED;
		}else
			return false;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D	
function TotalVoters(){
		global $msg, $dbh, $error;
		$no = 1;
		$sql_select = "SELECT Count(*) AS VOTERS FROM voters";
		$stmt = $dbh->query($sql_select);
	 
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
		foreach($r as $result)
		{
			
			$VOTED = $result->VOTERS;
		}
			return $VOTED;
		}else
			return false;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D
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
	function getfinalpos(){
		global $msg, $dbh, $error;
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT DISTINCT PositionID FROM tblcandidate ORDER BY PositionID DESC";
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
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D
	function canMatric($position){
		global $msg, $dbh, $error;
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT tblcandidate.indexNo FROM tblcandidate WHERE tblcandidate.PositionID = :position ORDER BY tblcandidate.ballotNo ASC";
		$query = $dbh->prepare($sql);
		$query->bindParam(':position', $position);
		$query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		$cnt=1;
		if($query->rowCount() > 0)
		{
			$pos = array();
		foreach($results as $result)
		{ 
		
			$pos[] = ($result->indexNo);
		
		}
			return $pos;
		}else
			return NULL;
}
////////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\D
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
//////////////////////////////////////////////////////////////////////////////////////D
function VotesPercent($num,$no){
		global $dbh;
		$sql_select = "SELECT Sum(votes) AS VOTES FROM tblcandidate WHERE PositionID = ". $dbh->quote($no);
		$stmt = $dbh->query($sql_select);
	 
		if($stmt === false){
			return NULL;
		}
		$r = $stmt->fetchAll(PDO::FETCH_OBJ);
		if($r !== false){
		foreach($r as $result)
		{
			$skipped = $result->VOTES;
			$per = $num/$skipped * 100;
			$per = round($per,2);
		}
			return $per;
		}else
			return false;
}
//////////////////////////////////////////////////////////////////////////////////////D
?>