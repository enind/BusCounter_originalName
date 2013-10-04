<html>
<head>
	<style>
	@import "style.css" all;
	</style>
	<script src="jquery.js"></script>
	<script src="cookie.js"></script>
	<script src="transport.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta charset="utf-8"/>
</head>
<body>
<form onsubmit="Transport();return false;" action="" method="post">
<table>
	<tr><td>Маршрут:</td><td><input id="route"></td></tr>
	<tr><td>Гос. номер:</td><td><input id="transport"></td></tr>
	<tr><td>Марка ТС:</td><td><input id="mark"></td></tr>
	<tr><td>Вид ТС:</td><td><input id="transporttype"></td></tr>
	<tr><td>Мас. вместимость</td><td><input id="capability"></td></tr>
	<tr><td>График движения:</td><td><input id="timetable"></td></tr>
</table>
<div id="status"></div>
<input type=submit value="Сохранить">
</form>

</body>
</html>