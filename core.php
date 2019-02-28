<? require_once("SiteConfigVars.php");
$dbc = mysql_connect(getConfigValue("dbHost_w_cab"),"w-cab",getConfigValue("dbPass_w_cab"));
mysql_select_db("w_cab",$dbc);

date_default_timezone_set('America/New_York');

//IP functions
function getIP() {
	$ip = (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown") ? getenv("HTTP_CLIENT_IP") : (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"),"unknown") ? getenv("HTTP_X_FORWARDED_FOR") : (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"),"unknown") ? getenv("REMOTE_ADDR") : (isset($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'],"unknown") ? $_SERVER['REMOTE_ADDR'] : ""))));
	if (strpos($ip,",") !== false) {
		$exp = explode(",",$ip);
		$ip = $exp[0];
	} //end strpos($ip,",") !== false IF
	return ($ip);
} //end getIP
function IPhex($ip) {
	$exp = explode(".",$ip);
	foreach ($exp as $dec) {
		$hex .= str_pad(dechex($dec),2,"0",STR_PAD_LEFT);
	} //end $exp as $dec FOREACH
	return ($hex);
} //end IPhex
function hexIP($hex) {
	return (implode(".",array(hexdec(substr($hex,0,2)),hexdec(substr($hex,2,2)),hexdec(substr($hex,4,2)),hexdec(substr($hex,6,2)))));
} //end hexIP

//User functions
function authenticateUser($user,$pass) {
	$auth_query = "SELECT COUNT(*) FROM `staff` WHERE `user`='".addslashes($user)."' AND `pass`='".sha1(md5($pass))."' AND `active`='1' LIMIT 1";
	$auth_result = mysql_query($auth_query);
	$auth = mysql_fetch_array($auth_result);
	return ($auth[0] == 1 && userCan($user,"sf") ? true : false);
} //end authenticateUser
function sessionExists($id) {
	$exists_query = "SELECT COUNT(*) FROM `sf_sessions` WHERE `id`='".addslashes($id)."' LIMIT 1";
	$exists_result = mysql_query($exists_query);
	$exists = mysql_fetch_array($exists_result);
	return ($exists[0] == 1 ? true : false);
} //end sessionExists
function sessionBoundTo($id,$ip) {
	$bound_query = "SELECT COUNT(*) FROM `sf_sessions` WHERE `id`='".addslashes($id)."' AND `ip`='".IPhex($ip)."' LIMIT 1";
	$bound_result = mysql_query($bound_query);
	$bound = mysql_fetch_array($bound_result);
	return ($bound[0] == 1 ? true : false);
} //end sessionBoundTo
function getSessionDetail($want,$have,$input) {
	$detail_query = "SELECT `".$want."` FROM `sf_sessions` WHERE `".$have."`='".addslashes($input)."' LIMIT 1";
	$detail_result = mysql_query($detail_query);
	$detail = mysql_fetch_assoc($detail_result);
	return ($detail[$want]);
} //end getSessionDetail
function userExists($user) {
	$exists_query = "SELECT COUNT(*) FROM `staff` WHERE `user`='".addslashes($user)."' AND `active`='1' LIMIT 1";
	$exists_result = mysql_query($exists_query);
	$exists = mysql_fetch_array($exists_result);
	return ($exists[0] == 1 && userCan($user,"sf") ? true : false);
} //end userExists
function getStaffDetail($want,$have,$input) {
	$detail_query = "SELECT ".($want == "name" ? "CONCAT(`first`,' ',`last`) AS `name`" : "`".$want."`")." FROM `staff` WHERE `".$have."`='".$input."' ORDER BY `id` DESC LIMIT 1";
	$detail_result = mysql_query($detail_query);
	$detail = mysql_fetch_assoc($detail_result);
	return ($detail[$want]);
} //end getStaffDetail
function userCan($user,$action) {
	$can_query = "SELECT `".$action."` FROM `staff_privileges` WHERE `id`='".getStaffDetail("id","user",$user)."' LIMIT 1";
	$can_result = mysql_query($can_query);
	$can = mysql_fetch_assoc($can_result);
	return ($can[$action] == 1 ? true : false);
} //end userCan
function userIsStaff($user) {
	return (eregi("[a-z]{3}cab$",$user) || in_array($user,array("cabgrad","latenite")) ? true : false);
} //end userIsStaff

//Group functions
function authenticateGroup($user,$pass) {
	$auth_query = "SELECT COUNT(*) FROM `sf_groups` WHERE `user`='".addslashes($user)."' AND `pass`='".sha1(md5($pass))."' LIMIT 1";
	$auth_result = mysql_query($auth_query);
	$auth = mysql_fetch_array($auth_result);
	return ($auth[0] == 1 ? true : false);
} //end authenticateGroup
function groupExists($user) {
	$exists_query = "SELECT COUNT(*) FROM `sf_groups` WHERE `user`='".addslashes($user)."' LIMIT 1";
	$exists_result = mysql_query($exists_query);
	echo mysql_error();
	$exists = mysql_fetch_array($exists_result);
	return ($exists[0] == 1 ? true : false);
} //end groupExists
function getGroupDetail($want,$have,$input) {
	$detail_query = "SELECT `".$want."` FROM `sf_groups` WHERE `".$have."`='".addslashes($input)."' LIMIT 1";
	$detail_result = mysql_query($detail_query);
	$detail = mysql_fetch_assoc($detail_result);
	return ($detail[$want]);
} //end getGroupDetail

//Event functions
function eventExists($id) {
	$exists_query = "SELECT COUNT(*) FROM `sf_events_new` WHERE `id`='".intval($id)."' LIMIT 1";
	$exists_result = mysql_query($exists_query);
	$exists = mysql_fetch_array($exists_result);
    return true;
	//return ($exists[0] == 1 ? true : false);
} //end eventExists
function getEventDetail($want,$have,$input) {
	$detail_query = "SELECT `".$want."` FROM `sf_events_new` WHERE `".$have."`='".addslashes($input)."' LIMIT 1";
	$detail_result = mysql_query($detail_query);
	$detail = mysql_fetch_assoc($detail_result);
	return ($detail[$want]);
} //end getEventDetail

//File functions
function fileExists($id) {
	$exists_query = "SELECT COUNT(*) FROM `sf_files` WHERE `id`='".intval($id)."' LIMIT 1";
	$exists_result = mysql_query($exists_query);
	$exists = mysql_fetch_array($exists_result);
	return ($exists[0] == 1 ? true : false);
} //end fileExists
function getFileDetail($want,$have,$input) {
	$detail_query = "SELECT `".$want."` FROM `sf_files` WHERE `".$have."`='".addslashes($input)."' LIMIT 1";
	$detail_result = mysql_query($detail_query);
	$detail = mysql_fetch_assoc($detail_result);
	return ($detail[$want]);
} //end getFileDetail
function getFileCount($event) {
	$count_query = "SELECT COUNT(*) FROM `sf_files` WHERE `event`='".intval($event)."' LIMIT 1";
	$count_result = mysql_query($count_query);
	$count = mysql_fetch_array($count_result);
	return ($count[0]);
} //end getFileCount

//Mail functions
//require ("/home/www/phpmailer/class.phpmailer.php");
require ("/home/w-cab/phpmailer/class.phpmailer.php");
function sendMail($from,$to,$subject,$body,$text_body) {
	$mail = new PHPMailer();
	$mail->SetLanguage("en","/home/www/phpmailer/");
	$mail->IsSendmail();
	//Set sender/reply information
	$mail->From = $from."@rit.edu";
	$mail->FromName = ($from == "cab" ? "RIT College Activities Board" : getStaffDetail("name","user",$from));
	//Set recipient information
	if (is_array($to)) {
		foreach ($to as $address) {
			$mail->AddAddress($address);
		} //end $to as $address FOREACH
	} else {
		$mail->AddAddress($to);
	} //end is_array($to) IF
	//Set message properties & content
	$mail->WordWrap = 80;
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AltBody = $text_body;
	return ($mail->Send() ? true : $mail->ErrorInfo);
} //end sendMail

//Misc functions
function populateDropdown($with,$current = "") {
	switch ($with) {
		case "awaiting_actions":
			$content = array("select"=>"Select an Action","details"=>"View Details","approve"=>"Approve Event","deny"=>"Deny Event");
		break;
		case "approved_actions":
			$content = array("select"=>"Select an Action","details"=>"View Details","publicity"=>"Print Publicity Form","unapprove"=>"Unapprove");
		break;
		case "file_actions":
			$content = array("select"=>"Select an Action","download"=>"Download File","delete"=>"Delete File");
		break;
		case "days":
			$content = array(1398312000=>"Thursday, April 19th, 2015",1398398400=>"Friday, April 25th, 2014",1398484800=>"Saturday, April 26th, 2014",1398571200=>"Sunday, April 27th, 2014");
		break;
		case "hours":
			$content = array(0=>12);
			for ($i = 1; $i <= 11; $i++) {
				$content[$i] = $i;
			} //end $i = 1; $i <= 11; $i++ FOR
		break;
		case "quarter_hours":
			$content = array(0=>"00",15=>"15",30=>"30",45=>"45");
		break;
		case "ampm":
			$content = array(0=>"AM",12=>"PM");
		break;
		default:
			$content = array("select"=>"Unknown Data Type: ".$with);
	} //end $with SWITCH
	foreach ($content as $value=>$display) {
		echo "<option value=\"".$value."\"".($value == $current ? " selected=\"selected\"" : "").">".$display."</option>";
	} //end $content as $value=>$display FOREACH
} //end populateDropdown ?>