<?php
function db_connect()
{
	echo 1;
	$con = mysqli_connect("192.168.100.155","root","2143","busconter") or die ("fuck");
	echo "2";
	return $con;
}
?>
<?php
$data = $_REQUEST["json"];
$data = json_decode($data);
var_dump($data);

$con = db_connect();
echo "olo1";

$result = $con->query($query);

//display information:

while($row = mysqli_fecth_array($result)) {
  echo $row["login"] . "<br>";
}
$con->close();
echo "olo";
?>