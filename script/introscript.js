// var slideIndex = 0;
// showSlides();
function showSlides() {
    var splide = new Splide('#slider');
    splide.on('autoplay:playing', function(rate) {
        console.log(rate); // 0-1
    });
    splide.mount();
}