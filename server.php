<?php
function db_connect()
{
	$con = mysqli_connect("mysql.hostinger.ru","u403157676_db","891621275","u403157676_bc") or die ("fuck");
	return $con;
}
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
	     $res = inout($data->bus_in,$data->bus_out,$data->session,$data->transport,$data->route,$data->time,$data->return_back);
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
function inout($in, $out, $session, $transport, $route, $time, $return_back)
{
	global $con;
	$obj = null;
	$ret = check_auth($session);
	$obj->status = $ret->auth;
	if($obj->status)
	{
		$sql = "INSERT INTO `count` (`user`,`time`,`in`,`out`,`transport`,`route`,`server_time`,`return_back`) VALUES ('$ret->login','$time','$in','$out','$transport','$route',NOW(),'$return_back')";
		$con->query($sql);
	}
	return $obj;

}
function check_auth($session)
{
	global $con;
	$sql = "SELECT * FROM `login` WHERE `session`='$session'";
	$result = $con->query($sql);
	$ret->auth = false;
	if($result->num_rows!=0)
	{
		$ret->auth = true;
		$row = (mysqli_fetch_array($result));
		$ret->login = $row["login"];
	}
	return $ret;
}

?>