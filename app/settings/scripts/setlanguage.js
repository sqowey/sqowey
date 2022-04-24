function set_lang(lang) {

    // Get all elements
    var lang_buttons = document.getElementsByClassName('language_button');

    // Loop through all elements
    for (var i = 0; i < lang_buttons.length; i++) {

        // Remove the class active_language from all elements
        lang_buttons[i].classList.remove('active_language');
    }

    // Reactivate the button that was clicked
    document.getElementById('lang_button_' + lang).classList.add('active_language');

    // Send the status to "./scripts/setlanguage.php" 
    $.ajax({
        url: "./scripts/setlanguage.php",
        type: "POST",
        data: {
            lang: lang
        },
        success: function(data) {
            console.log(data);
        }
    });

}