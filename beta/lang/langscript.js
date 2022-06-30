// Function to check if the language file exists
function langExists(lang) {

    // Create request to the language file
    var http = new XMLHttpRequest();
    http.open('HEAD', lang, false);

    // Send the request
    http.send();

    // Return if the language file exists
    return http.status != 404;
}


// Function to read the language file
function readLangFile(file, callback) {

    // Create file request
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);

    // Wait for file to be fully read
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {

            // Parse and send back to callback
            callback(JSON.parse(rawFile.responseText));
        }
    }

    // Send null
    rawFile.send(null);
}

// Get the browser language
var lang = navigator.language || navigator.userLanguage;

// Check if the user language is german
if (langExists("./lang/" + lang + ".json")) {

    readLangFile("./lang/" + lang + ".json", function(data) {

        // Get all keys
        var json_keys = Object.keys(data);

        // Loop through the keys
        for (let i = 0; i < json_keys.length; i++) {

            // Get the current key (which is the same as the element id)
            const element_id = json_keys[i];

            // Change the innerHTML 
            document.getElementById(element_id).innerHTML = data[element_id];
        }
    });

}