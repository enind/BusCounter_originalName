var bus_in = 0;
var bus_out = 0;
var HaveToWait = false;
var MsgWait = "Отправка...";
var MsgNextStation = "Отправить";
var MsgErrorConnection = "Соединение отсутсвует. Попробуйте позже.";
var MsgErrorAuth = "Вы не авторизованы. <a href='/index.php'>Авторизация</a>.";
function UpdateButton()
{
    $("#b_in").html("вОшел<br>"+bus_in);
    $("#b_out").html("вЫшел<br>"+bus_out);
}
function In()
{
    if(!HaveToWait)
    {
	bus_in++;
	UpdateButton();
    }
}
function DIn()
{
    if(!HaveToWait)
    {
	bus_in--;
	UpdateButton();
    }
}

function Out()
{
    if(!HaveToWait)
    {
	bus_out++;
	CloseMenu();
	UpdateButton();
    }
}
function DOut()
{
    if(!HaveToWait)
    {
	bus_out--;
	CloseMenu();
	UpdateButton();
    }
}

function NextStation()
{
    if(!HaveToWait)
    {
	$("#b_send").html(MsgWait);
	HaveToWait = true;
	session = getCookie('session');
	transport = getCookie('transport');
	route = getCookie('route');
	time = new Date();
	time = ''+time.getFullYear()+'-'+(time.getMonth()+1)+"-"+time.getDate()+" "+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds(); 
	json = JSON.stringify({type:"inout",bus_in:bus_in,bus_out:bus_out,session:session,transport:transport,time:time,route:route});
	$.ajax({
	    url:"/server.php",
	    type:"post",
	    data: {json:json},
	    success: function(ret)
	    {
		ret = eval('('+ret+')');
		if(!ret.status)
		{
		    $("#b_send").html(MsgErrorAuth);
		}
		else
		{
		    $("#b_send").html(MsgNextStation);
		    HaveToWait = false;
		    bus_in = 0;
		    bus_out = 0;
		    UpdateButton();
		}
		
	    },
	    error: function()
	    {
		$("#b_send").html(MsgErrorConnection);
		HaveToWait = false;
	    }
	});
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