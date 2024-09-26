$(document).ready(function() {
    $(".menu__button").click(function(e) {
        let clicked_str = $(this).attr('data-clicked');
        let clicked = clicked_str == "true" ? true : false;

        clicked = !clicked;

        $(this).attr('data-clicked', clicked);

        if ($(this).parent().hasClass('menu')) {
            $(this).parent().attr('data-open', clicked);
            $("body").attr('data-menu-open', clicked);
        } else {
            console.warn("menu__button not inside menu");
        }
    });
});
