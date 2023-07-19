
// let Gallary =[
//     'url(../Design/images/portfolio-2.jpg)',
//     'url(../Design/images/portfolio-1.jpg)',
//     'url(../Design/images/portfolio-3.jpg)',
// ];

//Initializing
var i = 0;
var images = []; //array
var time = 1500; // time in millie seconds

//images

images[0] = 'url(../Design/images/portfolio-2.jpg)';
images[1] = 'url(../Design/images/portfolio-1.jpg)';
images[2] = 'url(../Design/images/portfolio-3.jpg)';
//function

function changeImage() {
    var el =    document.getElementById('test');

    el.style.backgroundImage = images[i];
    if (i < images.length - 1) {
        i++;
    } else {
        i = 0;
    }
    setTimeout('changeImage()', time);
}

window.onload = changeImage;
