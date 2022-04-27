// Get all elements
var privacy_server_dms = document.getElementById('privacy_server_dms');
var privacy_all_dms = document.getElementById('privacy_all_dms');
var privacy_server_friends = document.getElementById('privacy_server_friends');
var privacy_all_friends = document.getElementById('privacy_all_friends');

// Get the privacy-status from "./scripts/getprivacy.php" 
$.ajax({
    url: "./scripts/getprivacy.php",
    type: "GET",
    data: {},
    success: function(data) {

        // Check if the backcoming data is the wanted data
        if (data.startsWith("DATA:") == true) {

            // Slice the data-string
            data = data.replace("DATA:", "");
            data = JSON.parse(data);

            // Get the settings
            var privacy_messages = data.privacy_messages;
            var privacy_friends = data.privacy_friends;

            // 0 = No button has the class button_active
            // 1 = Normal-button has the class button_active
            // 2 = All-button and normal button have the class button_active
            if (privacy_messages == 0) {
                privacy_server_dms.classList.add("button_inactive");
                privacy_all_dms.classList.add("button_inactive");
            } else if (privacy_messages == 1) {
                privacy_server_dms.classList.add("button_active");
                privacy_all_dms.classList.add("button_inactive");
            } else {
                privacy_server_dms.classList.add("button_active");
                privacy_all_dms.classList.add("button_active");
            }

            if (privacy_friends == 0) {
                privacy_server_friends.classList.add("button_inactive");
                privacy_all_friends.classList.add("button_inactive");
            } else if (privacy_friends == 1) {
                privacy_server_friends.classList.add("button_active");
                privacy_all_friends.classList.add("button_inactive");
            } else {
                privacy_server_friends.classList.add("button_active");
                privacy_all_friends.classList.add("button_active");
            }

        } else {

            console.log(data);
        }

    }
});