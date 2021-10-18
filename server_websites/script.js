var background = new Audio('error/aufzug.mp3');

function portal() {
    location.href = "../homepage/index.html"
}

function turnFabi() {
    background.addEventListener('ended', function() {
        this.currentTime = 0;
        this.play();
    }, false);
    background.play();

    document.getElementById("tv-screen").style.display = "inline";
    document.getElementById("main").style.display = "none";
}

function back() {
    background.stop();
    document.getElementById("tv-screen").style.display = "none";
    document.getElementById("backButtonDiv").style.display = "none";
    document.getElementById("main").style.display = "inline";
}