// The messages that refer to the codes
code_messages_en = {
    "00": "Success",
    "01": "Error with<br>the Database",
    "02": "Please fill in<br>all the fields",
    "04": "No user with that password exists",
    "05": "No user with that email exists",
    "06": "No user with that username exists",
    "07": "Supportticket<br>created",
    "08": "EMail changed",
    "09": "Password changed",
    "10": "Username changed",
    "11": "Avatar changed"
};



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