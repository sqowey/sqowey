window.setTimeout(function() {

    // Get the preferred user language
    var lang = navigator.language;

    // Check if the user language is german
    if (lang == "de") {
        // Redirect to the german version
        window.location.replace("de.html");
    } else {
        // Redirect to the english version
        window.location.replace("en.html");
    }

}, 1000);