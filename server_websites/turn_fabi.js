var audio = new Audio('error/cool.wav');
var audio2 = new Audio('error/cool.wav');

let speed = 4;
let scale = 2; // Image scale (I work on 1080p monitor)
let canvas;
let ctx;
let logoColor;

let dvd = {
    x: 0,
    y: 0,
    xspeed: 5,
    yspeed: 0.5,
    img: new Image()
};

(function main() {
    canvas = document.getElementById("tv-screen");
    ctx = canvas.getContext("2d");
    dvd.img.src = 'https://cdn.discordapp.com/avatars/567735357534109747/aba4291021643596978ca70d3f0ffc03.webp';

    //Draw the "tv screen"
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    pickColor();
    update();
})();

function update() {
    setTimeout(() => {
        //Draw the canvas background
        // ctx.fillStyle = '#fff';
        // ctx.fillRect(0, 0, canvas.width, canvas.height);
        //Draw DVD Logo and his background
        ctx.fillStyle = logoColor;
        ctx.fillRect(dvd.x, dvd.y, dvd.img.width * scale, dvd.img.height * scale);
        ctx.drawImage(dvd.img, dvd.x, dvd.y, dvd.img.width * scale, dvd.img.height * scale);
        //Move the logo
        dvd.x += dvd.xspeed;
        dvd.y += dvd.yspeed;
        //Check for collision 
        checkHitBox();
        update();
    }, speed)
}

//Check for border collision
function checkHitBox() {
    if (dvd.x + dvd.img.width * scale >= canvas.width || dvd.x <= 0) {
        dvd.xspeed *= -1;
        pickColor();
        // audio.play();
    }

    if (dvd.y + dvd.img.height * scale >= canvas.height || dvd.y <= 0) {
        dvd.yspeed *= -1;
        pickColor();
        // audio2.play();
    }
}

//Pick a random color in RGB format
function pickColor() {
    r = Math.random() * (254 - 0) + 0;
    g = Math.random() * (254 - 0) + 0;
    b = Math.random() * (254 - 0) + 0;
    logoColor = 'rgb(' + r + ',' + g + ', ' + b + ')';
}