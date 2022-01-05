//themes.js von CuzImBisonratte
//https://github.com/CuzImBisonratte/themes.js

// 
// Farbcodes
// 

// Navigation - Hintergrund
ThemeDarkNavBackground = "#111111";
ThemeLightNavBackground = "#ffffff";

// Navigation - Text
ThemeDarkNavText = "#ffffff";
ThemeLightNavText = "#000000";

// Seite - Hintergrund
ThemeDarkBackground = "#000000";
ThemeLightBackground = "#eff1d0";

// Seite - Normaler Text
ThemeDarkText = "#ffffff";
ThemeLightText = "#000000";

// Seite - Überschriften
ThemeDarkTitles = "#6aaa4b";
ThemeLightTitles = "#355525";

// Besonderheiten
ThemeLightExtra = "#22aacc";
ThemeDarkExtra = "#ffccaa";


// Theme - Name
ThemeDarkName = "Dunkel";
ThemeLightName = "Hell";

varset = document.documentElement;

// 
// The functions
// 

// The function to change to the light Theme
function toLight() {
    varset.style.setProperty('--body-background-color', ThemeLightBackground);
    varset.style.setProperty('--nav-background-color', ThemeLightNavBackground);
    varset.style.setProperty('--text-color', ThemeLightText);
    varset.style.setProperty('--title-color', ThemeLightTitles);
    varset.style.setProperty('--nav-text-color', ThemeLightNavText);
    varset.style.setProperty('--extra-color', ThemeLightExtra);
    document.getElementById("themeToggleButton").innerHTML = ThemeLightName;
}


// The function to change to the dark theme
function toDark() {
    varset.style.setProperty('--body-background-color', ThemeDarkBackground);
    varset.style.setProperty('--nav-background-color', ThemeDarkNavBackground);
    varset.style.setProperty('--text-color', ThemeDarkText);
    varset.style.setProperty('--title-color', ThemeDarkTitles);
    varset.style.setProperty('--nav-text-color', ThemeDarkNavText);
    varset.style.setProperty('--extra-color', ThemeDarkExtra);
    document.getElementById("themeToggleButton").innerHTML = ThemeDarkName;
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
        toLight();
    } else {

        // Theme ändern
        toDark();
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
        toLight();

        // Theme-Speicher auf "Hell" setzen
        localStorage.setItem("theme", "light");
    } else {

        // Theme ändern
        toDark();

        // Theme-Speicher auf "Dunkel" setzen
        localStorage.setItem("theme", "dark");
    }
}