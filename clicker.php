<html>
  <head>
    <style>	
      @import "clicker.css" all;
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <script src="cookie.js"></script>
    <script src="jquery.js"></script>
    <script src="clicker.js"></script>
  </head>
  <body onload="UpdateButton();" onkeydown="KeyDown(event);">

    <div class="clicker_box">
      <div class="clicker_button_menu" onclick="ShowMenu()">Меню</div>
      <div id="b_out" class="clicker_button_left clicker_button" onclick="Out()">
     	вЫшло
      </div>
      <div id="b_in" class="clicker_button_right clicker_button" onclick="In()">
     	вОшло
      </div>
      <div id="b_send" class="send_button" onclick="NextStation()">Конец ввода</div>
    </div>
    
    <div id="menu" class="clicker_block_menu">
      <div class="menu_button mb_small" onclick="ReturnBack()">Круг</div>
      <div class="menu_button mb_small" id="time"></div>
      <div class="menu_button" onclick="DecOut();">вЫшел<br>-1<br><span id="menu_b_out"></span></div>
      <div class="menu_button" onclick="DecIn();">вОшел<br>-1<br><span id="menu_b_in"></span></div>
      <div class="menu_button_close" onclick="CloseMenu();">Обратно</div>
    </div>
</body>
</html>
