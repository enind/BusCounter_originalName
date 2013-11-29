var msg_fail = "<span class='text_bad'>Неудача. По каким-то причинам создать пользователя не получилось</span>";
var msg_pass_are_not_equal = "<span class='text_bad'>Пароли не совпадают</span>";
function Register()
{
    var dat = {};
    var pass1 = $("#pass1").val();
    var pass2 = $("#pass2").val();
    if(pass1==pass2)
    {
	dat.fio = $("#fio").val();
    	dat.pass=pass1;
	dat.login = $("#login").val();
	dat.type = "reg";
	dat.session = getCookie("session");
	dat.admin = $("#admin").prop("checked");
	var json = JSON.stringify(dat);
	$.ajax(
	    {
		url:"/server.php",
		type:"post",
		data: {json:json},
		success: function(ret)
		{
		    console.log(ret);
		    ret = eval('('+ret+')');
		    if(ret.status)
		    {
			location.href = "register.ok.php?login="+$("#login").val()+"&pass="+$("#pass1").val();
		    }
		    else
		    {
			$("#status").html(msg_fail);
		    }
		}
	    });
	
    }
    else
    {
	$("#status").html(msg_pass_are_not_equal);
    }
    return false;
}
