var msg_wrong_pass = "<span class='text_bad'>Login or password are incorrect</span>";
function Login()
{
    var dat = {};
    dat.login = $("#login").val();
    dat.pass = $("#pass").val();
    dat.type = "auth";
    var json = JSON.stringify(dat);
    $.ajax(
	{
	    url:"/server.php",
	    type:"post",
	    data: {json:json},
	    success: function(ret)
	    {
		ret = eval('('+ret+')');
		if(ret.status)
		{
		    setCookie("transport",$("#transport").val(),{expires: 8*60*60});
		    setCookie("session",""+ret.session,{expires: 8*60*60});
		    location.href = "/clicker.php";
		}
		else
		{
		    $("#status").html(msg_wrong_pass);
		}
	    }
	});
    return false;
}