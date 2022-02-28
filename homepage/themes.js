//themes.js von CuzImBisonratte
//https://github.com/CuzImBisonratte/themes.js

// 
// Farbcodes
// 

// Navigation - Hintergrund
ThemeDarkNavBackground = "#20232d";
ThemeLightNavBackground = "#eeeeff";

// Navigation - Text
ThemeDarkNavText = "#ffffff";
ThemeLightNavText = "#111111";

// Seite - Hintergrund
ThemeDarkBackground = "#282c36";
ThemeLightBackground = "#ffffff";

// Seite - Normaler Text
ThemeDarkText = "#ffffff";
ThemeLightText = "#000000";

// Seite - Überschriften
ThemeDarkTitle = "#6aaa4b";
ThemeLightTitle = "#05386b";

// Besonderheiten
ThemeLightExtra = "#ff8888";
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
    varset.style.setProperty('--title-color', ThemeLightTitle);
    varset.style.setProperty('--nav-text-color', ThemeLightNavText);
    varset.style.setProperty('--extra-color', ThemeLightExtra);
    document.getElementById("themeToggleButton").innerHTML = ThemeLightName;
}


// The function to change to the dark theme
function toDark() {
    varset.style.setProperty('--body-background-color', ThemeDarkBackground);
    varset.style.setProperty('--nav-background-color', ThemeDarkNavBackground);
    varset.style.setProperty('--text-color', ThemeDarkText);
    varset.style.setProperty('--title-color', ThemeDarkTitle);
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
        if (e) {
            localStorage.clear();
            theme = localStorage.getItem("theme");
        }
    }

    // show the switch button
    document.getElementById("themeButton").style.display = "inherit";


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