<html>
<head>
	<style>	
	@import "clicker.css" all;
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<script src="cookie.js"></script>
	<script src="jquery.js"></script>
	<script src="clicker.js"></script>
</head>
<body onload="UpdateButton();">
      <div class="clicker_box">
      	   <div id="b_out" class="clicker_button_left clicker_button" onclick="Out()">
     	   	вЫшел
     	  </div>
    	  <div id="b_in" class="clicker_button_right clicker_button" onclick="In()">
     	   	вОшел
     	</div>
	<div id="b_send" class="send_button" onclick="NextStation()">Отправить</div>
	</div>
</body>
</html>
