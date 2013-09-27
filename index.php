<html>
<head>
	<style>
	@import "style.css" all;
	</style>
	<script src="jquery.js"></script>
	<script src="cookie.js"></script>
	<script src="index.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta charset="utf-8"/>
</head>
<body>

<form onsubmit="Login();return false;" action="" method="post">
<table>
	<tr><td>Login:</td><td><input id="login"></td></tr>
	<tr><td>Пароль:</td><td><input id="pass" type="password"></td></tr>
	<tr><td>Маршрут:</td><td><input id="route"></td></tr>
	<tr><td>Гос. номер:</td><td><input id="transport"></td></tr>
</table>
<div id="status"></div>
<input type=submit value="Войти">
</form>

</body>
</html>