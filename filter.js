$(document).ready(function()
		  {
		      $(".add_condition").each(function()
					       {
						   $(this).click(ClickAddCondition);
					       });
		  });

function ClickAddCondition()
{
    var tp = $(this).attr("data-field");
    var val = "'"+$(this).prev().val()+"'";
    console.log(val);
    console.log(tp);
    if((tp=="user") || (tp=="mark") || (tp=="route"))
    {
	AddQuery(tp+"="+val);
    }
    if(tp=="date")
    {
	AddQuery("CAST(time as date)="+val);
    }
    if(tp=="time")
    {
	from = "'"+$("#time_from").val()+"'";
	to =  "'"+$("#time_to").val()+"'";
	AddQuery("CAST(time as time) between "+from+" and "+to+"");
    }
    if(tp=="return_back")
    {
	st = ($("#ret_back").prop("checked")?1:0);
	AddQuery("return_back="+st);
    }
    if(tp=="there_is_coords")
    {
	if($("#ret_back").prop("checked"))
	{
	    AddQuery("GPS_x<>0");
	}
	else
	{
	    AddQuery("GPS_x=0");
	}
    }
}

function AddQuery(str)
{
    $("#q").val($("#q").val()+" and "+str);
}
