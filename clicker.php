<?php

?>
<html>
<head>
<style>
@import "clicker.css" all;
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<script src="jquery.js"></script>
<script src="clicker.js"></script>
</head>
<body>
<div class="clicker_box">
     <div class="clicker_button_left clicker_button" onclick="In()">
     	  Out
     </div>
     <div class="clicker_button_right clicker_button" onclick="Out()">
     	  In
     </div>
     <div class="send_button" onclick="NextStation()">Next Station</div>
</div>
</body>
</html>