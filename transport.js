function Transport()
{
    setCookie("transport",$("#transport").val(),{expires: 8*60*60}); //gos nomer
    setCookie("route",$("#route").val(),{expires: 8*60*60});
    setCookie("transporttype",$("#transporttype").val(),{expires: 8*60*60});
    setCookie("mark",$("#mark").val(),{expires: 8*60*60});
    setCookie("capability",$("#capability").val(),{expires: 8*60*60});
    setCookie("timetable",$("#timetable").val(),{expires: 8*60*60});
    location.href = "clicker.php";
}