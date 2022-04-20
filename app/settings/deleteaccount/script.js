function time_changed() {

    // Get the chosen option value
    var time_until_deletion = document.getElementById("time_until_deletion").value;

    // Add the time until deletion to the current time (it's in days)
    var time_until_deletion_in_mills = time_until_deletion * 24 * 60 * 60 * 1000;
    var date = new Date();
    date = date.getTime();
    date = date + time_until_deletion_in_mills;


    // Create a date string (dd.mm.yyyy)
    var date_string = new Date(date);
    date_string = date_string.toLocaleDateString();

    // Edit the submit button
    document.getElementById("submit_button").value = "Account am " + date_string + "" + " löschen.";
}

time_changed();

document.getElementById("time_until_deletion").addEventListener("change", function() {
    time_changed();
});