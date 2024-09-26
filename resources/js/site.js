function setup_slick() {
    let width = $(window).width();

    var center = width > 640;

    $(".carousel").map(function() {
        $(this).find(".carousel__items").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            centerMode: center,
            prevArrow: $(this).find(".carousel__prev"),
            nextArrow: $(this).find(".carousel__next"),
        }).on('beforeChange', (event, slick, currentSlide, nextSlide) => {
            if (currentSlide !== nextSlide) {
                document.querySelectorAll('.slick-center + .slick-cloned').forEach((next) => {
                    // timeout required or Slick will overwrite the classes
                    setTimeout(() => next.classList.add('slick-current', 'slick-center'));
                });
            }
        });
    });
}

$(document).ready(function() {
    setup_slick();
    $(window).on("resize", function () {
        $(".carousel>.carousel__items").slick("unslick");
        setup_slick();
    });
});
