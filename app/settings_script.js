// 
// Get all needed elements
// 

// Get the file upload script
const php_script = "upload_avatar.php";

// Get the upload formular
const uploadform = document.getElementById("uploadform");

// Get all account formular items
mail = document.getElementById("account_mail");
username = document.getElementById("account_username");
phone = document.getElementById("account_phone");

// Get all tabs
standart = document.getElementById("standart");
account = document.getElementById("account");
privacy_div = document.getElementById("privacy");
security = document.getElementById("security");
language = document.getElementById("language");
look = document.getElementById("look");
access = document.getElementById("access");
help = document.getElementById("help");
credits = document.getElementById("credits");

// Create a function to get sepcific cookies
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

// 
// Background color changer on value change
// 

// Get initial values
old_mail = mail.value;
old_username = username.value;
old_phone = phone.value;

// The function that get's called repeatedly
function accountDetailsColor() {

    // Check if value has changed and if so set new background color
    if (mail.value != old_mail) {
        mail.style.background = "#4e8fc2"
    } else {
        mail.style.background = "#dee0e4"
    }
    if (username.value != old_username) {
        username.style.background = "#4e8fc2"
    } else {
        username.style.background = "#dee0e4"
    }
    if (phone.value != old_phone) {
        phone.style.background = "#4e8fc2"
    } else {
        phone.style.background = "#dee0e4"
    }
}

// Add an interval-caller for the account function
setInterval(accountDetailsColor, 10);



// 
// Avatar upload
// 


// eventlistener is waiting for submits
uploadform.addEventListener("submit", function(evt) {

    // prevent default
    evt.preventDefault();

    // get the files
    const files = document.querySelector('[type=file]').files;

    // create a form
    const formData = new FormData();

    // repeat it for every file
    for (let i = 0; i < files.length; i++) {

        // pick the right file
        let file = files[i];

        // append the file to the form
        formData.append('files[]', file)
    }

    // send everything to the php script
    fetch(php_script, {
        method: "POST",
        body: formData,
    });
});




// 
// Change settings tab
// 

// Get the tab and show it if it`s in the header
function getToTab() {
    tab_nameSub = location.search.substring(1);
    tab_name = tab_nameSub.split("&")[0];
    tab_name = tab_name.split("=")[1];

    // check if the tab is in the url
    // do this by checking if "tab_name" is in the url and is not null
    if (tab_name != null) {
        changeToTab(tab_name);
    }
}
getToTab();

function changeToTab(tab) {

    // close all tabs
    standart.style.display = "none";
    account.style.display = "none";
    privacy_div.style.display = "none";
    security.style.display = "none";
    language.style.display = "none";
    look.style.display = "none";
    access.style.display = "none";
    help.style.display = "none";
    credits.style.display = "none";

    // open the needed tab
    switch (tab) {
        case ('account'):
            account.style.display = "block";
            break;
        case ('privacy'):
            privacy_div.style.display = "block";
            break;
        case ('security'):
            security.style.display = "block";
            break;
        case ('language'):
            language.style.display = "block";
            break;
        case ('look'):
            look.style.display = "block";
            break;
        case ('access'):
            access.style.display = "block";
            break;
        case ('help'):
            help.style.display = "block";
            break;
        case ('credits'):
            credits.style.display = "block";
            break;
    }
}



// 
// set privacy
// 

// The function that get's called when a button is pressed
function privacy(arg) {



    // Send the arg to setprivacy.php
    $.ajax({
        url: "setprivacy.php",
        type: "POST",
        data: {
            privacy: arg
        },
        success: function(data) {

            // If the backcoming data is "success"
            if (data == "success-reload") {

                // Reload the page to get the new privacy
                // This is done by setting the url to the current page with "?tab_name=privacy" at the end
                location.href = location.href + "?tab_name=privacy";

                // Write log to console
                console.log("success");

            } else {

                // Log the backcoming data
                console.log(data);
            }

        }
    });

}



// 
// set language
// 
function setLanguage(lang) {

    // Set the cookie
    document.cookie = "language=" + lang + "; expires=Sat, 25 Jan 2025 08:18:00 UTC";

    // Get all needed elements
    lang_checks = document.getElementsByClassName("language_check");
    for (i = 0; i < lang_checks.length; i++) {

        // Set all checkboxes to unchecked
        lang_checks[i].innerHTML = '<i class="far fa-circle"></i>'
    }

    // Set the checked checkbox to the selected language
    document.getElementById("language_check_" + lang).innerHTML = '<i class="fas fa-circle"></i>';

    // Post the new language to setlanguage.php
    $.ajax({
        type: 'POST',
        url: 'setlanguage.php',
        data: { language: lang },
        success: function(response) {
            content.html(response);
        }
    });
}
if (getCookie("language") == null) {
    switch (navigator.language) {
        case ("de"):
        case ("en"):
        case ("fr"):
        case ("it"):
            setLanguage(navigator.language);
            break;
        default:
            setLanguage("en");
            break;
    }
} else {
    setLanguage(getCookie("language"));
}