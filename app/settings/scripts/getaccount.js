// Get all elements
var avatar_left_top = document.getElementById("avatar_left_top");
var name_field = document.getElementById("name_field");
var email_field = document.getElementById("email_field");
var account_settings_mail = document.getElementById("account_settings_mail");
var account_settings_name = document.getElementById("account_settings_username");
var account_settings_phone = document.getElementById("account_settings_phone");
var account_settings_avatar = document.getElementById("account_settings_avatar");


// Get the privacy-status from "./scripts/getaccount.php" 
$.ajax({
    url: "./scripts/getaccount.php",
    type: "GET",
    data: {},
    success: function(data) {

        // Check if the backcoming data is the wanted data
        if (data.startsWith("DATA:") == true) {

            // Slice the data-string
            data = data.replace("DATA:", "");
            data = JSON.parse(data);

            // Get the account info
            var username = data.username;
            var email = data.email;
            var phone = data.phone;
            var avatar = data.avatar;

            // Set the name fields
            name_field.innerHTML = username;
            account_settings_name.value = username;

            // Set the email fields
            email_field.innerHTML = email;
            account_settings_mail.value = email;

            // Set the phone field
            account_settings_phone.value = phone;

            // Set the avatar fields
            avatar_left_top.innerHTML = "<img src='" + avatar + "'>";
            account_settings_avatar.src = avatar;

        } else {

            console.log(data);
        }

    }
});