// Get all needed elements
onlineDiv = document.getElementById("online");
awayDiv = document.getElementById("away");
disturbDiv = document.getElementById("disturb");

// The function to change the status when a button is clicked
function changeStatus(status) {
    onlineDiv.innerHTML = '<i onclick="changeStatus(\'online\');" class="far fa-circle"></i>';
    awayDiv.innerHTML = '<i onclick="changeStatus(\'away\');" class="far fa-circle"></i>';
    disturbDiv.innerHTML = '<i onclick="changeStatus(\'disturb\');" class="far fa-circle"></i>';
    switch (status) {
        case ("online"):
            onlineDiv.innerHTML = '<i class="fas fa-circle"></i>';
            break;
        case ("away"):
            awayDiv.innerHTML = '<i class="fas fa-circle"></i>';
            break;
        case ("disturb"):
            disturbDiv.innerHTML = '<i class="fas fa-circle"></i>';
            break;
    }

    // Send the status to ajax "setStatus.php" 
    $.ajax({
        url: "setStatus.php",
        type: "POST",
        data: {
            status: status
        },
        success: function(data) {
            console.log(data);
        }
    });
}

function init_status() {
    $.ajax({
        url: "getStatus.php",
        type: "GET",
        success: function(data) {
            changeStatus(data);
        }
    });
}
init_status();

// Check if there are any key combinations that are pressed
// ctrl + s | go to settings.php
// ctrl + l | go to logout.php
document.addEventListener('keydown', function(event) {
    if (event.ctrlKey && event.key == "s") {
        window.location.href = "settings.php";
    } else if (event.ctrlKey && event.key == "l") {
        window.location.href = "./account/logout.php";
    }
});