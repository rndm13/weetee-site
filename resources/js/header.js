$(document).ready(function() {
    $(".menu__button").click(function(e) {
        let clicked_str = $(this).attr('data-clicked');
        let clicked = clicked_str == "true" ? true : false;

        clicked = !clicked;

        $(this).attr('data-clicked', clicked);

        $("#menu").attr('data-open', clicked);
        $("body").attr('data-menu-open', clicked);
    });
});
