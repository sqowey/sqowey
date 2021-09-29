//Funktion um das Menü zu öffnen
function openNav() {
    document.getElementById("sideNav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

//Funktion um das Menü zu schliessen
function closeNav() {
    document.getElementById("sideNav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

// Create a zoom in effect on opening the site
document.body.style.fontSize = "20px";

// Scroll to the imprint if wanted
function scrollImpressum() {
    if (location.search.substring(1).split("&")[0].split("=")[1].replace("%22", "").replace("%22", "").toLowerCase() == "impressum") {
        document.getElementById("impressum").scrollIntoView({ behavior: 'smooth', block: 'start' });
        document.title = "Wudsim - Impressum";
    }
}
setTimeout(scrollImpressum, 500);

// Scroll to top
function toTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    document.title = "Wudsim - Datenschutz";
}