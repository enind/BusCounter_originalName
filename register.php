<html>
<head>
<meta charset="utf-8"/>
<script src="cookie.js"></script>
<script src="jquery.js"></script>
<script src="register.js"></script>
</head>
<body>
<h1>Регистрировать нового пользователя</h1>
<a href="/db.php">К панели управления</a>
<form action="server.php" onsubmit="Register();return false;" method="post">
<table>
<tr><td>ФИО</td><td><input id="fio"></td></tr>
<tr><td>Login</td><td><input id="login"></td></tr>
<tr><td>Пароль</td><td><input id="pass1"></td></tr>
<tr><td>Повторите пароль</td><td><input id="pass2"></td></tr>
<tr><td>Права администратора</td><td><input id="admin" type="checkbox"></td></tr>
</table>
<div id="status"></div>
<input type="submit" value="Зарегистрировать">
</form>
</body>
</html>