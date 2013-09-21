<style>
@import "style.css" all;
</style>
<script src="jquery.js"></script>
<script src="cookie.js"></script>
<script src="index.js"></script>
<form onsubmit="Login();return false;" action="" method="post">
<table>
	<tr><td>Login:</td><td><input id="login"></td></tr>
	<tr><td>Password:</td><td><input id="pass" type="password"></td></tr>
	<tr><td>Transport:</td><td><input id="transport"></td></tr>
</table>
<div id="status"></div>
<input type=submit>
</form>
