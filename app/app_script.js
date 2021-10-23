onlineDiv = document.getElementById("online");
awayDiv = document.getElementById("away");
disturbDiv = document.getElementById("notDisturb");

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
}