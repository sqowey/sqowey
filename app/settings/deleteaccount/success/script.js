// 
// Time
// 

// Get the url
var url = window.location.href;

// Check if there is an ?c= in the url
if (url.indexOf("?t=") > -1) {

    var time = url.split("?t=")[1];
    if (time > 0) {
        var message = "Dein Account wird in " + time + " Tagen gelöscht.";
    } else {
        var message = "Dein Account wird schnellstmöglich gelöscht.";
    }
    document.getElementById("title").innerHTML = message;
}