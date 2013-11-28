<html>
<head>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
     <script src="jquery.js"></script>
     <meta charset="utf-8"/>
     </head>
     <body>
     <h1>Control Panel</h1>
     <?php
     
     include "server.functions.php";
$con = db_connect();
$auth  = check_auth($_COOKIE["session"]);
if(!$auth->auth) die ("Вы не авторизованы<br>You are not authorized<br><a href='/'>Login</a>");
if(isset($_REQUEST["q"]))
{
    $q = $_REQUEST["q"];
}
else
{
    $q = "1=1";
}
if($q=="") $q = "1=1";
$sql = "SELECT * FROM `count` WHERE ".$q;
$sqlmin = "SELECT MIN(time) AS mintime FROM count WHERE ".$q;
$sqlmax = "SELECT MAX(time) AS maxtime FROM count WHERE ".$q;

$result = $con->query($sql);
    
if (!$result) {
    $message  = 'Wrong Query: ' . $con->error . "\n";
    $message .= 'Query: ' . $sql;
    die($message);
}

$min_res = $con->query($sqlmin);
$max_res = $con->query($sqlmax);
$row =  mysqli_fetch_array($min_res);
$mintime = $row["mintime"];

$row =  mysqli_fetch_array($max_res);
$maxtime = $row["maxtime"];


$table = "<table border=1 width=100%>";
$table .= "<tr><td>ID</td><td>User</td><td>Time</td><td>Server Time</td><td>In</td><td>Out</td><td>Transport</td><td>Route</td><td>Mark</td><td>TransportType</td><td>Capability</td><td>Time Table</td><td>Return Back</td><td>GPS_x</td><td>GPS_y</td></tr>";
$data = array();
$sum_in = 0;
$sum_out = 0;

while ($row = mysqli_fetch_array($result)) {
    $table .= make_line($row);
    $data[] = arrayToObject($row);
    $sum_in += $row['in'];
    $sum_out += $row['out'];
}
$datajson = json_encode($data);
$table .= "<tr><td></td><td></td><td style='text-align:right'>С: $mintime<br>По: $maxtime</td><td></td><td>$sum_in</td><td>$sum_out</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
$table .= "<tr><td>ID</td><td>User</td><td>Time</td><td>Server Time</td><td>In</td><td>Out</td><td>Transport</td><td>Route</td><td>Mark</td><td>TransportType</td><td>Capability</td><td>Time Table</td><td>Return Back</td><td>GPS_x</td><td>GPS_y</td></tr>";
$table .= "</table>";
?>
<form>
Запрос: <input type=text id="q" name='q' value="<?php echo $q;?>" style="width: 100%;"/><br>
    <textarea rows="12" cols="100">
    CAST(time as time) between '12:00:00' and '14:00:00'
    user = 'tuser'
    CAST(time as date) = '2013-10-31'
    mark = 'лиаз'

    Пересечение: AND
     user = 'tuser' and CAST(time as date) = '2013-10-31'

     Объединение: OR
     user = 'kriot' or CAST(time as time) between '12:00:00' and '14:00:00'    
     </textarea><br>
    Добавить условия в запрос:<br>
    <table>
      <tr><td>Пользователь:</td><td><input type="text" class="condition"><input type="button" value="Применить" class="add_condition" data-field="user"></td></tr>
      <tr><td>Дата:</td><td><input type="text" class="condition" value="2013-10-31"><input type="button" value="Применить" class="add_condition" data-field="date"></td></tr>
      <tr><td>Время:</td><td><input type="text" id="time_from" class="condition" value="12:00:00"><input type="text" id="time_to" class="condition" value="14:00:00"><input type="button" value="Применить" class="add_condition" data-field="time"></td></tr>
      <tr><td>Марка:</td><td><input type="text" class="condition"><input type="button" value="Применить" class="add_condition" data-field="mark"></td></tr>
      <tr><td>Маршрут:</td><td><input type="text" class="condition"><input type="button" value="Применить" class="add_condition" data-field="route"></td></tr>
      <tr><td>Конечная:</td><td><input type="checkbox" id="ret_back" class="condition"><input type="button" value="Применить" class="add_condition" data-field="return_back"></td></tr>
      <tr><td>Есть координаты:</td><td><input type="checkbox" id="is_there_coords" class="condition"><input type="button" value="Применить" class="add_condition" data-field="there_is_coords"></td></tr>
    </table>
    <input type=button value="Сбросить условия" onclick="location.href='/db.php?q=1=1'"/><input type=submit value="Смотреть"/><br>
    
     </form>
     <script>
     var data = <?php echo $datajson?>;
</script>
<?php echo $table?>
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
     <script src="filter.js"></script>
     <script src="map.js"></script>
     <div id="map" style="width: 1000px; height: 800px"></div>
     </body>
</html>
     
