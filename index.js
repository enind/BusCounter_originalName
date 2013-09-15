function Login()
{
    var dat = {};
    dat.login = $("#login").val();
    dat.pass = $("#pass").val();
    var json = JSON.stringify(dat);
    $.ajax(
	{
	    url:"/server.php",
	    type:"post",
	    data: {json:json},
	    success: function(ret)
	    {
		alert(ret);
	    }
	});
    return false;
}