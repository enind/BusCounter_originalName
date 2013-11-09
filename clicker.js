var bus_in = 0;
var bus_out = 0;
var Sending = false;
var MsgWait = "Отправка...";
var MsgNextStation = "Конец ввода";
var MsgErrorConnection = "Соединение отсутсвует. Попробуйте позже.";
var MsgErrorAuth = "Вы не авторизованы. <a href='/index.php'>Авторизация</a>.";
var SendData = new Array();
var dat_n = 0;
var GPS_x = 0;
var GPS_y = 0;
setInterval(UpdateGPS,1000);
setInterval(ClearMem,1000);
function UpdateButton()
{
    $("#b_in").html("вОшло<br>"+bus_in);
    $("#b_out").html("вЫшло<br>"+bus_out);
    $("#menu_b_in").html(bus_in);
    $("#menu_b_out").html(bus_out);
}
function In()
{
    bus_in++;
    UpdateButton();
}
function DecIn()
{
    if(bus_in > 0) bus_in--;
    UpdateButton();
}

function Out()
{
    bus_out++;
    UpdateButton();
}
function DecOut()
{
    if(bus_out > 0) bus_out--;
    UpdateButton();
}
function AddToSend(return_back)
{
    session = getCookie('session');
    transport = getCookie('transport');
    route = getCookie('route');
    transporttype = getCookie('transporttype');
    mark = getCookie('mark');
    capability = getCookie('capability');
    timetable = getCookie('timetable');
    time = new Date();
    time = ''+time.getFullYear()+'-'+(time.getMonth()+1)+"-"+time.getDate()+" "+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds(); 
    json = JSON.stringify(
	{
	    type: "inout",
	    bus_in: bus_in,
	    bus_out: bus_out,
	    session: session,
	    transport: transport,
	    time: time,
	    route: route,
	    transporttype: transporttype,
	    mark: mark,
	    capability: capability,
	    timetable: timetable,
	    return_back: return_back,
	    GPS_x: ""+GPS_x,
	    GPS_y: ""+GPS_y
	});
    console.log(json);
    SendData[dat_n] =
	{
	    json:json,
	    sent:false
	};
    bus_in = 0;
    bus_out = 0;
    dat_n++;
}
function ReturnBack()
{
    AddToSend(true);
    SendAllData();
    UpdateButton();
    CloseMenu();
}
function NextStation()
{
    AddToSend(false);
    SendAllData();
    UpdateButton();
}
function SendAllData()
{
    if(!Sending)
    {
	Sending = true;
	$("#b_send").html(MsgWait);

	for(i = 0; i < dat_n; i++)
	{
	    if(!SendData[i].sent)
	    {
		$.ajax({
		    url:"/server.php",
		    type:"post",
		    data: {json:SendData[i].json},
		    n: i,
		    success: function(ret)
		    {
			console.log(ret);
			ret = eval('('+ret+')');
			if(!ret.status)
			{
			    $("#b_send").html(MsgErrorAuth);
			}
			else
			{
			    SendData[this.n].sent = true;
			}
		    },
		    error: function()
		    {
			$("#b_send").html(MsgErrorConnection);
		    }
		});
	    }
	}
	$("#b_send").html(MsgNextStation);
	Sending = false;
    }
}

function ShowMenu()
{
    $("#menu").css("display","block");
}

function CloseMenu()
{
    $("#menu").css("display","none");
}
function KeyDown(event){
    var keyCode = ('which' in event) ? event.which : event.keyCode;
    console.log (keyCode);
    var left = [81,87,69,82,84,65,83,68,70,71,90,88,67,86,66,37];
    var right = [221,219,222,186,190,191,77,188,75,76,79,80,85,73,72,74,66,78,187,189,8,220,48,57,56,55,39];
    for(i = 0; i < left.length; i++)
    {
	if(keyCode == left[i])
	{
	    Out();
	    return;
	}
    }
    for(i = 0; i < right.length; i++)
    {
	if(keyCode == right[i])
	{
	    In();
	    return;
	}
    }
    if(keyCode == 32)//space
    {
	NextStation();
    }
}
function UpdateGPS()
{
    if (navigator.geolocation)
    {
	navigator.geolocation.getCurrentPosition(UpdateGPSHandler);
    }
    else
    {
	x.innerHTML="Geolocation is not supported by this browser.";
    }
}
function UpdateGPSHandler(position)
{
    GPS_x = position.coords.latitude;
    GPS_y = position.coords.longitude;
    console.log({x:GPS_x,y:GPS_y});
}
function ClearMem()
{
    for(i = 0;i<dat_n;i++)
    {
	if(!SendData[i].sent)
	{
	    return;
	}
    }
    SendData = new Array();
}