//themes.js von CuzImBisonratte
//https://github.com/CuzImBisonratte/themes.js

// Hier kannst du die Farbcodes umstellen
ThemeColorNavLight = "#cccccc";
ThemeColorNavDark = "#35393f";
ThemeColorBackLight = "#f1f1f1";
ThemeColorBackDark = "#282C36";
ThemeColorTextLight = "#508038";
ThemeColorTextDark = "#d9e7d2";
ThemeButtonNameLight = "Hell";
ThemeButtonNameDark = "Dunkel";

// Get all article class elements
var article_mintext_all = document.getElementsByClassName('article-mintext');
var article_title_all = document.getElementsByClassName('article-title');

// Funktion, die die Farbänderungen auführt
function changeToTheme(backgroundColor, navColor, textColor, themeName) {
    document.body.style.backgroundColor = backgroundColor;
    document.getElementById("sideNav").style.backgroundColor = navColor;
    document.body.style.color = textColor;
    document.getElementById("themeToggleButton").innerHTML = themeName;
    for (var i = 0; i < article_mintext_all.length; i++) {
        article_mintext_all[i].style.color = textColor;
    }
    for (var i = 0; i < article_title_all.length; i++) {
        article_title_all[i].style.color = textColor;
    }
}



// Die funktion, die beim aufrufen der Website automatisch gestartet wird
function initializeTheme() {

    // Aktuelles Theme abrufen
    try {
        theme = localStorage.getItem("theme");
    } catch (e) {
        if (e.name == "NS_ERROR_FILE_CORRUPTED") {
            localStorage.clear();
            theme = localStorage.getItem("theme");
        }
    }
    //Theme auf gespeichertes Theme setzen
    if (theme == "light") {

        // Theme ändern
        changeToTheme(ThemeColorBackLight, ThemeColorNavLight, ThemeColorTextLight, ThemeButtonNameLight);
    } else {

        // Theme ändern
        changeToTheme(ThemeColorBackDark, ThemeColorNavDark, ThemeColorTextDark, ThemeButtonNameDark);
    }
}

// Funktion einmal zum Start ausführen
initializeTheme();



// Funktion, die bei Knopfdruck ausgeführt wird
function toggleTheme() {

    // Aktuelles Theme abrufen
    try {
        theme = localStorage.getItem("theme");
    } catch (e) {
        if (e.name == "NS_ERROR_FILE_CORRUPTED") {
            localStorage.clear();
            theme = localStorage.getItem("theme");
        }
    }

    // Theme basierend auf Aktuellem theme ändern
    if (theme == "dark") {

        // Theme ändern
        changeToTheme(ThemeColorBackLight, ThemeColorNavLight, ThemeColorTextLight, ThemeButtonNameLight);

        // Theme-Speicher auf "Hell" setzen
        localStorage.setItem("theme", "light");
    } else {

        // Theme ändern
        changeToTheme(ThemeColorBackDark, ThemeColorNavDark, ThemeColorTextDark, ThemeButtonNameDark);

        // Theme-Speicher auf "Dunkel" setzen
        localStorage.setItem("theme", "dark");
    }
}