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
<h1>BusCounter</h1>
<form onsubmit="Login();return false;" action="" method="post">
<table>
	<tr><td>Login:</td><td><input id="login"></td></tr>
	<tr><td>Пароль:</td><td><input id="pass" type="password"></td></tr>
</table>
<div id="status"></div>
<input type=submit value="Войти">
</form>
<h1 id="nojs">You have no JavaScript!<br>
  JavaScript не работает</h1>
</body>
</html>
