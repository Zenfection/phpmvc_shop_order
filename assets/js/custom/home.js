$(function () {
    document.querySelector('.ml11 .letters').innerHTML = document.querySelector('.ml11 .letters').textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

    //check widthLetter is delcare or not
    if (typeof widthLetter === 'undefined') {
        var widthLetter = document.querySelector('.ml11 .letters').getBoundingClientRect().width;
    }


    // clear all anime
    var textAnimation = anime.timeline({
            loop: true
        })
        .add({
            targets: '.ml11 .line',
            scaleY: [0, 1],
            opacity: [0.5, 1],
            easing: "easeOutExpo",
            duration: 700
        })
        .add({
            targets: '.ml11 .line',
            translateX: [0, widthLetter + 10],
            easing: "easeOutExpo",
            duration: 700,
            delay: 100
        }).add({
            targets: '.ml11 .letter',
            opacity: [0, 1],
            easing: "easeOutExpo",
            duration: 600,
            offset: '-=775',
            delay: (el, i) => 34 * (i + 1)
        }).add({
            targets: '.ml11',
            opacity: 0,
            duration: 1000,
            easing: "easeOutExpo",
            delay: 1000
        });

    textAnimation;

    // feature-slidier
    if (document.getElementsByClassName('feature-slider')[0] != undefined) {
        var slider = tns({
            container: '.feature-slider',
            loop: true,
            navPosition: "bottom",
            speed: 400,
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
                    items: 4
                }
            }
        });
    }
    AOS.init();
})