<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
<?php
include "server.functions.php";

$con = db_connect();
$sql = "SELECT * FROM `count` WHERE 1=1";
$result = $con->query($sql);

if (!$result) {
    $message  = 'Wrong Query: ' . mysql_error() . "\n";
    $message .= 'Query: ' . $sql;
    die($message);
}
$table = "<table border=1>";
$table .= "<tr><td>ID</td><td>User</td><td>Time</td><td>Server Time</td><td>In</td><td>Out</td><td>Transport</td><td>Route</td><td>Mark</td><td>TransportType</td><td>Capability</td><td>Time Table</td><td>Return Back</td><td>GPS_x</td><td>GPS_y</td></tr>";
while ($row = mysqli_fetch_array($result)) {
      $table .= make_line($row);
}
$table .= "</table>";
echo $table;
?>

<?php
function make_line($dat)
{
	$ret = "<tr>";
	for($i = 0; $i < count($dat)/2; $i++)
	{
		$ret.= "<td>".$dat[$i]."</td>";
	}
	$ret .= "</tr>";
	return $ret;
}
?>

<div id="map" style="width: 600px; height: 400px"></div>
