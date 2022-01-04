//themes.js von CuzImBisonratte
//https://github.com/CuzImBisonratte/themes.js

// 
// Farbcodes
// 

// Navigation - Hintergrund
ThemeDarkNavBackground = "#111111";
ThemeLightNavBackground = "#000000";

// Navigation - Text
ThemeDarkNavText = "#ffffff";
ThemeLightNavText = "#000000";

// Seite - Hintergrund
ThemeDarkBackground = "#000000";
ThemeLightBackground = "#ffffff";

// Seite - Normaler Text
ThemeDarkText = "#ffffff";
ThemeLightText = "#000000";

// Seite - Überschriften
ThemeDarkTitles = "#ffffff";
ThemeLightTitles = "#000000"

// Besonderheiten


// Theme - Name
ThemeDarkName = "Dunkel";
ThemeLightName = "Hell";


varset = document.documentElement;



// Funktion, die die Farbänderungen auführt
function changeToTheme(backgroundColor, navColor, textColor, themeName) {
    varset.style.setProperty('--body-background-color', backgroundColor);
    varset.style.setProperty('--nav-background-color', navColor);
    varset.style.setProperty('--text-color', textColor);
    document.getElementById("themeToggleButton").innerHTML = themeName;
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