var msg_wrong_pass = "<span class='text_bad'>Login or password are worng</span>";
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