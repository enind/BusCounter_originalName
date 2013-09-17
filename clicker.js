var in = 0;
var out = 0;
function In()
{
	in++;
}

function Out()
{
    out++;
}
function NextStation()
{
    json = JSON.stringify({type:"inout",in:in,out:out});
    $.ajax({
	url:"/server.php",
	type:"post",
	data: {json:json},
	success: function(ret)
	{
	    alert(ret);
	}
    }
}
