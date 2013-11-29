<?php
$login = $_REQUEST["login"];
$pass = $_REQUEST["pass"];
?>

<html>
<head>
</head>
<body>
<h1>Пользователь создан!</h1>
<table>
<tr><td>Login</td><td><?php echo $login;?></td></tr>
<tr><td>Пароль</td><td><?php echo $pass;?></td></tr>
</table>
<a href="/db.php">К панели управления</a>
</body>
</html>