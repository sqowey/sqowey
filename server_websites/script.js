var background = new Audio('error/aufzug.mp3');

function turnFabi() {
    background.addEventListener('ended', function() {
        this.currentTime = 0;
        this.play();
    }, false);
    background.play();

    document.getElementById("tv-screen").style.display = "inline";
    document.getElementById("main").style.display = "none";
}











