function happens_in(param) {
    document.getElementById("happens_in").innerHTML = param;
    if (param == 'App') {
        document.getElementById("area").style.display = "block";
    }
}