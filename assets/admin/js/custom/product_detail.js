if (document.getElementsByClassName('feature-slider')[0] != undefined) {
    var slider = tns({
        container: '.feature-slider',
        loop: true,
        navPosition: "bottom",
        speed: 400,
        nav: false,
        nextButton: true,
        mouseDrag: true,
        controls: false,
        autoplay: true,
        autoplayButtonOutput: false,
        responsive: {
            640: {
                edgePadding: 20,
                gutter: 20,
                items: 1
            },
            700: {
                edgePadding: 20,
                gutter: 30,
                items: 2
            },
            900: {
                edgePadding: 20,
                items: 3
            }
        }
    });
}

tinymce.remove();
tinymce.init({
    selector: '#mytextarea',
    height: "250"
});