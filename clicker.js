var bus_in = 0;
var bus_out = 0;
var HaveToWait = false;
var MsgWait = "Отправка...";
var MsgNextStation = "Отправить";
var MsgErrorConnection = "Соединение отсутсвует. Попробуйте позже.";
var MsgErrorAuth = "Вы не авторизованы. <a href='/index.php'>Авторизация</a>.";
var SendData = new Array();
var dat_n = 0;
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
function DecIn()
{
    if(!HaveToWait)
    {
	bus_in--;
	CloseMenu();
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
function DecOut()
{
    if(!HaveToWait)
    {
	bus_out--;
	CloseMenu();
	UpdateButton();
    }
}
function AddToSend(return_back)
{
    session = getCookie('session');
    transport = getCookie('transport');
    route = getCookie('route');
    time = new Date();
    time = ''+time.getFullYear()+'-'+(time.getMonth()+1)+"-"+time.getDate()+" "+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds(); 
    json = JSON.stringify({type:"inout",bus_in:bus_in,bus_out:bus_out,session:session,transport:transport,time:time,route:route,return_back:return_back});
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
}

function ShowMenu()
{
    $("#menu").css("display","block");
}

function CloseMenu()
{
    $("#menu").css("display","none");
}