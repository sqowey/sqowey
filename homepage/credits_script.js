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