// Load the background Audio
var background = new Audio('error/aufzug.mp3');

// Funktion Fabi zu drehen
function turnFabi() {

    // Add a loop
    background.addEventListener('ended', function() {
        this.currentTime = 0;
        this.play();
    }, false);

    // Play the sound
    background.play();

    // Display the canvas
    document.getElementById("tv-screen").style.display = "inline";

    // Remove the text
    document.getElementById("main").style.display = "none";
}