$(document).ready(function() {
    if (window.innerWidth < 1026) {
        
        $('.js-doctors').slick({
            infinite: false,
            slidesToShow: 2,
            slidesToScroll: 2,
            dots: true,
            arrows: false,
            adaptiveHeight: true,
            responsive: [{
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        })
        
    }
});