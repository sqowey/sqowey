function openCodeInput() {
    var username = document.getElementById("username").value;
    var mail = document.getElementById("mail").value;
    location.assign("two.html?username=" + username + "&mail=" + mail);
}

// Check if url contains "username" and "mail"
if (location.href.indexOf("?username=") > -1 && location.href.indexOf("&mail=") > -1) {
    var username = location.href.split("two.html?username=")[1].split("&mail=")[0];
    var mail = location.href.split("&mail=")[1];
    document.getElementById("username").value = username;
    document.getElementById("mail").value = mail;
}