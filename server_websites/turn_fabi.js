// Load the audio
var audio = new Audio('error/cool.wav');
var audio2 = new Audio('error/cool.wav');

// Movement speed
let speed = 5;

// Image scale
let scale = 2.5;

// Initialize variables
let canvas;
let ctx;
let logoColor;

// create dvd var
let dvd = {
    x: 0,
    y: 0,
    xspeed: 5,
    yspeed: 0.5,
    img: new Image()
};

// The main function
(function main() {

    // Get the canvas 
    canvas = document.getElementById("tv-screen");
    ctx = canvas.getContext("2d");
    dvd.img.src = 'https://cdn.discordapp.com/avatars/567735357534109747/aba4291021643596978ca70d3f0ffc03.webp';

    //Draw the "tv screen"
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    // pick a new color
    pickColor();

    // update the position
    update();
})();

// Update the position
function update() {
    setTimeout(() => {
        ctx.fillStyle = logoColor;
        ctx.fillRect(dvd.x, dvd.y, dvd.img.width * scale, dvd.img.height * scale);
        ctx.drawImage(dvd.img, dvd.x, dvd.y, dvd.img.width * scale, dvd.img.height * scale);

        //Move the logo
        dvd.x += dvd.xspeed;
        dvd.y += dvd.yspeed;

        //Check for collision 
        checkHitBox();

        // 
        update();
    }, speed)
}

//Check for border collision and bounce
function checkHitBox() {
    if (dvd.x + dvd.img.width * scale >= canvas.width || dvd.x <= 0) {
        dvd.xspeed *= -1;
        pickColor();
        audio.play();
    }

    if (dvd.y + dvd.img.height * scale >= canvas.height || dvd.y <= 0) {
        dvd.yspeed *= -1;
        pickColor();
        audio2.play();
    }
}

//Pick a random color in RGB format
function pickColor() {
    r = Math.random() * (254 - 0) + 0;
    g = Math.random() * (254 - 0) + 0;
    b = Math.random() * (254 - 0) + 0;
    logoColor = 'rgb(' + r + ',' + g + ', ' + b + ')';
}