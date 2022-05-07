// Get the message from the url
// Its the string between the ?c= and the &
// If there is no & in the url the message goes to the end of the url

// Get the url
var url = window.location.href;

// Error messages
const error_messages = {
    "filesize": "The file is too big. Max file size is 5MB.",
    "filetype": "The file type is not supported.",
    "couldntupload": "Could not upload the file. <br>Please try again later.",
    "wrongoldpass": "The old password is wrong.",
    "wrongnewpass": "The new passwords are not the same.",
    "invalidpass": "New password doesn't meet the requirements."
}

// Check if there is an ?m= in the url
if (url.indexOf("?m=") > -1) {

    // Split out the code
    var code = url.split('?m=')[1];
    code = code.split('&')[0];

    // Check if there is a message
    if (code) {
        var message = code;
    }

    console.log(message);

    document.getElementById("output_message").innerHTML = "<div id='output_message_inner'>" + message + "</div>";
}

// Check if there is an ?e= in the url
if (url.indexOf("?e=") > -1) {

    // Split out the code
    var code = url.split('?e=')[1];
    code = code.split('&')[0];

    // Check if there is a message
    if (code) {
        var message = error_messages[code];
    }

    console.log(message);

    document.getElementById("output_message").innerHTML = "<div id='error_message_inner'>" + message + "</div>";
}

document.getElementById("output_message").addEventListener("click", function() {

    // Remove the error message
    document.getElementById("output_message").style.animation = "animation_close_error 0.5s";

    // Remove the error message after the animation is done
    setTimeout(function() {

        // Remove the error message
        document.getElementById("output_message").style.display = "none";

    }, 500);

});