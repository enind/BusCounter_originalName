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
	case "inout":
	     $red = inout($data->in,$data->out);
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
	}
	else
	{
		$obj->status = false;
	}
/*	
	while($row = mysqli_fetch_array($result)) {
		   echo $row["login"] . "<br>";
		   }
*/
	return $obj;
}
function inout($in, $out)
{
	global $con;
	$obj = null;
	$obj->in = $in;
	$obj->out = $out;
	return $obj;
}
?>