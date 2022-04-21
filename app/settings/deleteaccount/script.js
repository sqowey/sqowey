function time_changed() {

    // Get the chosen option value
    var time_until_deletion = document.getElementById("time_until_deletion").value;

    // If the chosen option value is 0 
    if (time_until_deletion == 0) {

        // Edit the submit button
        document.getElementById("submit_button").value = "Account sofort löschen";

        // Add the warning
        document.getElementById("deletion_text").innerHTML = '<div id="warning"><i class="fa-solid fa-triangle-exclamation"></i>Dein Konto wird sofort gelöscht! Bist du dir wirklich sicher?<i class="fa-solid fa-triangle-exclamation"></i><br><br></div>';

    } else {

        // Add the time until deletion to the current time (it's in days)
        var time_until_deletion_in_mills = time_until_deletion * 24 * 60 * 60 * 1000;
        var date = new Date();
        date = date.getTime();
        date = date + time_until_deletion_in_mills;

        // Create a date string (dd.mm.yyyy)
        var date_string = new Date(date);
        date_string = date_string.toLocaleDateString();

        // Add the deletion text
        document.getElementById("deletion_text").innerHTML = 'Dein Konto wird bis zum ' + date_string + ' deaktiviert.<br>Am ' + date_string + ' wird dein Konto entgültig gelöscht.<br>Du kannst dein Konto bis dahin wiederherstellen.<br><br>';

        // Edit the submit button
        document.getElementById("submit_button").value = "Account am " + date_string + "" + " löschen.";
    }
}

time_changed();

document.getElementById("time_until_deletion").addEventListener("change", function() {
    time_changed();
});


// 
// Error message
// 

// Get the url
var url = window.location.href;

// Check if there is an ?c= in the url
if (url.indexOf("?e=wp") > -1) {

    message = "Wrong Password!";

    console.log(message);

    document.getElementById("errorOutputContainer").innerHTML = "<div id='errorOutput'>" + message + "</div>";
}
document.getElementById("errorOutputContainer").addEventListener("click", function() {

    // Remove the error message
    document.getElementById("errorOutputContainer").style.animation = "animation_close_error 0.5s";

    // Remove the error message after the animation is done
    setTimeout(function() {

        // Remove the error message
        document.getElementById("errorOutputContainer").style.display = "none";

    }, 500);

});