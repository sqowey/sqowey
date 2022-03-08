// Get the message from the url
// Its the string between the ?message= and the &
// If there is no & in the url the message goes to the end of the url

// Get the url
var url = window.location.href;

// Check if there is an ?message= in the url
if (url.indexOf("?message=") > -1) {

    var message = url.split('?message=')[1];
    if (message == undefined) {
        message = url.split('&')[0];
    }
    // Replace all %20 with spaces
    message = message.replace(/%20/g, ' ');
    // Replace all %3cbr%3e with <br>
    message = message.replace(/%3Cbr%3E/g, '<br>');
    document.getElementById("errorOutputContainer").innerHTML = "<div id='errorOutput'>" + message + "</div>";
}