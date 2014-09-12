BusCounter
==========

This is an application for conting people in busses and other transport. It is needed because transport-human streams must be computed and optimazed.

Here is a input panel. It's using in a bus to click buttons 'in' and 'out' for every human that comes or goes. There are system of saving and sending data to database.

Also here is control panel. You can use advanced filter to navigate there. You can see map to realize what is happened.

#Database struct

Table `login`:
 * session - int
 * pass - string
 * login - string
 * admin - boolean
 * fio - string

Table `count`:
 * id - int
 * user - ?
 * time -  
 * in - int
 * out - int
 * transport - 
 * route - 
 * transporttype - 
 * mark - 
 * capability - int
 * timetable - 
 * server_time - 
 * return_back - boolean (is it lastest point of route cycle
 * GPS_x - double
 * GPS_y - double

