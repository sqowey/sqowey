// Get all elements

// Get the privacy-status from "./scripts/getprivacy.php" 
$.ajax({
    url: "./scripts/getlanguage.php",
    type: "GET",
    data: {},
    success: function(data) {
        document.getElementById("lang_button_" + data).classList.add("active_language");
    }
});