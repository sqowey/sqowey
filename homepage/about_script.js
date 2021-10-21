//Funktion um das Menü zu öffnen
function openNav() {
    document.getElementById("sideNav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    resizeClouds("300");
}

//Funktion um das Menü zu schliessen
function closeNav() {
    document.getElementById("sideNav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    resizeClouds("400");
}

// Second-Counter
var timer_message_1 = "An Wudsim wird seit ";
var timer_message_2 = " Sekunden gearbeitet.";

function wudsimTimer() {
    var created = new Date(2021, 08, 07, 19, 05, 58, 0);
    var now = new Date();
    var dif = created.getTime() - now.getTime();

    var Seconds_from_T1_to_T2 = dif / 1000;
    var Seconds_Between_Dates = Math.round(Math.abs(Seconds_from_T1_to_T2));
    document.getElementById("entwicklung").innerHTML = timer_message_1 + Seconds_Between_Dates + timer_message_2;
    window.setTimeout("wudsimTimer();", 10);
}
wudsimTimer();

// Scroll to the imprint if wanted
function scrollImpressum() {
    if (location.search.substring(1).split("&")[0].split("=")[1].replace("%22", "").replace("%22", "").toLowerCase() == "credits") {
        document.getElementById("credits").scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}
setTimeout(scrollImpressum, 500);

// Dropdowns
function dropdown() {
    document.getElementById("inner_dropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}