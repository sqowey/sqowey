// Get all the used elements 
error_type_div = document.getElementById("error_type");
error_type_button = document.getElementById("error_type_button");
error_type_dropdown = document.getElementById("error_type_dropdown");
error = document.getElementById("error");
account = document.getElementById("account_error");
user = document.getElementById("user");
server = document.getElementById("server");
other = document.getElementById("other");
error_in_button = document.getElementById("error_in_button");
error_in_dropdown = document.getElementById("error_in_dropdown");
app_error_area_div = document.getElementById("app_error_area");
app_error_area_button = document.getElementById("app_error_area_button");
app_error_area_dropdown = document.getElementById("app_error_area_dropdown");
account_error_div = document.getElementById("account_error");
account_error_button = document.getElementById("account_error_button");
account_error_dropdown = document.getElementById("account_error_dropdown");
user_type_div = document.getElementById("user_type");
user_type_button = document.getElementById("user_type_button");
user_type_dropdown = document.getElementById("user_type_dropdown");
user_happened_div = document.getElementById("user_happened");
user_happened_button = document.getElementById("user_happened_button");
user_happened_dropdown = document.getElementById("user_happened_dropdown");

// get the form fields
error_code_field = document.getElementById("errorcode");
title_field = document.getElementById("title");
mail_field = document.getElementById("mail");
problem_field = document.getElementById("problem");
submit_button = document.getElementById("submit");

// The function to show or hide the support-type
function error_type(param) {

    // Hide the error type dropdown 
    error_type_dropdown.style.display = "none";
    switch (param) {
        case ("error"):
            // Change the text on the button
            error_type_button.innerHTML = "Funktionsfehler"

            // Show the matching area
            error.style.display = "block";

            // Hide other non matching areas
            user.style.display = "none";
            server.style.display = "none";
            other.style.display = "none";

            // End the current case
            break;

        case ("account"):
            // Change the text on the button
            error_type_button.innerHTML = "Kontoprobleme"

            // Show the matching area
            account.style.display = "block";

            // Hide other non matching areas
            user.style.display = "none";
            server.style.display = "none";
            other.style.display = "none";

            // End the current case
            break;

        case ("user"):
            // Change the text on the button
            error_type_button.innerHTML = "Nutzer melden"

            // Show the matching area
            user.style.display = "block";

            // Hide other non matching areas
            error.style.display = "none";
            server.style.display = "none";
            other.style.display = "none";

            // End the current case
            break;

        case ("server"):
            // Change the text on the button
            error_type_button.innerHTML = "Server melden"

            // Show the matching area
            server.style.display = "block";

            // Hide other non matching areas
            error.style.display = "none";
            user.style.display = "none";
            other.style.display = "none";

            // Set the error code, so that it can be set to the database
            error_code_field.value = "501";

            // End the current case
            break;
        case ("other"):
            // Change the text on the button
            error_type_button.innerHTML = "Sonstiges"

            // Show the matching area
            other.style.display = "block";

            // Hide other non matching areas
            error.style.display = "none";
            user.style.display = "none";
            server.style.display = "none";

            // End the current case
            break;
    }

}

function error_in(param) {

    // Hide the error in dropdown 
    error_in_dropdown.style.display = "none";
    switch (param) {
        case ("app"):
            // Change the text on the button
            error_in_button.innerHTML = "App";

            // Show the matching area
            app_error_area_div.style.display = "block";

            // End the current case
            break;
        case ("home"):
            // Change the text on the button
            error_in_button.innerHTML = "Startseite";

            // Set the error code, so that it can be set to the database
            error_code_field.value = "201";

            // End the current case
            break;
    }
}

function app_error_area(param) {

    // Hide the app error area dropdown 
    app_error_area_dropdown.style.display = "none";
    switch (param) {
        case ("voice"):
            // Change the text on the button
            app_error_area_button.innerHTML = "Sprachkanal";

            // Set the error code, so that it can be set to the database
            error_code_field.value = "101";

            // End the current case
            break;
        case ("text"):
            // Change the text on the button
            app_error_area_button.innerHTML = "Textkanal";

            // Set the error code, so that it can be set to the database
            error_code_field.value = "102";

            // End the current case
            break;
        case ("settings"):
            // Change the text on the button
            app_error_area_button.innerHTML = "Einstellungen";

            // Set the error code, so that it can be set to the database
            error_code_field.value = "103";

            // End the current case
            break;
        case ("other"):
            // Change the text on the button
            app_error_area_button.innerHTML = "Sonstiges";

            // Set the error code, so that it can be set to the database
            error_code_field.value = "104";

            // End the current case
            break;
    }
}

function account_error(param) {

    // Hide the account error dropdown 
    account_error_dropdown.style.display = "none";
    switch (param) {
        case ("email"):
            // Change the text on the button
            account_error_button.innerHTML = "Falsche E-Mail";

            // End the current case
            break;
        case ("age"):
            // Change the text on the button
            account_error_button.innerHTML = "Falsches Alter";

            // End the current case
            break;
        case ("password"):
            // Change the text on the button
            account_error_button.innerHTML = "Passwort vergessen";

            // End the current case
            break;
        case ("other"):
            // Change the text on the button
            account_error_button.innerHTML = "Sonstiges";

            // End the current case
            break;
    }
}

function user_type(param) {

    // Hide the user type dropdowns 
    user_type_dropdown.style.display = "none";
    user_happened_div.style.display = "block";
    switch (param) {
        case ("user"):
            // Change the text on the button
            user_type_button.innerHTML = "Nutzer";

            // Set the start of the error code, so that it can be set to the database
            error_code_field.value = "3";

            // End the current case
            break;
        case ("team"):
            // Change the text on the button
            user_type_button.innerHTML = "Wudsim-Team";

            // Set the start of the error code, so that it can be set to the database
            error_code_field.value = "4";

            // End the current case
            break;
    }

}

function user_happened(param) {

    // Hide the dropdown what happened with the user 
    user_happened_dropdown.style.display = "none";
    switch (param) {
        case ("beleidigung"):
            // Change the text on the button
            user_happened_button.innerHTML = "Beleidigung";

            // Add the error code, so that it can be set to the database
            error_code_field.value = error_code_field.value + "01";

            // End the current case
            break;
        case ("drohung"):
            // Change the text on the button
            user_happened_button.innerHTML = "Drohung";

            // Add the error code, so that it can be set to the database
            error_code_field.value = error_code_field.value + "02";

            // End the current case
            break;
        case ("hacking"):
            // Change the text on the button
            user_happened_button.innerHTML = "Hacking";

            // Add the error code, so that it can be set to the database
            error_code_field.value = error_code_field.value + "03";

            // End the current case
            break;
        case ("scam"):
            // Change the text on the button
            user_happened_button.innerHTML = "Scam";

            // Add the error code, so that it can be set to the database
            error_code_field.value = error_code_field.value + "04";

            // End the current case
            break;
        case ("jung"):
            // Change the text on the button
            user_happened_button.innerHTML = "Zu Jung";

            // Add the error code, so that it can be set to the database
            error_code_field.value = error_code_field.value + "05";

            // End the current case
            break;
        case ("sonstige"):
            // Change the text on the button
            user_happened_button.innerHTML = "Sonstige";

            // Add the error code, so that it can be set to the database
            error_code_field.value = error_code_field.value + "06";

            // End the current case
            break;
    }

}

// The function to look if all form fields are put in
function checkIfSendable() {
    if (error_code_field != "" && title_field != "" && mail_field.value != "" && problem_field != "") {
        submit_button.style.display == "block";
    } else {
        submit_button.style.background = "#254674";
        submit_button.style.display == "none";
    }
}
window.setInterval(checkIfSendable, 100);