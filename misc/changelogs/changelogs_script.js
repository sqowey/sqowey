// Get the pixel width of the browser window
var width = window.innerWidth;

// Check if 15% of the window width is less than 330px
if (width / 100 * 15 < 330) {

    // Get how many percent of the window is 330px
    var left_side = 330 / width * 100;
    var right_side = 100 - left_side;

    // Set the left and right side of the grid from .container
    document.getElementsByClassName('container')[0].style.gridTemplateColumns = left_side + '% ' + right_side + '%';

}