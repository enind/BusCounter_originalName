<?php
function db_connect()
{
  //host, user, passwd, db_name
	$con = mysqli_connect("mysql.hostinger.ru","u179731146_bc","2143658709","u179731146_db") or die ("Erroe at connecting: ".mysqli_error($con));
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
