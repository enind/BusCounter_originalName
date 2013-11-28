<?php
function db_connect()
{
	$con = mysqli_connect("mysql.hostinger.ru","u403157676_db","891621275","u403157676_bc") or die ("fuck");
	return $con;
}

/* Из массива в объект: */
function arrayToObject($massiv) {
 
  if (is_array($massiv)) :
    $obiect = new StdClass();
 
    foreach ($massiv as $kluch => $znachenie) :
      $obiect->$kluch = $znachenie;
    endforeach;
 
  else :
    $obiect = $massiv;
  endif;
 
  return $obiect;
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
		$ret->admin = $row["admin"];
	}
	return $ret;
}

?>
