// Get the pixel width of the browser window
var width = window.innerWidth;

// Check if 15% of the window width is less than 330px
if (width / 100 * 15 < 330) {

    // Get how many percent of the window is 330px
    var left_side = 330 / width * 100;
    var right_side = 100 - left_side;

    // Set the left and right side of the grid from .container
    document.getElementsByClassName('container')[0].style.gridTemplateColumns = left_side + '% ' + right_side + '%';

}


// The function to change the text on the left top corner to logout on mouseover
user_element = document.getElementById("name");
name_element = document.getElementById("name_field");

// Add event listener hover
user_element.addEventListener("mouseover", function() {

    // Change the text of the element
    name_element.innerHTML = "<span style='text-decoration: underline;'>Logout</span>";

});

user_element.addEventListener("mouseout", function() {

    // Change the text of the element
    name_element.innerHTML = 'muster';
});

name_element.addEventListener("click", function() {

    // Change the text of the element
    window.location.href = 'logout.php';

});

// 
// Settings
// 

// 
// Account settings
// 

function editFormAccounts() {

    // Turn displaying for "account_settings_change" off
    document.getElementById("account_settings_change").style.display = "none";

    // Turn displaying for "account_settings_submit" on
    document.getElementById("account_settings_submit").style.display = "block";

    // Get all form elements with class="account_form_inputs" and enable them
    var form_elements = document.getElementsByClassName("account_form_inputs");
    for (var i = 0; i < form_elements.length; i++) {
        form_elements[i].disabled = false;
    }
}

function resetFormAccounts() {

    // Turn displaying for "account_settings_change" on
    document.getElementById("account_settings_change").style.display = "block";

    // Turn displaying for "account_settings_submit" off
    document.getElementById("account_settings_submit").style.display = "none";

    // Get all form elements with class="account_form_inputs" and disable them
    var form_elements = document.getElementsByClassName("account_form_inputs");
    for (var i = 0; i < form_elements.length; i++) {
        form_elements[i].disabled = true;
    }
}

// 
// Security settings
// 

// Password change
function open_pw_change() {

    if (document.getElementById("pw_change").style.display != "block") {

        document.getElementById("pw_change").style.display = "block";
    } else {

        document.getElementById("pw_change").style.display = "none";
    }
}


// 
// Privacy functions
// 
function switch_button(lmnt) {

    // Get the class list of the button
    var class_list = lmnt.classList;

    // Get the id of the button
    var id = lmnt.id;

    // Check if the button is active
    if (class_list.contains('button_active')) {

        // Remove the active class
        class_list.remove('button_active');

        // Add the inactive class
        class_list.add('button_inactive');

        // Check if the id of the button is "privacy_server_dms"
        if (id == "privacy_server_dms") {

            // Check if the button with id "privacy_all_dms" is active
            if (document.getElementById("privacy_all_dms").classList.contains('button_active')) {

                switch_button(document.getElementById("privacy_all_dms"));

            }
        }

        // Check if the id of the button is "privacy_server_friends"
        if (id == "privacy_server_friends") {

            // Check if the button with id "privacy_all_friends" is active
            if (document.getElementById("privacy_all_friends").classList.contains('button_active')) {

                switch_button(document.getElementById("privacy_all_friends"));

            }
        }
    } else {

        // Remove the inactive class
        class_list.remove('button_inactive');

        // Add the active class
        class_list.add('button_active');

        // Check if the id of the button is "privacy_all_dms"
        if (id == "privacy_all_dms") {

            // Check if the button with id "privacy_server_dms" is inactive
            if (document.getElementById("privacy_server_dms").classList.contains('button_inactive')) {

                // Switch the other button
                switch_button(document.getElementById("privacy_server_dms"));
            }
        }

        // Check if the id of the button is "privacy_all_friends"
        if (id == "privacy_all_friends") {

            // Check if the button with id "privacy_server_friends" is inactive
            if (document.getElementById("privacy_server_friends").classList.contains('button_inactive')) {

                // Switch the other button
                switch_button(document.getElementById("privacy_server_friends"));
            }
        }
    }
}

// 
// Infos
// 

function open_changelogs() {

    // Open the changelogs in a new tab
    window.open("../changelogs/", "_blank");
}