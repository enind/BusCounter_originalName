var bus_in = 0;
var bus_out = 0;
var HaveToWait = false;
var MsgWait = "Отправка...";
var MsgNextStation = "Конец ввода";
var MsgErrorConnection = "Соединение отсутсвует. Попробуйте позже.";
var MsgErrorAuth = "Вы не авторизованы. <a href='/index.php'>Авторизация</a>.";
var SendData = new Array();
var dat_n = 0;
function UpdateButton()
{
    $("#b_in").html("вОшло<br>"+bus_in);
    $("#b_out").html("вЫшло<br>"+bus_out);
    $("#menu_b_in").html(bus_in);
    $("#menu_b_out").html(bus_out);
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
	if(bus_in > 0) bus_in--;
	//CloseMenu();
	UpdateButton();
    }
}

function Out()
{
    if(!HaveToWait)
    {
	bus_out++;
	UpdateButton();
    }
}
function DecOut()
{
    if(!HaveToWait)
    {
	if(bus_out > 0) bus_out--;
	//CloseMenu();
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