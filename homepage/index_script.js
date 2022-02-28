// Resize clouds on opening the side menu
function resizeClouds(size) {
    document.getElementById("clouds_light").style.width = size + "px";
    document.getElementById("clouds_light").style.height = size + "px";
    document.getElementById("clouds_dark").style.height = size + "px";
    document.getElementById("clouds_dark").style.width = size + "px";
}


// menu opening and closing
function openNav() {
    document.getElementById("sideNav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    resizeClouds("300");
}

function closeNav() {
    document.getElementById("sideNav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    resizeClouds("400");
}

// Set default for changed ( if dark/light comparison has changed ) to false
changed = false;

// Change dark/light comparison
function darkLightChange() {
    switch (changed) {
        case false:
            document.getElementById("clouds_light").src = "./contents/clouds_dark.png";
            document.getElementById("clouds_dark").src = "./contents/clouds_light.png";
            changed = true;
            break;
        case true:
            document.getElementById("clouds_light").src = "./contents/clouds_light.png";
            document.getElementById("clouds_dark").src = "./contents/clouds_dark.png";
            changed = false;
            break;
    }
}