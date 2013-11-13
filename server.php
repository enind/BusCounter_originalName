<?php
include "server.functions.php";
?>
<?php
$data = $_REQUEST["json"];
$data = json_decode($data);
//var_dump($data);

$con = db_connect();
$res = null;
switch($data->type)
{
	case NULL:
	     break;
	case "auth":
	     $res = auth($data->login,$data->pass);
	     break;
	case "inout":
	     $res = inout($data->bus_in,$data->bus_out,$data->session,$data->transport,$data->route,$data->transporttype,$data->mark,$data->capability,$data->timetable,$data->time,$data->return_back,$data->GPS_x,$data->GPS_y);
	     break;
}
echo json_encode($res);
$con->close();
?>

<?php
function auth($login, $pass)
{
	global $con;
	$session = rand(0,100000000);
	$sql = "SELECT * FROM `login` WHERE `login`='$login' AND `pass`='$pass'";
	$result = $con->query($sql);
	$obj = null;
	if($result->num_rows!=0)
	{
		$obj->session = $session;
		$obj->status = true;
		$sql = "UPDATE `login` SET `session`=$session WHERE `login`='$login'";
		$con->query($sql);
	}
	else
	{
		$obj->status = false;
	}
	return $obj;
}
function inout($in, $out, $session, $transport, $route,$transporttype,$mark,$capability,$timetable, $time, $return_back, $GPS_x, $GPS_y)
{
	global $con;
	$obj = null;
	$ret = check_auth($session);
	$obj->status = $ret->auth;
	if($obj->status)
	{
		$sql = "INSERT INTO `count` (`user`,`time`,`in`,`out`,`transport`,`route`,`transporttype`,`mark`,`capability`,`timetable`,`server_time`,`return_back`,`GPS_x`,`GPS_y`) VALUES ('$ret->login','$time','$in','$out','$transport','$route','$transporttype','$mark','$capability','$timetable',NOW(),'$return_back','$GPS_x','$GPS_y')";
		$con->query($sql);
	}
	return $obj;

}

?>