function openCodeInput() {
    var username = document.getElementById("username").value;
    var mail = document.getElementById("mail").value;
    location.assign("two.html?username=" + username + "&mail=" + mail);
}

