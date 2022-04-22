function push_privacy() {

    window.setTimeout(function() {
        // Convert the status to an int
        var privacy_messages = 0;
        var privacy_friends = 0;

        // Check if the button with id "privacy_all_dms" is active
        if (document.getElementById("privacy_all_dms").classList.contains('button_active')) {

            // Set the status to 2
            privacy_messages = 2;

        } else if (document.getElementById("privacy_server_dms").classList.contains('button_active')) {

            // Set the status to 1
            privacy_messages = 1;
        }

        // Check if the button with id "privacy_all_friends" is active
        if (document.getElementById("privacy_all_friends").classList.contains('button_active')) {

            // Set the status to 2
            privacy_friends = 2;

        } else if (document.getElementById("privacy_server_friends").classList.contains('button_active')) {

            // Set the status to 1
            privacy_friends = 1;

        }

        console.log(privacy_messages);
        console.log(privacy_friends);

        // Make a string out of the privacy message var
        privacy_messages = privacy_messages.toString();

        // Make a string out of the privacy friends var
        privacy_friends = privacy_friends.toString();


        // Send the status to "./scripts/setprivacy.php" 
        $.ajax({
            url: "./scripts/setprivacy.php",
            type: "POST",
            data: {
                privacy_messages: privacy_messages,
                privacy_friends: privacy_friends
            },
            success: function(data) {
                console.log(data);
            }
        });

    }, 10);
}