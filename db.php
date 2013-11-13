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
       $result = $con->query($sql);
    
    if (!$result) {
    $message  = 'Wrong Query: ' . mysql_error() . "\n";
    $message .= 'Query: ' . $sql;
    die($message);
    }
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
      $table .= "<tr><td></td><td></td><td></td><td></td><td>$sum_in</td><td>$sum_out</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
      $table .= "<tr><td>ID</td><td>User</td><td>Time</td><td>Server Time</td><td>In</td><td>Out</td><td>Transport</td><td>Route</td><td>Mark</td><td>TransportType</td><td>Capability</td><td>Time Table</td><td>Return Back</td><td>GPS_x</td><td>GPS_y</td></tr>";
      $table .= "</table>";
    ?>
    <form>
      Запрос: <input type=text name='q' value="<?php echo $q;?>" style="width: 100%;"/><br>
      <input type=submit value="Смотреть"/><br>
      <textarea rows="12" cols="100">
	CAST(time as time) between '12:00:00' and '14:00:00'
	user = 'tuser'
	CAST(time as date) = '2013-10-31'
	mark = 'лиаз'

	Пересечение: AND
	user = 'tuser' and CAST(time as date) = '2013-10-31'

	Объединение: OR
	user = 'kriot' or CAST(time as time) between '12:00:00' and '14:00:00'    
      </textarea>
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
       <script src="map.js"></script>
       <div id="map" style="width: 1000px; height: 800px"></div>
  </body>
</html>
