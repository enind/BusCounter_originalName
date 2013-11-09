
ymaps.ready(init);
var myMap;

String.prototype.replaceAll = function(search, replace){
  return this.split(search).join(replace);
}

function init(){     
    myMap = new ymaps.Map ("map", {
        center: [55.76, 37.64],
        zoom: 10
    });
    myMap.controls.add(
	new ymaps.control.ZoomControl()
    );

    for(i=0;i<data.length;i++)
    {
	for(j=0;j<15;j++)
	    delete data[i][''+j];
	console.log(data[i]);
	var longData = (""+JSON.stringify(data[i])+"").replaceAll(",","<br>");
	console.log(longData);
	myPlacemark = new ymaps.Placemark([data[i].GPS_x, data[i].GPS_y], { 
            hintContent: data[i].time+" In:"+data[i].in+" Out"+data[i].out, 
            balloonContent: longData
	})
	
	myMap.geoObjects.add(myPlacemark);
    }
}