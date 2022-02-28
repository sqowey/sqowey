// Second-Counter
var timer_message_1 = "An Sqowey wird seit ";
var timer_message_2 = " Sekunden gearbeitet.";

function sqoweyTimer() {
    var created = new Date(2021, 08, 07, 19, 05, 58, 0);
    var now = new Date();
    var dif = created.getTime() - now.getTime();

    var Seconds_from_T1_to_T2 = dif / 1000;
    var Seconds_Between_Dates = Math.round(Math.abs(Seconds_from_T1_to_T2));
    document.getElementById("entwicklung").innerHTML = timer_message_1 + Seconds_Between_Dates + timer_message_2;
    window.setTimeout("sqoweyTimer();", 10);
}
sqoweyTimer();

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