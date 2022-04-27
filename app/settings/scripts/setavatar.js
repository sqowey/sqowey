// Add the event listener
document.getElementById("account_settings_avatar_file").addEventListener("change", function() {

    // Get file
    var file = this.files[0];

    // Set the avatar preview
    document.getElementById("account_settings_avatar").src = URL.createObjectURL(file);
});